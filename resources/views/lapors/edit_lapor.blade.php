@extends('layouts.app')
@section('title', 'Edit Laporan')
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Laporan Saya</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Edit Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Gambar</label>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror">
                    <label class="custom-file-label">Pilih Gambar</label>
                </div>
                @error('image')
                    <div class="row mt-3">
                        <small class="col-sm-12 text-danger">{{$message}}</small>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Keterangan (Keluhan atau Aspirasi)*</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{old('keterangan', $lapor->keterangan)}}</textarea>
                @error('keterangan')
                    <div class="row mt-3">
                        <small class="col-sm-12 text-danger">{{$message}}</small>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <select name="kategori" class="form-control selectpicker @error('kategori') is-invalid @enderror" title="kategori" data-size="3">
                    @foreach ($kategori as $k)
                        @if(old('kategori', $lapor->kategori->kategori_id) == $k->kategori_id)
                            <option value="{{$k->kategori_id}}" selected>{{$k->kategori}}</option>
                        @else
                            <option value="{{$k->kategori_id}}">{{$k->kategori}}</option>
                        @endif			
                    @endforeach
                </select>
                @error('kategori')
                    <div class="row mt-3">
                        <small class="col-sm-12 text-danger">{{$message}}</small>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label>Pemirsa *</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="pemirsa1" value="1" name="is_public" class="custom-control-input" {{old('is_public', $lapor->is_public) == '1' ? 'checked' : ''}} onclick="showKet()">
                            <label class="custom-control-label mr-5" for="pemirsa1">Publik</label>
                        </div>
                        <small class="form-text text-muted mb-5" id="ket1" style="display: none;">
                            Semua Masyarakat bisa melihat
                        </small>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="pemirsa2" value="0" name="is_public" class="custom-control-input" {{old('is_public', $lapor->is_public) == '0' ? 'checked' : ''}} onclick="showKet()">
                            <label class="custom-control-label" for="pemirsa2">Privasi</label>
                        </div>
                        <small class="form-text text-muted" id="ket2" style="display: none;">
                            Hanya Admin dan Petugas yang bisa melihat
                        </small>
                        @error('is_public')
                            <div class="row mt-3">
                                <small class="col-sm-12 text-danger">{{$message}}</small>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showKet(){
        var publik = document.getElementById("pemirsa1");
        var private = document.getElementById("pemirsa2");
        var ket1 = document.getElementById("ket1");
        var ket2 = document.getElementById("ket2");
        if(publik.checked){
            ket1.style.display = "block";
            ket2.style.display = "none";
        }else if(private.checked){
            ket2.style.display = "block";
            ket1.style.display = "none";
        }
    }
</script>

@endsection