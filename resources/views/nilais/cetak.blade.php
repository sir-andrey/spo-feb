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
            <th> No </th>
            <th> NISN </th>
            <th> Nama </th>
            <th> Kelas </th>
            <th> Tahun Ajaran </th>
        </tr>
        </thead>
        <tbody>
        @foreach($siswa as $key => $data)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $data->nisn}}</td>
                <td>{{ $data->nama}}</td>
                <td>{{ $data->kelas->tingkat }}-
                    {{ $data->kelas->jurusan }}-
                    {{ $data->kelas->kelas }}</td>
                <td>{{ $data->kelas->tahun }}</td>
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