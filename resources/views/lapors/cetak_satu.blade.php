<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SILAKAM | Sistem Informasi Layanan Keluhan dan Aspirasi Masyarakat</title>
    <style>
        @page{
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
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
            <h4 style="margin-top: 4px; margin-bottom: -15px;">Detail Laporan</h4>
            <h4>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</h4>
        </div>
        <hr class="solid">
        <br>
        <div style="margin-top: 3px; margin-bottom: 3px;">
            <table id="data">
                <tr>
                    <td>NIK</td>
                    <td class="">: {{ $lapor->user->nik }}</td>
                    @isset($lapor->image)
                        <td rowspan="5" align="center">
                            <img src="{{ base64_decode($lapor->images)}}" width="150px" alt="">
                        </td>
                    @endisset
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $lapor->user->nama }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $lapor->user->alamat->alamat }}</td>
                </tr>
                <tr>
                    <td class="mr-3">Tanggal Lapor</td>
                    <td>: {{ $lapor->created_at->isoFormat('D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>: {{ $lapor->user->no_hp }}</td>
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
                    <td class="bordir">{{ $lapor->keterangan }}</td>
                    <td class="bordir">{{ $lapor->kategori->kategori }}</td>
                    <td class="bordir">{{ $lapor->status }}</td>
                </tr>
            </tbody>
        </table>

</body>

</html>