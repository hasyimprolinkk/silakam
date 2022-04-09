<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>SILAKAM - @yield('title')</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets') }}/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets') }}/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/src/plugins/dropzone/src/dropzone.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/src/plugins/fancybox/dist/jquery.fancybox.css">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	@include('sweetalert::alert')
	
	@if(Auth::check())

	<div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
        </div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-name">{{Auth::user()->nama}}</span>
						<span class="user-icon" style="size: 5px;">
							<img src="{{ asset('storage/'. Auth::user()->avatar) }}" style="width: 50px;height: 50px;" alt="">
						</span>
						{{-- <div class="chat-profile-header ">
							<div class="left">
								<div class="">
						<div class="chat-profile-photo">
							<img src="{{asset('storage/'.Auth::user()->avatar)}}"
								alt="">
						</div>
								</div></div></div> --}}
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="/home"><i class="icon-copy dw dw-home"></i> Home</a>
						<a class="dropdown-item" href="/profile"><i class="dw dw-user1"></i> Profile</a>
						{{-- <a class="dropdown-item" href="/bantuan"><i class="dw dw-help"></i> Bantuan</a> --}}
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dw dw-logout"></i> Log out</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="/dashboard">
				{{-- <img src="{{ asset('assets') }}/vendors/images/logo.png" alt="" class="dark-logo"> --}}
				<img src="{{ asset('assets') }}/vendors/images/logo_white.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="/dashboard" class="dropdown-toggle no-arrow {{request()->is('dashboard') ? 'active' : ''}}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
					@if (Auth::user()->roles == "user")
					<li>
						<a href="/lapor" class="dropdown-toggle no-arrow {{request()->is('lapor') ? 'active' : ''}}">
							<span class="micon dw dw-volume"></span><span class="mtext">Lapor</span>
						</a>
					</li>
					<li>
						<a href="/laporan_saya" class="dropdown-toggle no-arrow {{request()->is('laporan_saya*') ? 'active' : ''}}">
							<span class="micon dw dw-volume"></span><span class="mtext">Laporan Saya</span>
						</a>
					</li>
					@endif
					@if(Auth::user()->roles == "admin" || Auth::user()->roles == "petugas")
					<li>
						<div class="sidebar-small-cap mt-1">Data</div>
					</li>
					<li>
						<a href="/data_lapor" class="dropdown-toggle no-arrow {{request()->is('data_lapor*') ? 'active' : ''}}">
							<span class="micon dw dw-list3"></span><span class="mtext">Data Laporan</span>
						</a>
					</li>
					<li>
						<a href="/masyarakat" class="dropdown-toggle no-arrow {{request()->is('masyarakat*') ? 'active' : ''}}">
							<span class="micon dw dw-user"></span><span class="mtext">Masyarakat</span>
						</a>
					</li>
					@endif
					@if (Auth::user()->roles == "admin")
                    <li>
						<a href="/petugas" class="dropdown-toggle no-arrow {{request()->is('petugas*') ? 'active' : ''}}">
							<span class="micon dw dw-user"></span><span class="mtext">Petugas</span>
						</a>
					</li>
					<li>
						<div class="sidebar-small-cap mt-1">Master Data</div>
					</li>
					<li>
						<a href="/alamat" class="dropdown-toggle no-arrow {{request()->is('alamat') ? 'active' : ''}}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Alamat</span>
						</a>
					</li>
					<li>
						<a href="/kategori" class="dropdown-toggle no-arrow {{request()->is('kategori') ? 'active' : ''}}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Kategori</span>
						</a>
					</li>
					@endif
					<li>
						<div class="sidebar-small-cap mt-1">Pengaturan</div>
					</li>
					<li>
						<a href="/profile" class="dropdown-toggle no-arrow {{request()->is('profile') ? 'active' : ''}}">
							<span class="micon dw dw-user"></span><span class="mtext">Profile</span>
						</a>
					</li>
                    <li>
						<a href="/editpassword" class="dropdown-toggle no-arrow {{request()->is('editpassword') ? 'active' : ''}}">
							<span class="micon dw dw-unlock1"></span>
							<span class="mtext">Ubah Password</span>
						</a>
					</li>
					<li>
						<a href="/telegram_bot" class="dropdown-toggle no-arrow {{request()->is('telegram_bot') ? 'active' : ''}}">
							<span class="micon dw dw-paper-plane1"></span>
							<span class="mtext">Telegram Bot</span>
						</a>
					</li>
					@if(Auth::user()->roles != "user")
					<li>
						<a href="/cetak_laporan" class="dropdown-toggle no-arrow {{request()->is('cetak_laporan') ? 'active' : ''}}">
							<span class="micon dw dw-print"></span>
							<span class="mtext">Cetak Laporan</span>
						</a>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			
            @yield('content')

            <div class="footer-wrap pd-20 mb-20 card-box">
                SILAKAM - Liprak Kulon by <a href="https://t.me/hasyimprolinkk" target="_blank">Hasyim Asy'ari</a>
            </div>
		</div>
	</div>

	@endif
	<!-- js -->
	<script src="{{ asset('assets') }}/vendors/scripts/core.js"></script>
	<script src="{{ asset('assets') }}/vendors/scripts/script.min.js"></script>
	<script src="{{ asset('assets') }}/vendors/scripts/process.js"></script>
	<script src="{{ asset('assets') }}/vendors/scripts/layout-settings.js"></script>
	<script src="{{ asset('assets') }}/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="{{ asset('assets') }}/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('assets') }}/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{ asset('assets') }}/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="{{ asset('assets') }}/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="{{ asset('assets') }}/vendors/scripts/datatable-setting.js"></script>
	{{-- <script src="{{ asset('assets') }}/vendors/scripts/dashboard.js"></script> --}}
	<script src="{{ asset('assets') }}/src/plugins/dropzone/src/dropzone.js"></script>
	<script src="{{ asset('assets') }}/src/plugins/fancybox/dist/jquery.fancybox.js"></script>
	<script>
		Dropzone.autoDiscover = false;
		$(".dropzone").dropzone({
			addRemoveLinks: true,
			removedfile: function(file) {
				var name = file.name;
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			}
		});

		$('.custom-file-input').on('change', function (){
			let file_name = $(this).val().split('\\').pop();
			$(this).next('.custom-file-label').addClass("selected").html(file_name);
		});
	</script>

</body>
</html>