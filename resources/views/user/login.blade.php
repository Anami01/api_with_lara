<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>
<body>
  <form action="setSession" method="post">@csrf
    <table>
      <tr>
        <td>
          Username
        </td>
      </tr>
      <tr>
        <td>
          <input type="text" name="username">
        </td> 
      </tr>
      <tr>
        <td>
          Password
        </td> 
      </tr>
      <tr>
        <td>
          <input type="password" name="password">
        </td>
      </tr>
      @if(Session::get('wrong_pass'))
      <tr>
        <td>{{ Session::get('wrong_pass') }}</td>
      </tr>
      @endif
      <tr>
        <td>
          <input type='submit' value="Login">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>