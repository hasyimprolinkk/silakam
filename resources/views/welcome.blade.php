<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SILAKAM | Sistem Informasi Layanan Keluhan dan Aspirasi Masyarakat</title>

    <link href="{{ asset('assets/vendors/styles/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/src/plugins/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/favicon.svg')}}">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="leading-normal tracking-normal" style="font-family: 'Montserrat', sans-serif">

    <nav class="navbar navbar-expand-lg navbar-light bg-blue-200">
        <div class="container mt-3">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active mr-3" href="/home">Home <span class="sr-only">(current)</span></a>
                {{-- <a class="nav-link active mr-3" href="/bantuan">Bantuan</a> --}}
                <a class="nav-link active mr-3" href="#tata-cara">Tata Cara</a>
                @if(!Auth::check())
                    <a class="btn btn-primary mr-3" href="/register">Register</a>
                    <a class="btn btn-outline-primary mr-3" href="/login">Login</a>
                @endif
            </div>
        </div> 
    </div>
    </nav>
    <!-- Header -->

    <!--Hero-->
    <div class="pt-10 px-2 bg-blue-200">
        <div class="px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="mr-5"></div>
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start md:text-left text-gray-800">
                <h1 class="my-4 text-4xl font-bold leading-tight">
                    <span class="text-primary">S</span>istem <span class="text-primary">I</span>nformasi <span class="text-primary">La</span>yanan <span class="text-primary">K</span>eluhan dan <span class="text-primary">A</span>spirasi <span class="text-primary">M</span>asyarakat Desa Liprak Kulon
                </h1>
                <p class="leading-normal text-1xl mb-8">
                    Sampaikan keluhan dan aspirasi Anda di sini, kami akan memprosesnya
                    dengan cepat.
                </p>
                <a href="{{ url('/lapor')}}" class="btn btn-primary btn-lg pb-10 mb-5">Laporkan!</a>
            </div>
            <div class="mr-5"></div>
            <div class="w-full md:w-2/4 text-center mb-5 pt-5">
                <img class="object-fill mx-300 transform transition hover:scale-110 duration-300 ease-in-out"
                    src="{{ asset('assets/img/bg-landing.svg')}}" />
            </div>
        </div>
    </div>

    <!-- How -->
    <div id="tata-cara" class="container my-20 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-md text-gray-800">
                    <img alt="Tulis"
                        class="block h-auto lg:w-28 mx-auto my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('assets/img/tulis.svg')}}" />
                    <header class="leading-tight p-2 md:p-4 text-center ">
                        <h1 class="text-lg font-bold">1. Tulis Laporan</h1>
                        <p class="text-grey-darker text-sm py-4">
                            Tulis laporan keluhan dan aspirasi Anda dengan jelas.
                        </p>
                    </header>
                </article>
                <!-- END Article -->
            </div>
            <!-- END Column -->
            <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-md text-gray-800">
                    <img alt="Proses"
                        class="block h-auto lg:w-28 mx-auto my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('assets/img/processing.svg')}}" />
                    <header class="leading-tight p-2 md:p-4 text-center">
                        <h1 class="text-lg font-bold">2. Proses Verifikasi</h1>
                        <p class="text-grey-darker text-sm py-4">
                            Tunggu sampai laporan Anda di verifikasi.
                        </p>
                    </header>
                </article>
                <!-- END Article -->
            </div>
            <!-- END Column -->
            <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-md text-gray-800">
                    <img alt="Ditindak"
                        class="block h-auto lg:w-28 mx-auto my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('assets/img/act.svg')}}" />
                    <header class="leading-tight p-2 md:p-4 text-center">
                        <h1 class="text-lg font-bold">3. Tindak Lanjut</h1>
                        <p class="text-grey-darker text-sm py-4">
                            Laporan Anda sedang dalam tindak lanjut.
                        </p>
                    </header>
                </article>
                <!-- END Article -->
            </div>
            <!-- END Column -->
            <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-md text-gray-800">
                    <img alt="Selesai"
                        class="block h-auto lg:w-28 mx-auto my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('assets/img/verification.svg')}}" />
                    <header class="leading-tight p-2 md:p-4 text-center">
                        <h1 class="text-lg font-bold">4. Selesai</h1>
                        <p class="text-grey-darker text-sm py-4">
                            Laporan pengaduan telah selesai ditindak.
                        </p>
                    </header>
                </article>
                <!-- END Article -->
            </div>
            <!-- END Column -->
        </div>
    </div>


    <div class="pt-10 px-2 bg-blue-200">
        <div class="px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="mr-5"></div>
            <div class="w-full md:w-2/4 text-center mb-5 pt-5">
                <img class="object-fill mx-300 transform transition hover:scale-110 duration-300 ease-in-out"
                src="{{ asset('assets/img/telegram_left_2.png')}}" />
            </div>
            <div class="mr-5"></div>
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start md:text-left text-gray-800">
                <h1 class="my-4 text-4xl font-bold leading-tight">
                    Terintegrasi dengan notifikasi bot Telegram
                </h1>
                <p class="leading-normal text-1xl mb-5">
                    Aktifkan telegram bot dan dapatkan notifikasi tindak lanjut dari laporan anda.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center font-medium bg-blue-200 py-5">
        SILAKAM | By
        <a href="" class="text-blue-500" target="_blank">Hasyim Asy'ari</a>
    </footer>
    <script src="{{ asset('assets/src/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/bootstrap/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets') }}/vendors/scripts/app.js"></script>
</body>

</html>