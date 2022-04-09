@extends('layouts.app')

@section('title', 'Semua Laporan')

@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Laporan</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Laporan</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            {{request()->input('category') == "" ? "Kategori" : request()->input('category')}}
                            
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/data_complaint">Semua</a>
                            <a class="dropdown-item" href="?category=belum">Belum diproses</a>
                            <a class="dropdown-item" href="?category=proses">Sedang diproses</a>
                            <a class="dropdown-item" href="?category=selesai">Selesai</a>
                            <a class="dropdown-item" href="?category=publik">Publik</a>
                            <a class="dropdown-item" href="?category=privasi">Privasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Tabel Laporan Keluhan dan Aspirasi Masyarakat</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th class="table-plus datatable-nosort">Gambar</th>
                            <th class="table-plus datatable-nosort">Nama</th>
                            <th>Tanggal</th>
                            <th>Pemirsa</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Kategori</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lapors as $l)
                            <tr>
                                <td class="table-plus">{{$loop->iteration}}</td>

                                <td class="table-plus">
                                    @if($l->image)
                                        <img style="width:40%;" src="{{asset('storage/'.$l->image)}}" alt="">
                                    @else
                                        <span class="text-warning">Tidak ada Gambar</span>
                                    @endif
                                </td>
                                <td class="table-plus">{{$l->user->nama}}</td>

                                <td>{{$l->created_at->isoFormat('D MMMM Y, HH:m')}} WIB</td>

                                <td>
                                    @if ($l->is_public == 1)
                                        <span class="badge badge-primary">Publik</span>
                                    @else
                                        <span class="badge badge-warning">Privasi</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($l->status == "Belum Diproses")
                                        <span class="badge badge-warning">Belum Diproses</span>
                                    @elseif ($l->status == "Sedang Diproses")
                                        <span class="badge badge-primary">Sedang Diproses</span>
                                    @elseif ($l->status == "Selesai")
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>

                                <td>{{$l->keterangan}}</td>

                                <td>{{$l->kategori->kategori }}</td>

                                <td>
                                    <a class="mr-3" href="/data_lapor/{{$l->lapor_id}}/lihat"><i class="dw dw-eye"></i></a>
                                    <a class="" href="#" data-toggle="modal" data-target="#confirmation-modal_{{$l->lapor_id}}" class="btn btn-lg btn-danger"><i class="dw dw-delete-3"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="confirmation-modal_{{$l->lapor_id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                    <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form_{{$l->lapor_id}}').submit();" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                                                    Ya
                                                </div>
                                                <form id="delete-form_{{$l->lapor_id}}" action="{{url('data_lapor/delete', $l->lapor_id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

@endsection