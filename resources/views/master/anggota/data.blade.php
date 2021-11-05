@extends('main')

@section('card-header')

<div class="card-header">
    LIST ANGGOTA
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <a class='btn btn-primary btn-sm' href="{{ url('master/anggota/add')}}">Tambah</a><br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
                <tr>
                    <th>Nama Pimpinan</th>
                    <th>Kepolisian</th>
                    <th>NRP</th>	
                    <th>Nama Lengkap</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Pekerjaan</th>
                    <th>Pangkat</th>
                    <th>Jabatan</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Opsi</th>
                    </tr>
                    <tbody>
                        @foreach ($dataAnggota as $item)
                        <tr>
                            <td>{{ $item->Nama_p}}</td>
                            <td>{{ $item->nama_kep}}</td>
                            <td>{{ $item->NRP}}</td>
                            <td>{{ $item->Nama}}</td>
                            <td>{{ $item->Tempat_lhr}}, {{ $item->Tanggal_lhr}}</td>
                            <td>{{ $item->Pekerjaan}}</td>
                            <td>{{ $item->Pangkat}}</td>
                            <td>{{ $item->Jabatan}}</td>
                            <td>{{ $item->Agama}}</td>
                            <td>{{ $item->Alamat}}</td>
                            <td>{{ $item->Nama_bapak}}</td>
                            <td>{{ $item->Nama_ibu}}</td>
                            <td>
                                <a href="{{url('master/anggota/edit')}}/{{ $item->NRP }}"><i class='material-icons text-success sm'>create</i></a>
                                <!-- <a href="admin.php?target=anggota&action=delete&id={{ $item->NRP}}"><i class='material-icons text-danger'>delete</i></a> -->
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
            </table>
        </div>
    </div>
 </div>
@endsection