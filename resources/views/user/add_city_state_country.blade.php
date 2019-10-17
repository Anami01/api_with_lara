<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Add Data</title>
</head>
<body>
  <form action="add_city_data" method="post">@csrf
    <div class="row">
      <h5>Country</h5>
      <div class="col-sm-12">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
        <input type="text" name="country[]">
      </div>
    </div><hr>
    <div class="row">
      <h5>State</h5>
      <div class="col-sm-12">
        <select name="country_id_list">
          <option value selected disabled>Select Country</option>
          @if($country->isnotEmpty())
          @foreach($country as $value)
          <option value="{{$value->id}}">{{$value->country_name}}</option>
          @endforeach
          @endif
        </select><br>
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
        <input type="text" name="state[]">
      </div>
    </div><hr>
    <div class="row">
      <h5>State</h5>
      <div class="col-sm-12">
        <select name="state_id_list">
          <option value selected disabled>Select State</option>
          @if($state->isnotEmpty())
          @foreach($state as $value)
          <option value="{{$value->id}}">{{$value->state_name}}</option>
          @endforeach
          @endif
        </select><br>
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
        <input type="text" name="city[]">
      </div>
    </div><hr>
    <input type="submit" class="btn btn-primary" value="submit">
  </table>
</form>
</body>
</html>