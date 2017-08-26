<template>
	<form action="/signup" method="POST">
		<!-- {{ csrf_field() }} -->
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">
			  <i class="fa fa-paper-plane" aria-hidden="true"></i></span>
			<input name='email' type="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon2">
			  <i class="fa fa-user" aria-hidden="true"></i></span>
			<input type="text" name='name' class="form-control" placeholder="Username" aria-describedby="basic-addon2">
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon3">
			  <i class="fa fa-key" aria-hidden="true"></i></span>
			<input type="password" name='password' class="form-control" placeholder="Password" aria-describedby="basic-addon3">
		</div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon4">
			  <i class="fa fa-check" aria-hidden="true"></i></span>
			<input type="password" name='password_confirmation' class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon4">
		</div>
		<div class="text-center">
		  <input type="submit" class="btn btn-success btn-submit" value="Register">
		</div>
	</form>
</template>

<script type="text/javascript">
	
</script>