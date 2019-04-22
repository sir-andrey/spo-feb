@php
use App/Nilai;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Data Nilai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <style type="text/css">
        .styletable {
            border:1px solid black ;
            width: 100%;
        }

        th, td {
            font-family: sans-serif;
            text-align: center;
            padding: 3px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #0000ff;
            color: white;
        }
        h3 {
            font-family: sans-serif;
        }

    </style>
</head>
<body>
<div class="head">
    <p><img src="c:/image/smkn2.png" width="100px" height="100px" style="float:left;">
    <p><img src="c:/image/jabar1.png" width="100px" height="100px" style="float:right;">
    <p align="center">PEMERINTAH PROVINSI JAWA BARAT<br>
        DINAS PENDIDIKAN<br>
        <strong>Laporan Data Siswa </strong> <br>
        SMK NEGERI 2 CIMAHI<br>

        JL. Kamarung KM. 1,5 No. 69 , RT/RW 2/5, Dsn. -,
        Ds./Kel Citeureup, Kec. Cimahi Utara, Kota Cimahi, Prop. Jawa Barat<br>
        <b>Telepon :</b> 022-6656088    <b>Fax :</b> 022-66560         <b>Email :</b> smkn2cmi@yahoo.com        <b>Website :</b> http://smkn2cmi.sch.id</p>
    <hr />
    <br>
    <p align="center" ><strong> Data Siswa </strong></p>
    <table class="styletable">
        <thead>
                    <tr>
                        
                    </tr>
                    <tr> 
                        <th rowspan="3">No.</th>
                        <th rowspan="3">NISN</th>
                        <th rowspan="4">Nama</th>
                        <th rowspan="3">Mapel</th>
                        <th colspan="14" style="text-align: center;">Semester</th>
                        <th rowspan="3">Total</th>
                        
                    </tr>
                    <tr>
                        <th colspan="7" style="text-align: center;">Ganjil</th>
                        <th colspan="7" style="text-align: center;">Genap</th>
                        
                        
                    </tr>
                    <tr>
                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                        <th>Total</th>

                        <th>N1</th>
                        <th>N2</th>
                        <th>N3</th>
                        <th>PTS</th>
                        <th>PAS</th>
                        <th>NA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach( $datanilai as $key => $siswa )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $siswa->siswa->nisn }}</td>
                                <td>{{ $siswa->siswa->nama_siswa }}</td>
                                <td>{{ $siswa->mapel->nama_mapel }}</td>
                                @php
                                    $nilai = Nilai::where('id_siswa', $siswa->id_siswa)->where('id_mapel', $siswa->id_mapel)->get();
                                @endphp
                                @foreach($nilai as $key => $nilais)
                                <td>{{ $nilais->n1 }}</td>
                                <td>{{ $nilais->n2 }}</td>
                                <td>{{ $nilais->n3 }}</td>
                                <td>{{ $nilais->pts }}</td>
                                <td>{{ $nilais->pas }}</td>                     
                                <td>{{ ($nilais->n1 + $nilais->n2 + $nilais->n3 + $nilais->pts + $nilais->pas) / 5 }}</td>
                                <td>{{ $nilais->n1 + $nilais->n2 + $nilais->n3 + $nilais->pts + $nilais->pas }}</td>
                                @endforeach
                                <td></td>

                            </tr>
                        @endforeach
                </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>




</div>
</body>


</html>