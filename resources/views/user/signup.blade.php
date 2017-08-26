@extends("user.layouts.auth_master")
@section("contents")
<div class="app-form" id='signup'>
    <div class="form-header">
        <div class="app-brand"><span class="highlight">Sign Up</div>
    </div>
    <div class="form-suggestion">
        Create an account for free. If already have account 
        <a href="{{ url('signin') }}">Sign in</a> here
    </div>
    <div class="form-group">
        <form action="{{ url('signup') }}" method="POST">
            {{ csrf_field() }}
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
    </div>
    {{-- 
    <div class="form-line">
        <div class="title">OR</div>
    </div>
    <div class="form-footer">
        <button type="button" class="btn btn-default btn-sm btn-social __facebook">
            <div class="info">
                <i class="icon fa fa-facebook-official" aria-hidden="true"></i>
                <span class="title">Register w/ Facebook</span>
            </div>
        </button>
    </div>
    --}}
    <div class="form-group">
        @include('user.layouts.error')
    </div>
</div>
@endsection