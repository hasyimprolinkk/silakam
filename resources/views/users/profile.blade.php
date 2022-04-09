@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <img src="{{asset('storage/'.$user->avatar)}}" alt="" style="width: 150px; height: 150px;" class="avatar-photo">
            </div>
            <h5 class="text-center h5 mb-0">{{$user->nama}}</h5>
            <div class="text-center">
                <span class="badge badge-info badge-pill">{{$user->username}}</span>
            </div>
            <p class="text-center text-muted font-14">Terdaftar pada {{$user->created_at->isoFormat('D MMMM Y')}}</p>
            <div class="profile-info">
                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                <ul>
                    <li>
                        <span>NIK:</span>
                        {{$user->nik}}
                    </li>
                    <li>
                        <span>Jenis Kelamin:</span>
                        {{$user->jk == 'L' ? 'Laki-Laki' : 'Perempuan'}}
                    </li>
                    @if ($user->roles == "admin" || $user->roles == "petugas")
                        <li>
                            <span>Jabatan:</span>
                            {{$user->jabatan}}
                        </li>
                    @endif
                    <li>
                        <span>Alamat:</span>
                        {{$user->alamat->alamat}}
                    </li>
                    <li>
                        <span>Nomor HP:</span>
                        {{$user->no_hp}}
                    </li>
                    <li>
                        <span>Status:</span>
                        @if ($user->is_active == 1)
                            <div class="badge badge-primary">Aktif</div>        
                        @elseif ($user->is_active == 0)
                            <div class="badge badge-danger">Nonaktif</div>    
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Setting Tab start -->
                        <div class="tab-pane fade height-100-p show active" id="timeline" role="tabpanel">
                            <div class="profile-setting">
                                <form method="POST" action="/profile" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <ul class="profile-edit-list row">
                                        <li class="weight-500 col-md-12">
                                            {{-- <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4> --}}
                                            <div class="form-group">
                                                <label>NIK*</label>
                                                <input class="form-control form-control-lg" value="{{$user->nik}}" readonly type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Username*</label>
                                                <input class="form-control form-control-lg" name="username" value="{{$user->username ?? old('username')}}" type="text">
                                            </div>
                                            @error('username')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
                                            <div class="form-group">
                                                <label>Nama*</label>
                                                <input class="form-control form-control-lg" name="nama" value="{{$user->nama ?? old('nama')}}" type="text">
                                            </div>
                                            @error('nama')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
                                            <div class="form-group">
                                                <label>Jenis Kelamin*</label>
                                                <div class="d-flex">
                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                    <input type="radio" id="l" name="jk" value="L" class="custom-control-input" {{old('jk',$user->jk) == "L" ? "checked" : ""}}>
                                                    <label class="custom-control-label weight-400" for="l">Laki</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" id="p" name="jk" value="P" class="custom-control-input" {{old('jk',$user->jk) == "P" ? "checked" : ""}}>
                                                    <label class="custom-control-label weight-400" for="p">Perempuan</label>
                                                </div>
                                                </div>
                                            </div>
                                            @error('jk')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
                                            @if ($user->roles == "admin" || $user->roles == "petugas")
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input class="form-control form-control-lg date-picker" name="jabatan" value="{{$user->jabatan ?? old('jabatan')}}" type="text">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label>Alamat / Dusun*</label>
                                                <select name="alamat" class="form-control selectpicker @error('alamat') is-invalid @enderror" title="Alamat" data-size="3">
                                                    @foreach ($alamat as $a)
                                                        @if(old('alamat', $user->alamat->alamat_id) == $a->alamat_id)
                                                            <option value="{{$a->alamat_id}}" selected>{{$a->alamat}}</option>
                                                        @else
                                                            <option value="{{$a->alamat_id}}">{{$a->alamat}}</option>
                                                        @endif			
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('alamat')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
                                            <div class="form-group">
                                                <label>Nomor HP*</label>
                                                <input class="form-control form-control-lg" name="no_hp" value="{{$user->no_hp ?? old('no_hp')}}" type="number">
                                            </div>
                                            @error('no_hp')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
                                            <div class="form-group">
                                                <label>Photo Profile</label>
                                                <div class="custom-file">
                                                    <input type="file" name="avatar" class="custom-file-input @error('avatar') is-invalid @enderror">
                                                    <label class="custom-file-label">Pilih Gambar</label>
                                                </div>
                                            </div>
                                            @error('avatar')
												<div class="row mt-1">
													<small class="col-sm-12 text-danger">{{$message}}</small>
												</div>
											@enderror
                                            <div class="row mt-5 d-flex justify-content-center">
                                                <div class="col-sm-6 col-lg-6">
                                                    <div class="input-group mb-0">
                                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                                                    </div>		
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- Setting Tab End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection