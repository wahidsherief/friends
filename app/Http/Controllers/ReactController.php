<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FrancescoMalatesta\LaravelReactions\Models\Reaction;
use App\Notifications\Notifications;
use Auth;
use App\Post;
use App\User;
use DB;

class ReactController extends Controller
{
    public function createReaction()
    {
    	$reaction = Reaction::createFromName('angry');
		$reaction->save();
    }


    public function saveReaction(Request $request)
    {
        $post_id = $request->id;
    	$user_id = Auth::id();

  		$check = $this->reactValidate($post_id, $user_id);
  		$alreadyReacted = $check[0]->count;
  		$reactableID = $check[0]->rid;

  		if ($alreadyReacted >= 1) {
  			DB::table('reactables')->where('reactable_id', $post_id)->delete();
			return DB::table('reactables')
                		->where('reactable_id', $post_id)->count();
  		} else {
  			$reacter = User::find(Auth::id());
			$reaction = Reaction::where('name', '=', 'like')->first();
			$thisPost = Post::find($post_id);
			$reacter->reactTo($thisPost, $reaction);

            $poster = User::find($thisPost->user_id);

            // $reacter->notification_type = 'reacts';

            // $poster->notify(new Reacts($reacter));

			return DB::table('reactables')
                		->where('reactable_id', $post_id)->count();
  		}
    }

    private function reactValidate($postID, $userID) {
    	return DB::select('select r.id as rid, count(r.reaction_id) as count from reactables r
			where r.reactable_id ='. $postID .' and r.responder_id ='. $userID);
    }

}
