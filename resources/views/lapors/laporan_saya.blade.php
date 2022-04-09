@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Laporan Saya</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Saya</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Tabel Laporan Keluhan dan Aspirasi Saya</h4>
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
                            <th>Laporan</th>
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
                                    <a class="mr-3" href="/laporan_saya/{{$l->lapor_id}}/lihat"><i class="dw dw-eye"></i></a>
                                    <a class="mr-3" href="/laporan_saya/{{$l->lapor_id}}/edit"><i class="dw dw-edit-2"></i></a>
                                    <a class="" href="#"><i class="dw dw-delete-3"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection