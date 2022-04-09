@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="row align-items-center mb-30">
    <div class="col-lg">
        <div class="register-edited bg-white box-shadow border-radius-10">
            <div class="login-title">
                <h2 class="text-center text-primary">Tambah Petugas</h2>
            </div>
            <form method="POST" action="/petugas/add">
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
                            <label class="col-sm-4 col-form-label">Jabatan*</label>
                            <div class="col-sm-8">
                                <input type="text" name="jabatan" value="{{old('jabatan')}}" class="form-control  @error('jabatan') is-invalid @enderror">
                                @error('jabatan')
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
                                <select name="alamat" class="form-control selectpicker @error('alamat') is-invalid @enderror" title="Alamat" data-size="3">
                                    @foreach ($alamat as $a)
                                        @if(old('alamat') == $a->alamat_id)
                                            <option value="{{$a->alamat_id}}" selected>{{$a->alamat}}</option>
                                        @else
                                            <option value="{{$a->alamat_id}}">{{$a->alamat}}</option>
                                        @endif			
                                    @endforeach
                                </select>
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
                    </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Submit') }}</button>
                        </div>		
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection