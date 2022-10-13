{{-- 

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

@if($errors->any())
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
@endif
    <form method="POST"  action="/reset-password">
      @csrf
      <input type="hidden" name="token" value="{{$token}}" ></input>
   <br><br>
   <input type="" name="email"  placeholder="Email"></input>
   <br><br>
     <input type="password" name="password"  placeholder="New Password"></input>
     <br><br>
       <input type="password" name="password_confirmation"  placeholder="Confirm Password"></input>
        <br><br>
      <input type="submit"></input>
    </form>

  </body>
</html> --}}




<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<style>
body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
background: url('https://images.unsplash.com/photo-1562619227-71c891fd2799?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=413&q=80');


}
.main{
	width: 350px;
	height: 500px;
	background: red;
	overflow: hidden;
	background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
  background-color:#2E8B57;

}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
  margin-bottom: 0px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background:#355E3B;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background:#285D34;
  background-image: url();
}
.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #2E8B57;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

.error-message {
  color: #cc0033;
  display: inline-block;
  font-size: 12px;
  line-height: 15px;
  margin: 5px 0 0;
}

</style>
<body>




	
	    <div class="alert alert-success"></div>


	
	    <div class="alert alert-danger" ></div>

	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="/reset-password" method="post">
       
					<label for="chk" aria-hidden="true">Reset your Password !</label>
			
				<div class="alert alert-danger"></div>
        @csrf
      <input type="hidden" name="token" value="{{$token}}">
			
					<input type="email" name="email" placeholder="Email" required="">
				
				  <div class="alert alert-danger"></div>
			
					<input type="password" name="password" placeholder="Password" required="">
								

          	<input type="password" name="password_confirmation" placeholder="Confirm Password" required="">
						
						<div class="alert alert-danger"></div>
					
					<button>Reset Password</button>
				</form>
			</div>

	</div>
</body>
</html>
