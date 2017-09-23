@extends("user.layouts.master")
@section("contents")
    <router-view :userid="{{ Auth::user()->id }}"
                 :unreads="{{ Auth::user()->unreadNotifications }}">
	</router-view>
@endsection



