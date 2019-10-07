@extends('user.layout')
@section('index')
<div class="container">
  <table border='1' style="text-align: center" class="table">
    <thead>
      <tr>
        <td>#</td>
        <td>Name</td>
        <td>Address</td>
        <td>City</td>
        <td>Number</td>
        <td>Email</td>
        <!-- <td>Photo</td> -->
        <td>Gender</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
      @php $i = 1; if(sizeof($data) != 0){ @endphp
      @foreach($data as $val)
      <tr>
        <td>{{ $i++ }}</td>
        <td>{{ ucwords((!empty($val->name) ? $val->name : '-')) }}</td>
        <td>{{ ucwords((!empty($val->address) ? $val->address : '-')) }}</td>
        <td>{{ ucwords((!empty($val->city) ? $val->city : '-')) }}</td>
        <td>{{ (!empty($val->number) ? $val->number : '-') }}</td>
        <td>{{ (!empty($val->email) ? $val->email : '-') }}</td>
        <!-- <td><img src='{{ (!empty($val->photo) ? "uploads/".$val->photo : "") }}' alt="no_image" height="50" width="50"></td> -->
        <td>{{ ucwords((!empty($val->gender) ? $val->gender : '-')) }}</td>
        <td><form action="/user/{{ $val->id }}" method='post'>@csrf @method('DELETE') <a href='/user/{{ $val->id }}/edit' class="btn btn-info m-10">Edit</a>&nbsp;<button type="submit" class='btn btn-danger'>Delete</button></form></td>
      </tr>
      @endforeach
      @php }else{ @endphp
      <tr>
        <td colspan="10" style="text-align: center;">No Data</td>
      </tr>
      @php } @endphp
    </tbody>
  </table>
  <a href="/user/create" class="btn btn-link">Add User</a>
</div>
@endsection