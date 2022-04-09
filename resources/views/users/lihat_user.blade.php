@extends('layouts.main')

@section('title', 'Informasi User')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Informasi User</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Informasi User</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <img src="{{asset('storage/'.$user->avatar)}}" style="width: 150px; height: 150px;" class="avatar-photo">
            </div>
            <h5 class="text-center h5 mb-0">{{$user->nama}}</h5>
            <p class="text-center text-muted font-14">Terdaftar pada {{$user->created_at->isoFormat('D MMMM Y')}}</p>
            <div class="profile-info">
                <h5 class="mb-20 h5 text-blue">Informasi User</h5>
                <ul>
                    @if ($user->roles == "admin" || $user->roles == "petugas" )
                    <li>
                        <span>Jabatan:</span>
                        {{$user->jabatan}}
                    </li>
                    @endif
                    <li>
                        <span>Jenis Kelamin:</span>
                        {{$user->jk == "L" ? "Laki-laki" : "Perempuan"}}
                    </li>
                    <li>
                        <span>Alamat:</span>
                        {{$user->alamat->alamat}}
                    </li>
                </ul>
            </div>
            <div class="profile-skills">
                <h5 class="mb-20 h5 text-blue">Informasi Lapor</h5>
                <ul class="clearfix">
                    <div class="row clearfix progress-box">
                        @if ($user->roles == "user")
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <h5 class="text-light-blue padding-top-10 h5">Total Lapor</h5>
                                    <span class="d-block">{{$user->lapors->count()}} <i class="fa text-light-blue fa-line-chart"></i></span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                            <div class="card-box pd-30 height-100-p">
                                <div class="progress-box text-center">
                                    <h5 class="text-light-blue padding-top-10 h5">Total Menanggapi</h5>
                                    <span class="d-block">{{$user->tanggapans->count()}} <i class="fa text-light-blue fa-line-chart"></i></span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection