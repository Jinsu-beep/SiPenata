<!DOCTYPE html>
<html>
<head>
	<title>Laporan Menara</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Menara</h5>
        <br>
	</center>
 
	<table id="example2" class="table table-bordered table-hover">
        <thead class="text-center">
            <tr>
                <th width="25px">No.</th>
                <th width="100px">Nama Perusahaan</th>
                <th width="100px">No Menara</th>
                <th width="100px">Kecamatan</th>
                <th width="100px">Ketinggian Menara</th>
                <th width="100px">Titik Koordinat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menara as $m)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $m->PemilikMenara->Perusahaan->nama }}</td>
                    <td class="text-center">{{ $m->no_menara }}</td>
                    <td class="text-center">{{ $m->Kecamatan->nama }}</td>
                    <td class="text-center">{{ $m->tinggi_menara }}</td>
                    <td class="text-center">{{ $m->lat }}, {{ $m->long }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
</body>
</html>