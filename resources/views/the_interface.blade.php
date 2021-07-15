<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Classimax Documentation</title>
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:700|Raleway:300,400" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<style type="text/css">
		body{
		  font-family: 'Raleway', sans-serif;
		  font-size: 14px;
		  -webkit-font-smoothing: antialiased;
		}

		h1, h2, h3, h4, h5{
			font-family: 'Montserrat', sans-serif;
		}
		a{
			color: #000;
		}
		a:hover {
		  text-decoration: none;
		  color: #509cfa;
		}

		.banner{
			height:121vh;
		  padding: 200px 0;
		  position: relative;
          margin-top: -100px;
          padding-bottom: 120px;
		}

		.overlay:before {
		  content: '';
		  background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
		  position: absolute;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		}

		.banner h1{
		  color: #FFF;
		}

		.banner h3{
		  color: #FFF;
		  opacity: .8;
		  font-size:18px;
		}

		.banner p{
		  color: #FFF;
		  font-size: 24px;
		  padding: 40px 0;
		  font-weight: 300;
		  width: 70%;
		  margin: 0 auto;
		}

		.navbar-brand{
		  color: #FFF;
		}

		.menu li a {
		  padding:10px 20px!important;
		  color: #FFF;
		}

		.btn-main-rounded{
		  padding: 15px 40px;
		  background: #509cfa;
		  color: #fff;
		  -webkit-border-radius: 100px;
		  border-radius: 100px;
		  font-weight: bold;
		  letter-spacing: 1px;
		}

		.btn-main-rounded:hover{
		  box-shadow: 0 8px 25px 0 rgba(0, 0, 0, 0.11);
		  color: #FFF;
		  transform: translate3d(0,-2px,0);
		}

		.navbar-brand:hover {
			color:#fff;
		}

	</style>
</head>
<body>
<section class="banner bg-1 overlay">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h1>Mf Documentation</h1>

				<p>We are constantly doing updates for you.</p>
				<a style="width:239px" href="{{route('register')}}" class="btn btn-main-rounded">Sine Up</a><br><br>
                <a style="width:239px" href="{{route('login')}}" class="btn btn-main-rounded">Sine in</a><br><br>
                <a href="{{route('login_redirect','github')}}" class="btn btn-main-rounded">Login Github
                 <img src="{{asset('admin\images\github-logo.png')}}" alt=""></a>

            </div>
		</div>
	</div>
</section>

</body>
</html>

