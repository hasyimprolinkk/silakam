@extends('layouts.main')

@section('title', 'Tanggapan')

@section('content')

    <div class="min-height-200px">
        <div class="container">
        <div class="row justify-content-center mb-30">
            <div class="col-md-12 col-sm-12 col-lg-8">
                <div class="blog-detail card-box overflow-hidden">
                    <div class="chat-profile-header clearfix">
                        <div class="left">
                            <div class="clearfix">
                                <div class="chat-profile-photo">
                                    <img src="{{asset('storage/'.$lapor->user->avatar)}}"
                                        alt="">
                                </div>
                                <div class="chat-profile-name">
                                    <a href="/user/{{$lapor->user->user_id}}"><h3>{{$lapor->user->nama}}</h3></a>
                                    <span>{{ $lapor->created_at->isoFormat('LLLL') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($lapor->image !== null)
                        <div class="da-card box-shadow">
                            <div class="da-card-photo">
                                <img src="{{asset('storage/'.$lapor->image)}}" alt="">
                                <div class="da-overlay">
                                    <div class="da-social">
                                        <ul class="clearfix">
                                            <li><a href="{{asset('storage/'.$lapor->image)}}" data-fancybox="images"><i class="fa fa-picture-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="blog-caption">
                        <h4 class="mb-10">Keterangan</h4>
                        <p class="text-dark">{{$lapor->keterangan}}</p>
                        
                        {{-- <h4 class="mb-10">Kategori</h4> --}}
                        <p class="text-dark mb-15">Kategori Laporan : <span class="text-primary">{{$lapor->kategori->kategori}}</span></p>
                        
                        <div class="position-static fixed-bottom">
                                {{$supp = false}}
                                @foreach ($lapor->supports as $s)
                                    @if(Auth::user()->user_id === $s->user_id)
                                        <span class="d-none">{{$supp = true}}</span>
                                    @endif
                                @endforeach

                                    @if($supp == true)
                                        <a href="" class="badge badge-primary" onclick="event.preventDefault(); document.getElementById('delete').submit();">
                                            <span><i class="icon-copy dw dw-like"></i> {{$lapor->supports->count()}} Dukungan</span>
                                        </a>
                                        <form id="delete" action="/unsupport" method="POST" class="d-none">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="lapor_id" value="{{$lapor->lapor_id}}">
                                        </form>
                                    @else
                                        <a href="" class="badge badge-light" onclick="event.preventDefault(); document.getElementById('support').submit();">
                                            <span><i class="icon-copy dw dw-like"></i> {{$lapor->supports->count()}} Dukungan</span>
                                        </a>
                                        <form id="support" action="/support" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="lapor_id" value="{{$lapor->lapor_id}}">
                                        </form>
                                    @endif
                                <a href="" class="card-link badge badge-light">
                                    <span class=""><i class="icon-copy dw dw-chat-11"></i> {{$lapor->tanggapans->count()}} Tanggapan</span>
                                </a>
                            @if ($lapor->status == "Belum Diproses")
                                <span class="badge badge-warning badge-pill">Belum Diproses</span>
                            @elseif ($lapor->status == "Sedang Diproses")
                                <span class="badge badge-primary badge-pill">Sedang Diproses</span>
                            @elseif ($lapor->status == "Selesai")
                                <span class="badge badge-success badge-pill">Selesai</span>
                            @elseif ($lapor->status == "Ditolak")
                                <span class="badge badge-danger badge-pill">Ditolak</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container mb-30">
            <div class="row justify-content-center">
                <div class="card-box col-md-12 col-sm-12 col-lg-8">
                    <div class="chat-box">
                        <div class="chat-desc">
                            <ul style="margin-bottom: 30px;">
                                @foreach ($lapor->tanggapans as $t)
                                    <li class="clearfix" style="margin-bottom: 3px;">
                                        <span class="chat-img">
                                            <img src="{{asset('storage/'.$t->user->avatar)}}" alt="">
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="chat-profile-name">
                                                <a href="/user/{{$t->user->user_id}}"><small>{{$t->user->nama}}
                                                    @if($t->user->roles =="admin" || $t->user->roles == "petugas")
                                                        <span class="text-primary">({{$t->user->roles}})</span>
                                                    @endif
                                                </small></a>
                                            </div>
                                            <p>{{$t->tanggapan}}</p>
                                            <div class="chat_time">{{$t->created_at->diffForHumans()}}
                                                @if (Auth::user()->user_id == $t->user->user_id)
                                                    <a href="#" data-toggle="modal" data-target="#confirmation-modal_{{$t->tanggapan_id}}" class="ml-2 text-danger"><i class="icon-copy dw dw-delete-3"></i> hapus</a>
                                                    <div class="modal fade" id="confirmation-modal_{{$t->tanggapan_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body text-center font-18">
                                                                    <h4 class="padding-top-30 mb-30 weight-500">Hapus Tanggapan?</h4>
                                                                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                                                        <div class="col-6">
                                                                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                                                            Tidak
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form_{{$t->tanggapan_id}}').submit();" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                                                                            Ya
                                                                        </div>
                                                                        <form id="delete-form_{{$t->tanggapan_id}}" action="{{url('tanggapan/'. $t->tanggapan_id . '/delete')}}" method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="chat-footer mt-30">
                            <form action="/tanggapan" method="POST">
                                @csrf
                                <input type="hidden" name="lapor_id" value="{{$lapor->lapor_id}}">
                                <div class="chat_text_area">
                                    <textarea name="tanggapan" placeholder="Masukkan Tanggapan…"></textarea>
                                </div>
                                <div class="chat_send">
                                        <button class="btn btn-link" type="submit"><i class="icon-copy ion-paper-airplane"></i></button>
                                    </div>
                                </div>
                            </form>
                            @error('tanggapan')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection