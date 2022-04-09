<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SILAKAM | Sistem Informasi Layanan Keluhan dan Aspirasi Masyarakat</title>
    <style>
        .page_break { page-break-before: always; }

        @page{
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
        }

        .table-bordered {
            border: 1px solid black;
        }

        th{
            text-align: left;
        }

        .table, .bordir {
            border: 1px solid black;
            border-collapse: collapse;
        }
    
        hr.solid {
        border-top: 2px solid #000000;
        }

        #data{
            width: 100%;
        }
      </style>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> --}}
</head>

<body>

    <table>
        <tr>
            <td><img src="{{public_path('assets\img\logo.png')}}" width="80px" class="mr-3" alt=""></td>
            <td>
                <div style="text-align: center;">
                    <h1 style="margin-bottom: -15px;">Sistem Informasi Layanan Keluhan dan Aspirasi Masyarakat</h1>
                    <h4>Desa Liprak Kulon, Kec. Banyuanyar, Kab. Probolinggo</h5>
                </div>
            </td>
        </tr>
    </table>
        <hr class="solid">
        <div>
            <h4>Detail Laporan</h4>
            <h4>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h4>
        </div>
        <hr class="solid">
        <div>
            <table  cellpadding="5">
                <tr>
                    <td>Tanggal Laporan</td>
                    <td>: {{date('d F Y',strtotime($from_date))}} s/d {{date('d F Y',strtotime($to_date))}}</td>
                </tr>
                <tr>
                    <td>Total Laporan</td>
                    <td>: {{$lapors->count()}} Laporan</td>
                </tr>
                <tr>
                    <td>Belum diproses</td>
                    <td>: {{$lapors->where('status', 'Belum Diproses')->count()}} Laporan</td>
                </tr>
                <tr>
                    <td>Sedang diproses</td>
                    <td>: {{$lapors->where('status', 'Sedang Diproses')->count()}} Laporan</td>
                </tr>
                <tr>
                    <td>Selesai</td>
                    <td>: {{$lapors->where('status', 'Selesai')->count()}} Laporan</td>
                </tr>
            </table>
        </div>

        {{-- <hr class="solid"> --}}
        @foreach ($lapors as $l)
        <div class="page_break">
            <table>
                <tr>
                    <td><img src="{{public_path('assets\img\logo.png')}}" width="80px" class="mr-3" alt=""></td>
                    <td>
                        <div style="text-align: center;">
                            <h1 style="margin-bottom: -15px;">Sistem Informasi Layanan Keluhan dan Aspirasi Masyarakat</h1>
                            <h4>Desa Liprak Kulon, Kec. Banyuanyar, Kab. Probolinggo</h5>
                        </div>
                    </td>
                </tr>
            </table>
                <hr class="solid">
                <div>
                    <h4 style="margin-top: 4px; margin-bottom: -15px;">Detail Laporan</h4>
                    <h4>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h4>
                </div>
                <hr class="solid">
                <br>
                <div style="margin-top: 3px; margin-bottom: 3px;">
                    <table id="data">
                        <tr>
                            <td>NIK</td>
                            <td class="">: {{ $l->user->nik }}</td>
                            @isset($l->image)
                                <td rowspan="5" align="center">
                                    <img src="{{ base64_decode($l->images)}}" width="150px" alt="">
                                </td>
                            @endisset
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $l->user->nama }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $l->user->alamat->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="mr-3">Tanggal Lapor</td>
                            <td>: {{ $l->created_at->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>: {{ $l->user->no_hp }}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <table style="width: 100%;" cellpadding="5" class="table">
                        <tr>
                            <th class="bordir" style="text-align: left; width: 60%;" scope="col">Keterangan</th>
                            <th class="bordir" style="text-align: left; width: 20%;">Kategori</th>
                            <th class="bordir" style="text-align: left; width: 20%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordir">{{ $l->keterangan }}</td>
                            <td class="bordir">{{ $l->kategori->kategori }}</td>
                            <td class="bordir">{{ $l->status }}</td>
                        </tr>
                    </tbody>
                </table>
        </div>
        @endforeach

</body>

</html>