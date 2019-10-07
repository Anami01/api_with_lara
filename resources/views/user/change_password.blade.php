@extends('user.layout')
@section('index')
<div class="container">
	<div class="w-25">
		<form method="post" action="change_pass">@csrf
			<span>Old Password</span><input type="password" name="old_pass" class="form-control">
			<span>New Password</span><input type="password" name="new_pass" class="form-control">
			<span>Confirm Password</span><input type="password" name="confirm_pass" class="form-control">
			<input type="submit" class="btn btn-primary mt-1" value="Change">
		</form>
		@if(Session::get('pass_change'))
		<span>{{ Session::get('pass_change') }}</span>
		@endif
	</div>
</div>
@endsection