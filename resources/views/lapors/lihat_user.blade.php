@extends('layouts.app')

@section('title', 'Lihat Laporan Saya')

@section('content')

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Lihat Laporan</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/data_lapor">Data Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lihat Laporan Saya</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="profile-info">
            <h5 class="mb-20 h5 text-blue">Informasi Laporan</h5>
            <ul>
                <li>
                    <span>NIK:</span>
                    {{$lapor->user->nik}}
                </li>
                <li>
                    <span>Nama:</span>
                    {{$lapor->user->nama}}
                </li>
                <li>
                    <span>Nomor Telp:</span>
                    {{$lapor->user->no_hp}}
                </li>
                <li>
                    <span>Kategori:</span>
                    {{$lapor->kategori->kategori}}
                </li>
                <li>
                    <span>Tanggal:</span>
                    {{$lapor->created_at->isoFormat('D MMMM Y, HH:m')}} WIB
                </li>
                <li>
                    <span>Pemirsa:</span>
                    @if ($lapor->is_public == "1")
                        <div class="badge badge-primary">Publik</div>
                    @else
                        <div class="badge badge-warning">Privasi</div>
                    @endif
                </li>
                <li>
                    <span>Status:</span>
                    @if ($lapor->status == "Belum Diproses")
                        <div class="badge badge-warning">Belum Diproses</div>
                    @elseif ($lapor->status == "Sedang Diproses")
                        <div class="badge badge-primary">Sedang Diproses</div>
                    @elseif ($lapor->status == "Selesai")
                        <div class="badge badge-success">Selesai</div>
                    @elseif ($lapor->status == "Ditolak")
                        <div class="badge badge-danger">Ditolak</div>
                    @endif
                </li>
                <li>
                    <span>Petugas:</span>
                    {{$lapor->petugas->nama ?? "-"}} 
                </li>
            </ul>
        </div>
    </div>

    <div class="row mb-30">
        <div class="col-md-12 col-sm-12">
            <div class="blog-detail card-box overflow-hidden">
                
                @isset($lapor->image)
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
                @endisset

                <div class="blog-caption">
                    <h4 class="mb-10">Keterangan</h4>
                    <p class="text-dark">{{$lapor->keterangan}}</p>
                </div>
                
            </div>
        </div>
    </div>
    <div class="card-box mb-30 p-2">
            @if($lapor->status == "Belum Diproses")
                <a href="/laporan_saya/{{$lapor->lapor_id}}/edit" class="btn btn-lg btn-primary">Edit</a>
                <a href="#" data-toggle="modal" data-target="#confirmation-modal" class="btn btn-lg btn-danger">Hapus</a>
            @endif    
            <a href="/lapor/{{$lapor->lapor_id}}/tanggapan" class="btn btn-lg btn-secondary" target="_blank">Lihat Tanggapan</a>
    </div>
</div>

@if($lapor->status == "Belum Diproses")
<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Data Tanggapan dan Support dari laporan ini akan terhapus juga. Anda yakin ingin menghapusnya?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        Tidak
                    </div>
                    <div class="col-6">
                        <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                        Ya
                    </div>
                    <form id="delete-form" action="/laporan_saya/{{$lapor->lapor_id}}/delete" method="POST">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection