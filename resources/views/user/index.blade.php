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
  <a href="logout" class="btn btn-danger float-right">Logout</a>
  <table border='1' style="text-align: center" class="table">
    <thead>
    <tr>
      <td>Sr.no</td>
      <td>Name</td>
      <td>Address</td>
      <td>City</td>
      <td>Number</td>
      <td>Email</td>
      <td>Photo</td>
      <td>Gender</td>
      <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @php $i = 1; if(sizeof($data) != 0){ @endphp
    @foreach($data as $val)
    <tr>
      <td>{{ $i++ }}</td>
      <td>{{ (!empty($val->name) ? $val->name : '-') }}</td>
      <td>{{ (!empty($val->address) ? $val->address : '-') }}</td>
      <td>{{ (!empty($val->city) ? $val->city : '-') }}</td>
      <td>{{ (!empty($val->number) ? $val->number : '-') }}</td>
      <td>{{ (!empty($val->email) ? $val->email : '-') }}</td>
      <td><img src='{{ (!empty($val->photo) ? "uploads/".$val->photo : "") }}' alt="no_image" height="50" width="50"></td>
      <td>{{ (!empty($val->gender) ? $val->gender : '-') }}</td>
      <td><a href='user/{{ $val->id }}/edit' class="btn btn-primary m-10">Edit</a><form action="/user/{{ $val->id }}" method='post'>@csrf @method('DELETE') <button type="submit" class='btn btn-primary'>Delete</button></form></td>
    </tr>
    @endforeach
    @php }else{ @endphp
    <tr>
      <td colspan="10" style="text-align: center;">No Data</td>
    </tr>
    @php } @endphp
    </tbody>
  </table><br>
  <a href="user/create" class="btn btn-primary">Add User</a>
</body>
</html>