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
		        <li class="dropdown notification">
		            
		          <a class="dropdown-toggle" data-toggle="dropdown">
		            <router-link to='friends' exact>
		            <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
		            <div class="title">Unread Messages</div>
		            <div class="count">99</div>

		            </router-link>    
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
		        </li>
		        <li class="dropdown notification warning">
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
		        </li>
		        <notification :userid='userid' :unreads='unreads'></notification>
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

	export default {
		props:['userid', 'unreads', 'username', 'profilepic'],
		components: {
			Notification
		}
	}
</script>

