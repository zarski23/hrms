<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="SoengSouy Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="SoengSouy Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Dashboard - HRMS</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/barugo_logo.png') }}">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ URL::to('ssets/plugins/morris/morris.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">


	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>

<body>
	<style>    
		.invalid-feedback{
			font-size: 14px;
		}
	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		
		<!-- Loader -->
		<div id="loader-wrapper">
			<div id="loader">
				<div class="loader-ellips">
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				  <span class="loader-ellips__dot"></span>
				</div>
			</div>
		</div>
		<!-- /Loader -->

		<!-- Header -->
		<div class="header">
			<!-- Logo -->
			<div class="header-left">
				<a href="{{ route('home') }}" class="logo">
					<img src="{{ URL::to('/assets/img/barugo_logo.png') }}" width="40" height="40" alt="">
				</a>
				<span id="header-title" class="text-white">HRM System</span>
			</div>
			<!-- /Logo -->
			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>
			<!-- Header Title -->
			<div class="page-title-box">
			@if (Auth::user()->hr_user_role=='Admin' || Auth::user()->hr_user_role=='admin')
				<h3>Hi, Admin</h3>
			@else
				<h3>Hi, {{ Session::get('first_name') }}</h3>
			@endif

				
			</div>
			<!-- /Header Title -->
			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
			<!-- Header Menu -->
			<ul class="nav user-menu">
				<!-- Search -->
				<!-- <li class="nav-item">
					<div class="top-nav-search">
						<a href="javascript:void(0);" class="responsive-search"> <i class="fa fa-search"></i> </a>
						<form action="search.html">
							<input class="form-control" type="text" placeholder="Search Employee">
							<button class="btn" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</form>
					</div>
				</li> -->
				<!-- /Search -->

				<!-- Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="badge badge-pill badge-danger">3</span> 
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Notifications</span> 
							<a href="javascript:void(0)" class="clear-noti"> Clear All </a> 
						</div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img alt="" src="/images/photo_defaults.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Nancy Agosto</span> submit leave form <span class="noti-title">Leave Application</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img alt="" src="/images/photo_defaults.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Ricardo Negado</span> update her profile information <span class="noti-title">Employee Status</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img alt="" src="/images/photo_defaults.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Jessryll Almacin</span> submit travel order form <span class="noti-title">Authority to Travel</span>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img alt="" src="/images/photo_defaults.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Jasmin Cardenas</span> submit leave form <span class="noti-title">Leave Application</span></p>
												<p class="noti-time"><span class="notification-time">1 hr ago</span></p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="activities.html">
										<div class="media">
											<span class="avatar">
												<img alt="" src="/images/photo_defaults.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Conception Alcober</span> submit travel order form <span class="noti-title">Authority to Travel</span>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="activities.html">View all Notifications</a> </div>
					</div>
				</li>
				<!-- /Notifications -->
				
				<!-- Message Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-comment-o"></i> <span class="badge badge-pill badge-danger">8</span>
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Messages</span> 
							<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
						 </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img alt="" src="/images/photo_defaults.png">
												</span>
											</div>
											<div class="list-body">
												<span class="message-author">Sheena Aguilos </span> 
												<span class="message-time">9:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">"Morning! Ready to tackle today's tasks?"</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img alt="" src="/images/photo_defaults.png">
												</span>
											</div>
											<div class="list-body">
												<span class="message-author">Ricardo Negado</span> 
												<span class="message-time">6 Mar</span>
												<div class="clearfix"></div> 
												<span class="message-content">Hi, quick reminder about our meeting at 2 PM. See you there!</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img alt="" src="/images/photo_defaults.png">
												</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Alejandro Welbyne Cubilla </span>
												<span class="message-time">5 Mar</span>
												<div class="clearfix"></div> 
												<span class="message-content">Hey, could you send me the latest file? Need it for the presentation. Thanks!</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img alt="" src="/images/photo_defaults.png">
													</span>
												</div>
											<div class="list-body">
												<span class="message-author"> Lea Garcia</span>
												<span class="message-time">3 Mar</span>
												<div class="clearfix"></div>
												<span class="message-content">Don't forget to submit your expense report by end of day. Thanks!</span> 
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img alt="" src="/images/photo_defaults.png">
												</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Kent Ariza </span>
												<span class="message-time">27 Feb</span>
												<div class="clearfix"></div>
												<span class="message-content">Emergency team meeting at 3 PM. Please prioritize attendance.</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="chat.html">View all Messages</a> </div>
					</div>
				</li>
				<!-- /Message Notifications -->

				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
						<img src="{{ URL::to('/assets/images/'. Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
						<span class="status online"></span></span>
						<span>{{ Session::get('first_name') }} {{ Session::get('last_name') }}</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
						<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
					<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->
		<!-- Sidebar -->
		@include('sidebar.sidebar')
		<!-- /Sidebar -->
		<!-- Page Wrapper -->
		@yield('content')
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

	<!-- <script>
		// Function to toggle the visibility of the span
		function toggleHeaderTitle() {
			const headerTitle = document.getElementById('header-title');
			headerTitle.style.display = headerTitle.style.display === 'none' ? 'block' : 'none';
		}

		// Add a click event listener to the mobile_btn element
		const mobileBtn = document.getElementById('mobile_btn');
		mobileBtn.addEventListener('click', toggleHeaderTitle);
	</script> -->

	<script>
		document.addEventListener("DOMContentLoaded", function() {
		var toggleBtn = document.getElementById("toggle_btn");
		var headerTitle = document.getElementById("header-title");

			if (toggleBtn && headerTitle) {
				toggleBtn.addEventListener("click", function() {
					if (headerTitle.style.display === "none") {
						headerTitle.style.display = "inline";
					} else {
						headerTitle.style.display = "none";
					}
				});
			}
		});
	</script>

	<!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
	<!-- Bootstrap Core JS -->
	<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
	<!-- Chart JS -->
	<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/chart.js') }}"></script>
	<script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/line-chart.js') }}"></script>	
	<!-- Slimscroll JS -->
	<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
	<!-- Select2 JS -->
	<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Multiselect JS -->
	<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>		
	<!-- Custom JS -->
	<script src="{{ URL::to('assets/js/app.js') }}"></script>

	@yield('script')
</body>
</html>