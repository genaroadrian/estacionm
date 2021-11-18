<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Estación Metereológica</title>
</head>

<!-- Fonts and icons -->
<script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
<script>
	WebFont.load({
			google: { "families": ["Lato:300,400,700,900"] },
			custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{asset('css/fonts.min.css')}}"] },
			active: function () {
				sessionStorage.fonts = true;
			}
		});
</script>


<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/atlantis.min.css') }}">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index.html" class="logo">
					<img src="{{ asset('img/Logo-TESJo.png')}}" width="150px" alt="navbar brand" class="navbar-brand">
				</a>


				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
					data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
								aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
								aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset('img/usuario.jpg') }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									@guest

									@else
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset('img/usuario.jpg') }}"
													alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">



												<h4>{{ Auth::user()->name }}</h4>
												<p class="text-muted">{{ Auth::user()->email }}</p>

											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item text-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											Cerrar Sesión
											<i class="fas fa-door-open text-danger"></i>
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST"
											class="d-none">
											@csrf
										</form>
									</li>
									@endguest
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
							<a href="{{ route('inicio') }}">
								<i class="fas fa-home"></i>
								<p>Inicio</p>
							</a>
						</li>

						<li class="nav-item {{ request()->is('graficas/*') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#charts" class="collapsed">
								<i class="fas fa-chart-bar"></i>
								<p>Gráficas</p>
								<span class="caret"></span>
							</a>

							<div class="collapse {{ request()->is('graficas/*') ? 'show' : '' }}" id="charts">
								<ul class="nav nav-collapse">
									<li class="{{ request()->is('graficas/direccion') ? 'active' : '' }}">
										<a href="{{ route('direccion') }}">
											<span class="sub-item">Grafica de direccion</span>
										</a>
									</li>
									<li class="{{ request()->is('graficas/humedad') ? 'active' : '' }}">
										<a href="{{ route('humedad') }}">
											<span class="sub-item">Grafica de humedad</span>
										</a>
									</li>

									<li class="{{ request()->is('graficas/lluvia') ? 'active' : '' }}">
										<a href="{{ route('lluvia') }}">
											<span class="sub-item">Grafica de lluvia</span>
										</a>
									</li>
									<li class="{{ request()->is('graficas/luz') ? 'active' : '' }}">
										<a href="{{ route('luz') }}">
											<span class="sub-item">Grafica de luz</span>
										</a>
									</li>

									<li class="{{ request()->is('graficas/temperatura') ? 'active' : '' }}">
										<a href="{{ route('temperatura') }}">
											<span class="sub-item">Grafica de temperatura</span>
										</a>
									</li>
									<li class="{{ request()->is('graficas/velocidad') ? 'active' : '' }}">
										<a href="{{ route('velocidad') }}">
											<span class="sub-item">Grafica de velocidad</span>
										</a>
									</li>

									<li class="{{ request()->is('graficas/presion') ? 'active' : '' }}">
										<a href="{{ route('presion') }}">
											<span class="sub-item">Grafica de presión</span>
										</a>
									</li>
								</ul>
							</div>
						</li>


					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="row">
							<div class="col-md-8">
								<h2 class="text-white pb-2 fw-bold">Estación Metereologica</h2>
								<h5 class="text-white op-7 mb-2">Tecnológico de Estudios Superiores de Jocotitlán</h5>
							</div>

							<div class="col-md-4 text-right">
								<!-- weather widget start -->
									<img src="https://w.bookcdn.com/weather/picture/32_26942_1_4_3658db_250_2a48ba_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=583&anc_id=81660"  alt="booked.net"/>
								<!-- weather widget end -->
							</div>
						</div>
					</div>
				</div>


				<div class="page-inner mt--5">
					@yield('content')

				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6 text-right">
							<img class="col-md-3" src="{{ asset('img/sistemas.jpeg') }}" alt="carrera de sistemas">
						</div>

						<div class="col-md-6 text-left">
							<img class="col-md-3" src="{{ asset('img/sistemas.jpeg') }}" alt="carrera de sistemas">
						</div>
					</div>
					<div class="copyright ml-auto">
						2021, made by <a href="#">Tania</a>
					</div>
				</div>
			</footer>
		</div>

	</div>


	<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/core/popper.min.js') }}"></script>
	<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>



	<!-- jQuery Sparkline -->
	<script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{ asset('js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{ asset('js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{ asset('js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('js/atlantis.min.js')}}"></script>

	<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	@yield('js')
</body>

</html>