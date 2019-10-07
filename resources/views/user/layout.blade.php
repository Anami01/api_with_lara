<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>Index</title>
</head>
<body>
	Current User : {{ Session::get('name') }}
	<a href="logout" class="btn btn-danger float-right">Logout</a>
	@yield('index')
	<a href="user/create" class="btn btn-primary">Add User</a>
</body>
</html>
