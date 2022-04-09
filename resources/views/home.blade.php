@extends('layouts.main')

@section('title', 'Keluhan dan Aspirasi Masyarakat')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Keluhan dan Aspirasi Masyarakat</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keluhan dan Aspirasi Masyarakat</li>
                    </ol>
                </nav>
            </div>
            @if(Auth::user()->roles == "user")
                <div class="col-md-6 col-sm-12 text-right mt-2">
                    <a class="btn btn-primary" href="/lapor" role="button">Buat Laporan</a>
                </div>
            @endif
        </div>
    </div>
    <div class="blog-wrap">
        <div class="container pd-0">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="blog-list">
                        <ul>
                            @if($lapors->count() == 0)
                                <li>
                                    <div class="chat-profile-header clearfix">
                                        <div class="left">
                                            <div class="clearfix text-center">
                                                <h4 class="text-danger"><i>Tidak ada data laporan</i></h4>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            
                            @foreach ($lapors as $l)    
                                <li>
                                    <div class="chat-profile-header clearfix">
                                        <div class="left">
                                            <div class="clearfix">
                                                <div class="chat-profile-photo">
                                                    <img src="{{asset('storage/'.$l->user->avatar)}}"
                                                        alt="">
                                                </div>
                                                <div class="chat-profile-name">
                                                    <a href="/user/{{$l->user->user_id}}">
                                                        <h3>{{$l->user->nama}}</h3>
                                                    </a>
                                                    <span>{{$l->created_at->isoFormat('LLLL')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            @if ($l->image !== null)
                                                <div class="blog-img">
                                                    <img src="{{asset('storage/'.$l->image)}}" alt="" class="bg_img">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="blog-caption">
                                                <div class="blog-by">
                                                    <p>{{$l->keterangan}}</p>
                                                    <p class="text-dark mb-15">Kategori Laporan : <span class="text-primary">{{$l->kategori->kategori}}</span></p>
                                                    <div class="pt-10">
                                                        <a href="/lapor/{{$l->lapor_id}}/tanggapan" class="btn btn-outline-primary">Selengkapnya...</a>
                                                    </div><hr>
                                                    <div class="position-static fixed-bottom">
                                                        
                                                        {{$supp = false}}
                                                        @foreach ($l->supports as $s)
                                                            @if(Auth::user()->user_id === $s->user_id)
                                                            <span class="d-none">{{$supp = true}}</span>
                                                            @endif
                                                        @endforeach

                                                        @if($supp == true)
                                                            <a href="" class="badge badge-primary" onclick="event.preventDefault(); document.getElementById('delete_{{$l->lapor_id}}').submit();">
                                                                <span><i class="icon-copy dw dw-like"></i> {{$l->supports->count()}} Dukungan</span>
                                                            </a>
                                                            <form id="delete_{{$l->lapor_id}}" action="/unsupport" method="POST" class="d-none">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="lapor_id" value="{{$l->lapor_id}}">
                                                            </form>
                                                        @else
                                                            <a href="" class="badge badge-light" onclick="event.preventDefault(); document.getElementById('support_{{$l->lapor_id}}').submit();">
                                                                <span><i class="icon-copy dw dw-like"></i> {{$l->supports->count()}} Dukungan</span>
                                                            </a>
                                                            <form id="support_{{$l->lapor_id}}" action="/support" method="POST" class="d-none">
                                                                @csrf
                                                                <input type="hidden" name="lapor_id" value="{{$l->lapor_id}}">
                                                            </form>
                                                        @endif
                                                        <a href="/lapor/{{$l->lapor_id}}/tanggapan" class="card-link badge badge-light">
                                                            <span class=""><i class="icon-copy dw dw-chat-11"></i> {{ $l->tanggapans->count() }} Tanggapan</span>
                                                        </a>
                                                        @if ($l->status == "Belum Diproses")
                                                            <span class="badge badge-warning badge-pill">Belum Diproses</span>
                                                        @elseif ($l->status == "Sedang Diproses")
                                                            <span class="badge badge-primary badge-pill">Sedang Diproses</span>
                                                        @elseif ($l->status == "Selesai")
                                                            <span class="badge badge-success badge-pill">Selesai</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{$lapors->links('layouts.paginate')}}
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card-box">
                        <h5 class="pd-20 h5 mb-0">Jumlah Laporan</h5>
                        <div class="list-group">
                            <div class="list-group-item d-flex align-items-center justify-content-between">Semua
                                <span class="badge badge-primary badge-pill">{{$lapor}}</span></div>
                            <div class="list-group-item d-flex align-items-center justify-content-between">Belum Diproses <span class="badge badge-primary badge-pill">{{$pending}}</span></div>
                            <div class="list-group-item d-flex align-items-center justify-content-between">Sedang
                                Diproses <span class="badge badge-primary badge-pill">{{$proses}}</span></div>
                            <div class="list-group-item d-flex align-items-center justify-content-between">Selesai
                                <span class="badge badge-primary badge-pill">{{$selesai}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection