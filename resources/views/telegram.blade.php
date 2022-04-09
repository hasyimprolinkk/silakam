@extends('layouts.app')

@section('title', 'Telegram Bot')

@section('content')

@if(Auth::user()->roles == "petugas" || Auth::user()->roles == "admin")
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Bot Telegram</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bot Telegram</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 card-box mb-30">
    <div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item pt-20 pb-20">
                <h6 class="weight-400 d-flex">
                    <i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Petugas dipersilahkan untuk masuk ke channel telegram dibawah ini untuk mendapatkan notif laporan dari masyarakat secara realtime
                </h6>
                <div class="ml-md-4 mt-md-3 alert alert-success p-0">
                    <div class="p-3">
                        <a href="{{env('TELEGRAM_URL_CHANNEL')}}" target="_blank" data-color="#1b00ff">{{env('TELEGRAM_URL_CHANNEL')}}</a>
                    </div>
                </div>
        </ul>
    </div>
</div>
@else
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Bot Telegram</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bot Telegram</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 card-box mb-30">
    <div class="row align-items-center">
        <div class="col-lg">
            <div class="register-edited bg-white border-radius-10">
                <form method="POST" action="/telegram_bot">
                    @csrf
                    @method('PUT')
                        <div class="form-wrap  mx-auto">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Chat ID*</label>
                                <div class="col-sm-8">
                                    <input type="text" value="{{old('chat_id_bot', $tg)}}" name="chat_id_bot" class="form-control  @error('chat_id_bot') is-invalid @enderror" placeholder="Chat ID">
                                    @error('chat_id_bot')
                                        <div class="row mt-1">
                                            <small class="col-sm-12 text-danger">{{$message}}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Aktifkan Bot') }}</button>
                                    </div>		
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="pd-20 card-box mb-30">
    <h4 class="h4 text-blue mb-10">Cara mengaktifkan bot telegram dan mendapatkan chat ID</h4>
    <div class="alert alert-primary" role="alert">
        Catatan: setting bot telegram disini di gunakan untuk mendapatkan notifikasi tindak lanjut dari laporan anda secara realtime. pastikan anda menginstall telegram terlebih dahulu.
    </div>
    <div class="alert alert-danger" role="alert">
        Catatan: kesalahan memasukkan chat id akan mengakibatkan notifikasi tidak masuk
    </div>
    <div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item pt-20 pb-20">
                <h6 class="weight-400 d-flex">
                    <i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Silahkan aktifkan bot kami terlebih dahulu dengan cara masuk ke link bot telegram dibawah ini, kemudian klik "Mulai" atau "Start" sampai muncul text "/start" 
                </h6>
                <div class="ml-md-4 mt-md-3 alert alert-success p-0">
                    <div class="p-3">
                        <a href="{{config('TELEGRAM_URL_BOT')}}" target="_blank" data-color="#1b00ff">{{config('TELEGRAM_URL_BOT')}}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex justify-content-end">
                        <img src="{{asset('assets/img/telegram/0.jpg')}}" width="300px" alt="">
                    </div>
                    <div class="col-6">
                        <img src="{{asset('assets/img/telegram/1.jpeg')}}" width="300px" alt="">
                    </div>
                </div>
            </li>
            <li class="list-group-item pt-20 pb-20">
                <h6 class="weight-400 d-flex">
                    <i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Setelah itu, ambil chat id telegram anda dengan cara masuk ke link bot telegram dibawah, klik "mulai" atau "start",  tunggu beberapa saat sampai ada balasan :
                </h6>
                <div class="ml-md-4 mt-md-3 alert alert-success p-0">
                    <div class="p-3">
                        <a href="https://t.me/username_to_id_bot/" target="_blank" data-color="#1b00ff">https://t.me/username_to_id_bot/</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex justify-content-end">
                        <img src="{{asset('assets/img/telegram/4.jpg')}}" width="300px" alt="">
                    </div>
                    <div class="col-6">
                        <img src="{{asset('assets/img/telegram/5.jpg')}}" width="300px" alt="">
                    </div>
                </div>
                <h6 class="weight-400 d-flex">
                    <i class="mr-4" data-color="#1b00ff"></i> Silahkan copy chat id anda yang ada pada PS. Your ID tersebut
                </h6>
            </li>
            <li class="list-group-item pt-20 pb-20">
                <h6 class="weight-400 d-flex">
                    <i class="icon-copy dw dw-checked mr-2" data-color="#1b00ff"></i> Langkah terakhir, "chat ID" yang sudah diambil kemudian dimasukkan kedalam kolom chat ID diatas, kemudian klik "aktifkan bot".
                </h6>
                <div class="row mt-3">
                    <div class="col">
                        <img src="{{asset('assets/img/telegram/7.jpg')}}"  alt="">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endif

@endsection