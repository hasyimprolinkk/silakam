@extends('layouts.app')

@section('title', 'Cetak Laporan')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Cetak Laporan</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cetak Laporan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row align-items-center mb-30">
    <div class="col-lg">
        <div class="register-edited bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Laporan</h2>
            </div>
            <form method="POST" action="/cetak_laporan">
                @csrf
                    <div class="form-wrap max-width-600 mx-auto">
                        @if (session('msg'))
							<div class="alert alert-danger">
								<ul>
									<li>{{ session('msg') }}</li>
								</ul>
							</div>
						@endif
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Awal*</label>
                            <div class="col-sm-8">
                                <input type="date" name="from_date" value="{{old('from_date')}}" class="form-control  @error('from_date') is-invalid @enderror">
                                @error('from_date')
                                    <div class="row mt-1">
                                        <small class="col-sm-12 text-danger">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Akhir*</label>
                            <div class="col-sm-8">
                                <input type="date" name="to_date" value="{{old('to_date')}}" class="form-control  @error('to_date') is-invalid @enderror">
                                @error('to_date')
                                    <div class="row mt-1">
                                        <small class="col-sm-12 text-danger">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Cetak PDF') }}</button>
                                </div>		
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection