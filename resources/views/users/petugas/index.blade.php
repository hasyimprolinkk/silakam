@extends('layouts.app')

@section('title', 'Data Petugas')

@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Petugas</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Petugas</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a class="btn btn-primary" href="/petugas/add" role="button">
                        Tambah Petugas
                    </a>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Tabel Petugas</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="table-plus datatable-nosort">NIK</th>
                            <th class="table-plus datatable-nosort">Nama</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="table-plus">{{$user->nik}}</td>
                                <td>{{$user->nama}}</td>
                                @if ($user->is_active == 1)
                                    <td><span class="badge badge-primary">Aktif</span></td>
                                @elseif ($user->is_Active == 0)
                                    <td><span class="badge badge-danger">Nonaktif</span></td>
                                @endif
                                <td><span class="badge badge-warning">{{$user->roles}}</span></td>
                                <td>
                                    <a class="mr-3" href="/petugas/{{$user->user_id}}"><i class="dw dw-eye"></i></a>
                                    <a class="" href="#" data-toggle="modal" data-target="#confirmation-modal_{{$user->user_id}}" class="btn btn-lg btn-danger"><i class="dw dw-delete-3"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="confirmation-modal_{{$user->user_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center font-18">
                                            <h4 class="padding-top-30 mb-30 weight-500">Data tanggapan dan support dari petugas ini akan ikut terhapus. Anda yakin ingin menghapusnya?</h4>
                                            <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                                    Tidak
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form_{{$user->user_id}}').submit();" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                                                    Ya
                                                </div>
                                                <form id="delete-form_{{$user->user_id}}" action="{{url('delete_user', $user->user_id)}}" method="POST">
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