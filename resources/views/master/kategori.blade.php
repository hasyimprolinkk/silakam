@extends('layouts.app')

@section('title', 'Data Master Kategori')

@section('content')

    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Master Kategori</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Master Kategori</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#Medium-modal" role="button">
                        Tambah Kategori
                    </a>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Tabel Kategori</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Kategori</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $k)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="table-plus">{{$k->kategori}}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#confirmation-modal_{{$k->kategori_id}}" class="btn btn-lg btn-danger"><i class="dw dw-delete-3"></i></a>
                                    <a class="btn btn-primary btn-sm" href="/kategori/{{$k->kategori_id}}/edit"><i class="icon-copy dw dw-pencil"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="confirmation-modal_{{$k->kategori_id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                    <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form_{{$k->kategori_id}}').submit();" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                                                    Ya
                                                </div>
                                                <form id="delete-form_{{$k->kategori_id}}" action="{{url("kategori/$k->kategori_id/delete")}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </tr>
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
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Kategori</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="/kategori/add" method="post">
                            @csrf
                            <div class="container">
                            <div class="form-group row mt-3">
                                <label class="col-sm-4 col-form-label">Kategori*</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kategori" class="form-control  @error('kategori') is-invalid @enderror" placeholder="Kategori" autofocus required>
                                    @error('kategori')
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