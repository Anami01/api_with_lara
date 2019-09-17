<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Index</title>
</head>
<body>
  <a href="user/create"><button>Add User</button></a>
  <a href="logout"><button>Logout</button></a>
  <table border='1'>
    <tr>
      <td>Sr.no</td>
      <td>Name</td>
      <td>Address</td>
      <td>City</td>
      <td>Number</td>
      <td>Email</td>
      <td>Photo</td>
      <td>Gender</td>
      <td>Password</td>
      <td>Action</td>
    </tr>
    @php $i = 1 @endphp
    @foreach($data as $val)
      <tr>
      <td>{{ $i++ }}</td>
      <td>{{ $val->name }}</td>
      <td>{{ $val->address }}</td>
      <td>{{ $val->city }}</td>
      <td>{{ $val->number }}</td>
      <td>{{ $val->email }}</td>
      <td><img src='uploads/{{ $val->photo }}' height="50" width="50"></td>
      <td>{{ $val->gender }}</td>
      <td>{{ $val->password }}</td>
      <td><a href='user/{{ $val->id }}/edit'><button>Edit</button></a><form action="/user/{{ $val->id }}" method='post'>@csrf @method('DELETE') <button type="submit" class='btn btn-danger'>Delete</button></form></td>
      </tr>
    @endforeach
  </table>
</body>
</html>