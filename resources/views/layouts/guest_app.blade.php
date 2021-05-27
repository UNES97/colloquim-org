<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('/navbar/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('/navbar/navbar.css') }}">
    <style>
        .big-icon {
            font-size: 70px;
        }
        .white{
            color: white;
        }
    </style>
    <title>Col / Org</title>
</head>
<body class="hero-anime">
    <div class="navigation-wrap bg-light start-header start-style">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-md navbar-light">
					
						<a class="navbar-brand" href="/" ><img src="{{ url('/app-assets/img/logos/logo.png')}}" alt=""></a>	
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto py-4 py-md-0">
								<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/">Acceuil</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/consult_sessions">Sessions</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/consult_articles">Articles</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
									<a class="nav-link" href="/home"><i class="fa fa-user"></i></a>
								</li>
							</ul>
                        </div>		
                    </nav>	
				</div>
			</div>
		</div>
    </div>
    
    
    <div class="section full-height">
		<div class="absolute-center">
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
  

    <script src="{{ url('/navbar/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('/navbar/popper.min.js') }}"></script>
    <script src="{{ url('/navbar/bootstrap.min.js') }}"></script>
    <script src="{{ url('/navbar/navbar.js') }}"></script>

</body>
</html>