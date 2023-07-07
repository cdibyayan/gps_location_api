<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GPS Tracking Login</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
*{
  margin:0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

html,body{
  height: 100%;
}

body{
  display: grid;
  place-items: center;
  text-align: center;
  background: #dde1e7;
}

.content{
  width: 330px;
  background: #dde1e7;
  border-radius: 10px;
  padding: 40px 30px;
  box-shadow: -3px -3px 7px #ffffff73,
              2px 2px 5px rgba(94, 104, 121, 0.288);
}

.content .text{
  font-size: 33px;
  font-weight: 600;
  margin-bottom: 35px;
  color: #000;
}

.content .field{
  height: 50px;
  width: 100%;
  display: flex;
  position: relative;
}

.field input{
  height: 100%;
  width: 100%;
  padding-left: 45px;
  font-size: 18px;
  outline: none;
  border: none;
  color: #595959;
  background: #dde1e7;
  border-radius: 25px;
  box-shadow: inset 2px 2px 5px #babecc,
              inset -5px -5px 10px #ffffff73;
}

.field input:focus ~ label{
  box-shadow: inset 2px 2px 5px #babecc,
              inset -1px -1px 2px #ffffff73;
}

.field:nth-child(2){
  margin-top: 20px;
}

.field span{
  position: absolute;
  width: 50px;
  line-height: 50px;
  color: #595959;
}

.field label{
  position: absolute;
  top: 50%;
  left: 45px;
  pointer-events: none;
  color: #666666;
  transform: translateY(-50%);
}


.field input:focus ~ label{
  opacity: 0;
}

.forgot-pass{
  text-align: left;
  margin: 10px 0 10px 5px;
}

.forgot-pass a{
  font-size: 16px;
  color: #3498db;
  text-decoration: none;
}

.forgot-pass:hover a{
  text-decoration: underline;
}

button{
  margin: 15px 0;
  width: 100%;
  height: 50px;
  color: #000;
  font-size: 18px;
  font-weight: 600;
  background: #dde1e7;
  border: none;
  outline: none;
  cursor: pointer;
  border-radius: 25px;
  box-shadow: 2px 2px 5px #babecc,
              -5px -5px 10px #ffffff73;
}

button:focus{
  color: #3498db;
  box-shadow: inset 2px 2px 5px #babecc,
              inset -5px -5px 10px #ffffff73;
}

.signup{
  font-size: 16px;
  color: #595959;
  margin: 10px 0;
}

.signup a{
  color: #000;
  text-decoration: none;
}

.signup a:hover{
  text-decoration: underline;
}

  </style>
</head>
<body>
    <div class="content">
    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
     <img src="asset/logo.png" width="200" height="70">
      <div class="text">Login</div>
      <form action="#">
        <div class="field">
          <span class="fas fa-user"></span>
          <input type="text" id="email_log" required>
          <label>User Name</label>
        </div>
        <div class="field">
          <span class="fas fa-lock"></span>
          <input type="password" id="password_log">
          <label>Password</label>
        </div>
        <button id="butlogin">Sign in</button>
      </form>
  </div>
  <script>
      $(document).ready(function() {

	$('#butlogin').on('click', function() {
		var email = $('#email_log').val();
		var password = $('#password_log').val();
		if(email!="" && password!="" ){
			$.ajax({
				url: "login.php",
				type: "POST",
				data: {
					type:2,
					uid: email,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "dashboard.php";						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Invalid EmailId or Password !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
  </script>
</body>
</html>