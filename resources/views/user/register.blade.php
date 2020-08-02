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
  <title>Register</title>
</head>
<body>
  <form action="add_user" method="post" id="register_user">
  @csrf
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <label for='name'>Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='email'>Email</label>
          <input type="text" name="email" class="form-control" required>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='address'>Address</label>
          <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='country'>Country</label>
          <select name="country" class="form-control" id="country">
            <option value selected disabled>Please Choose Country</option>
            @if($country->isnotEmpty())
            @foreach($country as $value)
            <option value="{{$value->id}}">{{$value->country_name}}</option>
            @endforeach
            @endif
          </select>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='state'>State</label>
          <select class="form-control" name="state" id="state">
            <option value selected disabled>Please Choose State</option>
          </select>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='city'>City</label>
          <select class="form-control" name="city" id="city">
            <option value selected disabled>Please Choose City</option>
          </select>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='password'>Password</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="col-sm-12 col-xs-12">
          <label for='conf_password'>Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <div class="col-sm-12 col-xs-12">
        <br><button type="button" class="btn btn-primary submit_data">Submit</button>
          <!-- <br><input type='submit' value="Register" class="btn btn-primary" class="form-control"> -->
        </div>
      </div>
    </div>
  </form>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#country").on("change",function(){
      if($(this).val() != ''){
        $.ajax({
          type : 'get',
          url : '/get_state_data/'+$(this).val(),
          data : '',
          success : function(data){
            var state = JSON.parse(data);
            var data = "<option value selected disabled>Please Choose State</option>";
            $.each(state,function(index,value){
              data += "<option value = '"+value.id+"'>"+value.state_name+"</option>";
            });
            $("#state").html(data);
          }
        });
      }
    });
    $("#state").on("change",function(){
      if($(this).val() != ''){
        $.ajax({
          type : 'get',
          url : '/get_city_data/'+$(this).val()+'/'+$("#country").val(),
          data : '',
          success : function(data){
            var city = JSON.parse(data);
            var data = "<option value selected disabled>Please Choose City</option>";
            $.each(city,function(index,value){
              data += "<option value = '"+value.id+"'>"+value.city_name+"</option>";
            });
            $("#city").html(data);
          }
        });
      }
    });
    $("#register_user").validate({
      rules: {
        name:"required",
        email: {                        
          email:true,
          remote:'check_email',
        },
        address: "required",
        // country: "required",
        // state: "required",
        // city: "required",
        password: "required",
        confirm_password: {
          required: true,
          equalTo:"#password"                    
        }
      },
      messages: {
        name: {
          required: "Please enter name",
        },
        email: {
          required : "Please enter email",
          remote: "Please enter different email"
        },
        address: {
          required: "Please enter address",
        },
        // contry: {
        //   required: "Please select country",
        // },
        // state: {
        //   required: "Please select state",
        // },
        // city: {
        //   required: "Please select city",
        // },
        password: {
          required: "Please enter password",
        },
        confirm_password :{
          required: "Please enter confirm password",
          equalTo: "Please enter same password"
        }
      }
      
    });

    $(".submit_data").click(function () {
      // $("#register_users").validate();

      console.log($("#register_user").valid())
      if($("#register_user").valid()){
        console.log("asd")
        $("#register_user").submit();
        $("#register_user").trigger('submit');
      }
    })
  });
</script>