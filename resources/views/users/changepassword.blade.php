@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="row align-items-center mb-30">
    <div class="col-lg">
        <div class="register-edited bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Ubah Password</h2>
            </div>
            <form method="POST" action="/editpassword">
                @csrf
                @method('PUT')
                    <div class="form-wrap max-width-600 mx-auto">
                        @if (session('msg'))
							<div class="alert alert-danger">
								<ul>
									<li>{{ session('msg') }}</li>
								</ul>
							</div>
						@endif
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password Lama*</label>
                            <div class="col-sm-8">
                                <input type="password" name="passwordlama" class="form-control  @error('passwordlama') is-invalid @enderror">
                                @error('passwordlama')
                                    <div class="row mt-1">
                                        <small class="col-sm-12 text-danger">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password Baru*</label>
                            <div class="col-sm-8">
                                <input type="password" name="passwordbaru" class="form-control  @error('passwordbaru') is-invalid @enderror">
                                @error('passwordbaru')
                                    <div class="row mt-1">
                                        <small class="col-sm-12 text-danger">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Konfirmasi Password Baru*</label>
                            <div class="col-sm-8">
                                <input type="password" name="passwordbaru_confirmation" class="form-control  @error('passwordbaru') is-invalid @enderror">
                                @error('passwordbaru_confirmation')
                                    <div class="row mt-1">
                                        <small class="col-sm-12 text-danger">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Update') }}</button>
                                </div>		
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection