@extends('user.layout')
@section('title','Change Password')
@section('index')
<div class="container">
	<div class="w-25">
		<form method="post" action="/change_pass">@csrf
			<span>Old Password</span><input type="password" name="old_pass" class="form-control">
			<span>New Password</span><input type="password" name="new_pass" class="form-control">
			<span>Confirm Password</span><input type="password" name="confirm_pass" class="form-control">
			<input type="submit" class="btn btn-success mt-1" value="Change">
			<a href='/user' class="btn btn-info mt-2">Go Back</a>
		</form>
		@if(Session::get('pass_change'))
		<span>{{ Session::get('pass_change') }}</span>
		@endif
	</div>
</div>
@endsection