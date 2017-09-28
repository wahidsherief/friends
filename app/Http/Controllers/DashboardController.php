<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Events\NotificationEvent;
use App\Notifications\Notifications;
use App\Notifications\CommentsUpdate;
use App\Post;
use App\User;

class DashboardController extends Controller
{
    private $post_image_path;
    private $comment_image_path;

    public function __construct() 
    {
    	$this->middleware('auth');
        $this->post_image_path = '/user/images/posts/';
        $this->comment_image_path = '/user/images/comments/';
    }

    public function index()
    {
        // $user = Auth::user();
        // $friends = $user->getFriends();
        // $temp = '';
        
        // foreach ($friends as $key => $friend) {
        //     $temp .= $user->id.','.$friend->id.',';
        // }

        // $friends_id = rtrim($temp,',');

        // $posts = DB::select('SELECT * FROM `posts` WHERE posts.user_id IN ('. $friends_id .') group by posts.id order by posts.id DESC');

        // foreach ($posts as $key => $post) {
        //     $reacts = DB::table('reactables')->where('reactable_id', $post->id)->count();
        //     $comments = DB::table('comments')->where('post_id', $post->id)->count();
        //     $username = User::where('id', $post->user_id)->first(['firstname', 'lastname']);

        //     $name = ucfirst($username->firstname) . " " . ucfirst($username->lastname);

        //     $post->reacts = $reacts;
        //     $post->comments = $comments;
        //     $post->name = $name;
        // }

        // return $posts;
    }

    public function getPosts()
    {
    	$posts = $this->getAllPosts();

        foreach ($posts as $post) {
            $check_if_image_exist = $this->checkIfImageExist($post->id);
            if ($check_if_image_exist) {
                $postImages = $this->getPostImages($post->id);
                foreach ($postImages as $key => $postImage) {
                    $post->images[$key] = $this->post_image_path.$postImage->image;
                }
            } else {
                $post->images = '';
            }
        }

        return $posts;

    }

    public function getComments(Request $request)
    {
    	
        return \App\Comment::where('post_id', $request->id)->with('user')->latest()->get();
    }

    public function insertPost(Request $request)
    {
        $images = $request->itemsImages;
        $mood = $request->current_mood;
        $body = $request->body;
        $color = $request->color;
        if ($color == null || $color == '') {
            $color = 'white';
        }

        if (empty($images) && $mood == null && $body == null) {
            return false;
        } else {
            $user_id  = Auth::id();
            $post = \App\User::find($user_id)
                    ->posts()
                    ->create(['body' => $body, 'color' => $color, 'mood' => $mood]);

            if (isset($images) || !empty($images)) {
                $this->uploadImage($images, $post->id);
            }

            $lastPost =  $this->getLastPost($post->id, $user_id);

            $check_if_image_exist = $this->checkIfImageExist($lastPost[0]->id);
            if ($check_if_image_exist) {
                $postImages = $this->getPostImages($lastPost[0]->id);
                foreach ($postImages as $key => $postImage) {
                    $image = $postImage->image;
                    $lastPost[0]->images[$key] = $this->post_image_path.$image;
                }
            } else {
                $lastPost[0]->images = '';
            }

            $newPost = collect($lastPost[0]);

            return $newPost ;
        }
    }

    public function insertComment(Request $request)
    {
    	// $this->validate($request, ['comment' => 'required']);
        $image = null;
        $comment = null;
        if (isset($request->image[0])) {
            $image = $request->image[0];
        }

        if (isset($request->comment)) {
            $comment = $request->comment;
        } else {
            $comment = '';
        }

        if ($image == null && $comment == null) {
            return false;
        } else {
            $user_id  = Auth::id();
            $post_id  = $request->post['id'];
            $comment = new \App\Comment;
            $comment->comment = $request->comment;
            $comment->post_id = $post_id;
            $comment->user_id = $user_id;
            $image_file = '';

            if (isset($image) || !empty($image) || $image != null) {
                $image_file  = $this->comment_image_path.$this->uploadCommentImage($image);
            } else {
                $image_file = '';
            }

            $comment->comment_image = $image_file;
            $comment->save();
            // $poster_id = $request->post['user_id'];
            // $poster = User::find($poster_id);

            // $commenter = User::find($user_id);
            // $commenter->notification_type = 'comment';
            // $commenter->post = $request->post;
            // $commenter->index = $request->index;

            // $poster->notify(new CommentsUpdate($commenter));
    	    return $comment->load('user');
        }
    }

    private function uploadImage($images, $postID) {
        $this->makeDirectoryIfNotExist('posts');
        foreach ($images as $image) {
            $exploded = explode(',', $image);
            $decoded = base64_decode($exploded[1]);
            $explode = explode('/',$exploded[0]);
            $extension = explode(';',$explode[1]);
            $file_name = uniqid().'_'.str_random().'.'.$extension[0];
            $path = public_path().'/user/images/posts/'.$file_name;
            file_put_contents($path, $decoded);

            DB::table('post_images')->insert(
                ['image' => $file_name, 'post_id' => $postID]
            );
        }
    }

    private function uploadCommentImage($image) {
        $this->makeDirectoryIfNotExist('comments');
        $exploded = explode(',', $image);
        $decoded = base64_decode($exploded[1]);
        $explode = explode('/',$exploded[0]);
        $extension = explode(';',$explode[1]);
        $file_name = uniqid().'_'.str_random().'.'.$extension[0];
        $path = public_path().'/user/images/comments/'.$file_name;
        file_put_contents($path, $decoded);

        return $file_name;
    }


    private function getAllPosts() {
        $user = Auth::user();
        $friends = $user->getFriends();
        $temp = $user->id.',';
        
        foreach ($friends as $key => $friend) {
            $temp .= $friend->id.',';
        }

        $friends_id = rtrim($temp,',');

        $posts = DB::select('SELECT * FROM `posts` WHERE posts.user_id IN ('. $friends_id .') group by posts.id order by posts.id DESC');

        foreach ($posts as $key => $post) {
            $reacts = DB::table('reactables')->where('reactable_id', $post->id)->count();
            $comments = DB::table('comments')->where('post_id', $post->id)->count();
            $username = User::where('id', $post->user_id)->first(['firstname', 'lastname']);

            $post->reacts = $reacts;
            $post->comments = $comments;
            $post->firstname = $username->firstname;
            $post->lastname = $username->lastname;
        }

        return $posts;

        // return  DB::select(
        //     'SELECT p.*,
        //         (SELECT COUNT(r.reactable_id) FROM reactables r WHERE p.id = r.reactable_id) AS reacts,
        //         (SELECT COUNT(c.id) FROM comments c WHERE p.id = c.post_id) AS total_comments,
        //         (SELECT CONCAT(u.firstname, " ", u.lastname) FROM users u WHERE p.user_id = u.id) AS name
        //     FROM posts p
        //     GROUP BY p.id
        //     ORDER BY p.`id` DESC');
    }

    private function getLastPost($postID, $userID) {
        return DB::select('SELECT posts.*, users.firstname, users.lastname FROM users, posts WHERE users.id = posts.user_id AND users.id = '. $userID . ' AND posts.id = '. $postID);
    }

    private function checkIfImageExist($postID) {
        return DB::table('post_images')->where('post_id', $postID)->exists();
    }

    private function getPostImages($postID) {
        return DB::select('select image from post_images where post_id = '. $postID);
    }

    private function makeDirectoryIfNotExist($directory_name) {
        $directory = public_path().'/user/images/'.$directory_name;
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }
}
