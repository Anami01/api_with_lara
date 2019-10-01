<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Form</title>
  <style type="text/css">
    span{
      color:red;
    }
  </style>
</head>
<body>
  <table>
    @php 
    $url = '/user';
    $button = 'Submit';
    if(isset($edit_data))
    {
      $url = '/user/'.$edit_data->id;
      $button = 'Edit';
    }
    @endphp
    <form action="{{ $url }}" method="post" enctype="multipart/form-data">@csrf @isset($edit_data) @method("PATCH") @endisset
      <tr>
        <td>Name</td>
        <td>
          <input type="text" name="name" value="{{ isset($edit_data) ? $edit_data->name : '' }}" class="form-control">
        </td>
        <td>
          @if($errors->has('name')) 
          <span>{{ $errors->first('name') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>
          <textarea name='address' class="form-control">{{ isset($edit_data) ? $edit_data->address : '' }}</textarea>
        </td>
        <td>
          @if($errors->has('address')) 
          <span>{{ $errors->first('address') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>City</td>
        <td>
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
        </td>
        <td>
          @if($errors->has('city')) 
          <span>{{ $errors->first('city') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>Number</td>
        <td>
          <input type="text" name="number" maxlength="10" value="{{ isset($edit_data) ? $edit_data->number : '' }}" class="form-control">
        </td>
        <td>
          @if($errors->has('number')) 
          <span>{{ $errors->first('number') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>Email</td>
        <td>
          <input type="email" name="email" value="{{ isset($edit_data) ? $edit_data->email : '' }}" class="form-control">
        </td>
        <td>
          @if($errors->has('email')) 
          <span>{{ $errors->first('email') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>Photo</td>
        <td>
          <input type="file" name="photo" value="{{ isset($edit_data) ? $edit_data->photo : '' }}">
        </td>
        <td>
          @if($errors->has('photo')) 
          <span>{{ $errors->first('photo') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>
          <input type="radio" name="gender" value='male' {{ isset($edit_data->gender) ? ($edit_data->gender == 'male' ? "checked" : '') : '' }}  >Male
          <input type="radio" name="gender" value='female' {{ isset($edit_data->gender) ? ($edit_data->gender == 'female' ? "checked" : '') : '' }}  >Female
        </td>
        <td>
          @if($errors->has('gender')) 
          <span>{{ $errors->first('gender') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>Password</td>
        <td>
          <input type="password" name="password" value="{{ isset($edit_data) ? $edit_data->password : '' }}" class="form-control">
        </td>
        <td>
          @if($errors->has('password')) 
          <span>{{ $errors->first('password') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td colspan='2'>
          <input type="submit" value="{{ $button }}" class="btn btn-primary">
        </td>
      </tr>
    </form>
  </table>
</body>
</html>