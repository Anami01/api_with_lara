@if(Session::get('email'))
  @php redirect('user') @endif
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Register</title>
</head>
<body>
  <form action="/add_user" method="post">@csrf
    <table>
      <tr><td>Name</td></tr>
      <tr>
        <td>
          <input type="text" name="name" class="form-control">
          <td>
            @if($errors->has('name')) 
            <span>{{ $errors->first('name') }}</span>
            @endif
          </td>
        </td>
      </tr>
      <tr><td>Email</td></tr>
      <tr>
        <td>
          <input type="text" name="email" class="form-control">
          <td>
            @if($errors->has('email')) 
            <span>{{ $errors->first('email') }}</span>
            @endif
          </td>
        </td>
      </tr>
      <tr><td>Password</td></tr>
      <tr>
        <td>
          <input type="password" name="password" class="form-control">
        </td>
        <td>
          @if($errors->has('password')) 
          <span>{{ $errors->first('password') }}</span>
          @endif
        </td>
      </tr>
      <tr><td>Confirm Password</td></tr>
      <tr>
        <td>
          <input type="password" name="confirm_password" class="form-control">
        </td>
        <td>
          @if($errors->has('confirm_password')) 
          <span>{{ $errors->first('confirm_password') }}</span>
          @endif
        </td>
      </tr>
      <tr>
        <td>
          <input type='submit' value="Register" class="btn btn-primary" class="form-control">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>