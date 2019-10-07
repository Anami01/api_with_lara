@if(Session::get('email'))
  @php redirect('user') @endphp
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Login</title>
</head>
<body>
  <form action="/setSession" method="post">@csrf
    <table>
      <tr>
        <td>Username</td>
      </tr>
      <tr>
        <td><input type="text" name="username" class="form-control"></td> 
      </tr>
      <tr>
        <td>Password</td> 
      </tr>
      <tr>
        <td><input type="password" name="password" class="form-control"></td>
      </tr>
      @if(Session::get('wrong_pass'))
      <tr>
        <td>{{ Session::get('wrong_pass') }}</td>
      </tr>
      @endif
      @php $url = url("/") @endphp
      <tr>
        <td><input type='submit' value="Login" class="btn btn-primary" class="form-control"></form>
        <a href="javascript:void(0)" onclick="location.href='{{ $url }}/register'" class="btn btn-primary">Register</a>
        </td>
      </tr>
    </table>
</body>
</html>