@extends('layouts.app')

@section('title', 'Data Master Alamat')

@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Master Alamat</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Master Alamat</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#Medium-modal" href="#" role="button">
                        Tambah Alamat
                    </a>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Tabel Alamat</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Alamat</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alamat as $a)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="table-plus">{{$a->alamat}}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirmation-modal_{{$a->alamat_id}}"><i class="dw dw-delete-3"></i></a>
                                    <a class="btn btn-primary btn-sm" href="/alamat/{{$a->alamat_id}}/edit"><i class="icon-copy dw dw-pencil"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="confirmation-modal_{{$a->alamat_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center font-18">
                                            <h4 class="padding-top-30 mb-30 weight-500">Anda yakin ingin menghapusnya?</h4>
                                            <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                                    Tidak
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form_{{$a->alamat_id}}').submit();" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                                                    Ya
                                                </div>
                                                <form id="delete-form_{{$a->alamat_id}}" action="{{url("alamat/$a->alamat_id/delete")}}" method="POST">
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

    <!-- Medium modal -->
    <div class="col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Alamat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="/alamat/add" method="post">
                            @csrf
                            <div class="container">
                            <div class="form-group row mt-3">
                                <label class="col-sm-4 col-form-label">Alamat*</label>
                                <div class="col-sm-8">
                                    <input type="text" name="alamat" class="form-control  @error('alamat') is-invalid @enderror" placeholder="Dusun, RT RW" autofocus required>
                                    @error('alamat')
                                        <div class="row mt-1">
                                            <small class="col-sm-12 text-danger">{{$message}}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="sumbit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
