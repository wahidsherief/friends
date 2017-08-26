<template>
	<form action="/signin" method="POST">
        <!-- @{{ csrf_field() }} -->
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">
            <i class="fa fa-user" aria-hidden="true"></i></span>
          <input type="text" name='email' class="form-control" placeholder="Email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon2">
            <i class="fa fa-key" aria-hidden="true"></i></span>
          <input type="password" name='password' class="form-control" placeholder="Password" aria-describedby="basic-addon2">
        </div>
        <div class="input-group no-border">
            <div class="pull-right">
                <a href="/signup">Not a member? Sign up here</a>
            </div>
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-success btn-submit" value="Login">
        </div>
    </form>
</template>