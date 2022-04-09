<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>SILAKAM - Sistem Informasi Layanan Keluhan dan Aspirasi Masyarakat</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets')}}/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets')}}/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets')}}/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets')}}/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="{{asset('assets')}}/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('assets')}}/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{{asset('assets')}}/vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-edited bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Registrasi</h2>
						</div>
						<form method="POST" action="{{ route('register') }}">
							@csrf
								<div class="form-wrap max-width-600 mx-auto">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">NIK*</label>
										<div class="col-sm-8">
											<input type="number" name="nik" value="{{old('nik')}}" class="form-control  @error('nik') is-invalid @enderror">
											@error('nik')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror

										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Username*</label>
										<div class="col-sm-8">
											<input type="text" name="username" value="{{old('username')}}" class="form-control  @error('username') is-invalid @enderror">
											@error('username')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Password*</label>
										<div class="col-sm-8">
											<input type="password" name="password" class="form-control  @error('password') is-invalid @enderror">
											@error('password')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Konfirmasi Password*</label>
										<div class="col-sm-8">
											<input type="password" name="password_confirmation" class="form-control  @error('password') is-invalid @enderror">
											@error('password_confirmation')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
								</div>

								<div class="form-wrap max-width-600 mx-auto">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Nama*</label>
										<div class="col-sm-8">
											<input type="text" name="nama" value="{{old('nama')}}" class="form-control  @error('nama') is-invalid @enderror">
											@error('nama')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label class="col-sm-4 col-form-label">Jenis Kelamin*</label>
										<div class="col-sm-8">
											<div class="custom-control custom-radio custom-control-inline pb-0">
												<input type="radio" id="male" name="jk" value="L" class="custom-control-input" {{old('jk') == 'L' ? 'checked' : ''}}>
												<label class="custom-control-label" for="male">Laki</label>
											</div>
											<div class="custom-control custom-radio custom-control-inline pb-0">
												<input type="radio" id="female" name="jk" value="P" class="custom-control-input" {{old('jk') == 'P' ? 'checked' : ''}}>
												<label class="custom-control-label" for="female">Perempuan</label>
											</div>
											@error('jk')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Alamat*</label>
										<div class="col-sm-8">
											{{-- <textarea class="form-control" name="alamat">{{old('alamat')}}</textarea> --}}
											<div class="row">
												<div class="col-12">
													<select name="alamat" class="form-control selectpicker @error('alamat') is-invalid @enderror" title="Alamat" data-size="3">
														@foreach ($alamat as $a)
															@if(old('alamat') == $a->alamat_id)
																<option value="{{$a->alamat_id}}" selected>{{$a->alamat}}</option>
															@else
																<option value="{{$a->alamat_id}}">{{$a->alamat}}</option>
															@endif			
														@endforeach
													</select>
												</div>
											</div>
											@error('alamat')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
								</div>
								<div class="form-wrap max-width-600 mx-auto">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Nomor HP*</label>
										<div class="col-sm-8">
											<input type="text" name="no_hp" value="{{old('no_hp')}}" class="form-control  @error('no_hp') is-invalid @enderror">
											@error('no_hp')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
										</div>
									</div>
									<div class="custom-control custom-checkbox mt-4">
										<input type="checkbox" class="custom-control-input" name="privacy" id="customCheck1" data-toggle="modal" data-target="#Medium-modal" required>
										<label class="custom-control-label" data-toggle="modal" data-target="#Medium-modal" for="customCheck1">Saya menyetujui syarat dan ketentuan</label>
									</div>
								</div>
							<div class="row mt-2">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Register') }}</button>
									</div>
									<div class="text-center mt-3">
										<a href="/login">Sudah punya akun? Silahkan LOGIN</a>		
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Medium modal -->
	<div class="col-md-4 col-sm-12 mb-30">
		<div class="pd-20 card-box height-100-p">
			<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Syarat dan Ketentuan</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<ul class="list-group list-group-flush">
								<li class="list-group-item pt-20 pb-20">
									<h6 class="weight-400 d-flex">
										<i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Merupakan warga desa Liprak Kulon.
									</h6>
								</li>
								<li class="list-group-item pt-20 pb-20">
									<h6 class="weight-400 d-flex">
										<i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Aplikasi SILAKAM hanya digunakan untuk menyampaikan keluhan dan aspirasi di desa Liprak Kulon.
									</h6>
								</li>
								<li class="list-group-item pt-20 pb-20">
									<h6 class="weight-400 d-flex">
										<i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Dilarang menggunakan identitas palsu / identitas orang lain.
									</h6>
								</li>
								<li class="list-group-item pt-20 pb-20">
									<h6 class="weight-400 d-flex">
										<i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Tidak diperbolehkan memberikan laporan yang mengandung unsur SARA, melecehkan, dan lain sebagainya.
									</h6>
								</li>
								<li class="list-group-item pt-20 pb-20">
									<h6 class="weight-400 d-flex">
										<i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Admin atau Petugas berhak menghapus / menonaktifkan akun anda jika ketahuan melanggar ketentuan, menggunakan identitas palsu / identitas orang lain.
									</h6>
								</li>
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{asset('assets')}}/vendors/scripts/core.js"></script>
	<script src="{{asset('assets')}}/vendors/scripts/script.min.js"></script>
	<script src="{{asset('assets')}}/vendors/scripts/process.js"></script>
	<script src="{{asset('assets')}}/vendors/scripts/layout-settings.js"></script>
</body>
</html>