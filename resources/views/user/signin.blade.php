@extends("user.layouts.auth_master")
@section("contents")

<div class="app-form" id='signin'>
    <div class="form-header">
        <div class="app-brand"><span class="highlight">Sign In</div>
    </div>
    <div class="form-suggestion">
        Not a member? <a href="{{ url('signup') }}">Sign up</a> here
    </div>
    <form action="{{ url('signin') }}" method="POST">
        {{ csrf_field() }}
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
        {{-- <div class="input-group no-border">
            <div class="pull-right">
                Not a member? <button @click='seen = !seen' class="btn btn-link">Sign up</button> here
            </div>
        </div> --}}
        <div class="text-center">
            <input type="submit" class="btn btn-success btn-submit" value="Login">
        </div>
    </form>
    {{-- 
    <div class="form-line">
        <div class="title">OR</div>
    </div>
    <div class="form-footer">
        <button type="button" class="btn btn-default btn-sm btn-social __facebook">
            <div class="info">
                <i class="icon fa fa-facebook-official" aria-hidden="true"></i>
                <span class="title">Login with Facebook</span>
            </div>
        </button>
    </div>
    --}}
    <div class="form-group">
        @include('user.layouts.error')
    </div>
</div>
            
@endsection