 @extends('user.layout')
 @section('title','Add User')
 @section('index') 
 <style type="text/css">
  span{
    color:red;
  }
</style>
@php 
$url = url("/").'/user';
$button = 'Submit';
if(isset($edit_data))
{
  $url = url("/").'/user/'.$edit_data->id;
  $button = 'Edit';
}
@endphp
<form action="{{ $url }}" method="post" enctype="multipart/form-data" autocomplete="off">@csrf @isset($edit_data) @method("PATCH") @endisset
  <div class="row">
    <div class="col-sm-6">
      <label>Name</label>
      <input type="text" name="name" value="{{ isset($edit_data) ? $edit_data->name : '' }}" class="form-control">
      @if($errors->has('name')) 
    </br><span>{{ $errors->first('name') }}</span>
    @endif
  </div>
  <div class="col-sm-6">
    <label>Address</label>
    <textarea name='address' class="form-control">{{ isset($edit_data) ? $edit_data->address : '' }}</textarea>
    @if($errors->has('address')) 
  </br><span>{{ $errors->first('address') }}</span>
  @endif
</div>
<div class="col-sm-6">
  <label>City</label>
  @php 
  $arr = array('Ahmedabad'=> 'Ahmedabad','Surat' => 'Surat','Gandhinagar' => 'Gandhinagar','Bhuj' => 'Bhuj');
  @endphp
  <select name="city" class="form-control">
    <option disabled>Please Choose a city</option>
    {{ isset($edit_data->city) ? 'selected=selected' : '' }}
    @foreach($arr as $key => $val) 
    <option value="{{ $key }}">{{ $val }}</option>
    @endforeach
  </select>
  @if($errors->has('city')) 
</br><span>{{ $errors->first('city') }}</span>
@endif
</div>
<div class="col-sm-6">
  <label>Contact</label>
  <input type="text" name="number" maxlength="10" value="{{ isset($edit_data) ? $edit_data->number : '' }}" class="form-control">
  @if($errors->has('number')) 
</br><span>{{ $errors->first('number') }}</span>
@endif
</div>
<div class="col-sm-6">
  <label>Email</label>
  <input type="email" name="email" value="{{ isset($edit_data) ? $edit_data->email : '' }}" class="form-control">
  @if($errors->has('email')) 
</br><span>{{ $errors->first('email') }}</span>
@endif
</div>
<div class="col-sm-6">
  <label>Profile Photo</label>
  <input type="file" class="form-control-file" name="photo" value="{{ isset($edit_data) ? $edit_data->photo : '' }}">
  @if($errors->has('photo')) 
</br><span>{{ $errors->first('photo') }}</span>
@endif
</div>
<div class="col-sm-12">
  <label for="gender">Gender :</label>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" class="custom-control-input" id="male" name="gender" value='male' {{ isset($edit_data->gender) ? ($edit_data->gender == 'male' ? "checked" : '') : '' }}  >
    <label class="custom-control-label" for="male">Male</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" class="custom-control-input" id="female" name="gender" value='female' {{ isset($edit_data->gender) ? ($edit_data->gender == 'female' ? "checked" : '') : '' }}  >
    <label class="custom-control-label" for="female">Female</label>
  </div>
  @if($errors->has('gender')) 
</br><span>{{ $errors->first('gender') }}</span>
@endif
</div>
<div class="col-sm-12">
  <label>Password</label>
  <input type="password" name="password" value="{{ isset($edit_data) ? $edit_data->password : '' }}" class="form-control">
  @if($errors->has('password')) 
</br><span>{{ $errors->first('password') }}</span>
@endif
</div>
<div class="col-sm-12">
  <label>Confirm Password</label>
  <input type="password" name="confirm_password" class="form-control">
  @if($errors->has('confirm_password')) 
</br><span>{{ $errors->first('confirm_password') }}</span>
@endif
</div>
<div class="col-sm-6">
  <input type="submit" value="{{ $button }}" class="btn btn-success mt-2">
  <a href='/user' class="btn btn-info mt-2">Go Back</a>
</div>
</div>
</form>
@endsection