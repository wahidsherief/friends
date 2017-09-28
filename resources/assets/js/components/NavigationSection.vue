<template>
	<div>
		<nav class="navbar navbar-default">
		  <div class="">
		    <div class="navbar-collapse collapse in">
		      <ul class="nav navbar-nav navbar-mobile">
		        <li>
		          <button type="button" class="sidebar-toggle">
		            <i class="fa fa-bars"></i>
		          </button>
		        </li>
		        <li class="logo">
		          <a class="navbar-brand" href="#"><span class="highlight">Flat v3</span> Admin</a>
		        </li>
		        <li>
		          <button type="button" class="navbar-toggle">
		            <img class="profile-img" src="user/images/profile.png">
		          </button>
		        </li>
		      </ul>
		      <ul class="nav navbar-nav navbar-left">
		        <li class="navbar-title">
		          <router-link to="/" exact>Friends</router-link>
		        </li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		      	<!-- message request notifications -->
		        <!-- <li class="dropdown notification warning">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		            <div class="icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
		            <div class="title">Unread Messages</div>
		            <div class="count">99</div>
		          </a>
		          <div class="dropdown-menu">
		            <ul>
		              <li class="dropdown-header">Message</li>
		              <li>
		                <a href="#">
		                  <span class="badge badge-warning pull-right">10</span>
		                  <div class="message">
		                    <img class="profile" src="https://placehold.it/100x100">
		                    <div class="content">
		                      <div class="title">"Payment Confirmation.."</div>
		                      <div class="description">Alan Anderson</div>
		                    </div>
		                  </div>
		                </a>
		              </li>
		              <li>
		                <a href="#">
		                  <span class="badge badge-warning pull-right">5</span>
		                  <div class="message">
		                    <img class="profile" src="https://placehold.it/100x100">
		                    <div class="content">
		                      <div class="title">"Hello World"</div>
		                      <div class="description">Marco  Harmon</div>
		                    </div>
		                  </div>
		                </a>
		              </li>
		              <li>
		                <a href="#">
		                  <span class="badge badge-warning pull-right">2</span>
		                  <div class="message">
		                    <img class="profile" src="https://placehold.it/100x100">
		                    <div class="content">
		                      <div class="title">"Order Confirmation.."</div>
		                      <div class="description">Brenda Lawson</div>
		                    </div>
		                  </div>
		                </a>
		              </li>
		              <li class="dropdown-footer">
		                <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
		              </li>
		            </ul>
		          </div>
		        </li> -->

		        <!-- friend request notifications -->
		        <friend-request-notification :userid='userid' :unreads='friendRequests'>
		        </friend-request-notification>

		        <!-- all other notifications -->
		        <notification :userid='userid' :unreads='otherNotifications'></notification>
		        
		        <!-- profile links and logout -->
		        <li class="dropdown profile">
		          <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
		            <img class="profile-img-top-nav profile-img" :src="profilepic">
		            <div class="title">Profile</div>
		          </a>
		          <div class="dropdown-menu">
		            <div class="profile-info">
		              <h6 class="username">
		              		{{ username }}
		              </h6>
		            </div>
		            <ul class="action">
		              <li>
		                <router-link to="/profile" exact>Profile</router-link>
		              </li>
		              <li>
		                <a href="/logout">Logout</a>
		              </li>
		            </ul>
		          </div>
		        </li>
		      </ul>
		      </ul>
		    </div>
		  </div>
		</nav>
	</div>
</template>

<script>
	import Notification from '../components/Notification';
	import FriendRequestNotification from '../components/FriendRequestNotification';

	export default {
		props:['userid', 'unreads', 'username', 'profilepic'],

		components: {
			Notification,
			FriendRequestNotification
		},

		data() {
			return {
				friendRequests: [],
				otherNotifications: [],
			}
		},

		created() {
			this.friendRequests = this.getFriendRequestsNotifications();
			this.otherNotifications = this.getOthersNotifications();
		},

		// *** optimize both methods by axios get two types of notifications
		methods: {
			getFriendRequestsNotifications() {
				var notifications = [];
				this.unreads.forEach(function(n) {
					var type_string = n.type.split("\\");
					var type = type_string[2];
					if(type == "SendFriendRequest") {
		            	notifications.push(n);
					}
	        	});

	        	return notifications;
			},

			getOthersNotifications() {
				var notifications = [];
				this.unreads.forEach(function(n) {
					var type_string = n.type.split("\\");
					var type = type_string[2];
					if(type == "Notifications" || type == "CommentsUpdate") {
		            	notifications.push(n);
					}
	        	});

	        	return notifications;
			}
		}
	}
</script>

