@extends('main')

@section('card-header')

<div class="card-header">
    ACC SURAT IZIN NIKAH
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <a class='btn btn-primary btn-sm' href="{{ url('trans/izincerai/add')}}">Tambah</a><br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
                <thead>
                    <tr>
                        <th>Nomor SIK</th>
                        <th>Nama Anggota</th>
                        <th>NRP</th>	
                        <th>Pangkat</th>
                        <th>Jabatan</th>
                        <th>Calon Pasangan</th>
                        <th>Pekerjaan</th>
                        <th>Pimpinan Bagian</th>
                        <th>Polsek</th>
                        <th>Polres</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataIzinNikah as $item)
                    <tr>
                        <td>{{ $item->nomor_sik}}</td>
                        <td>{{ $item->Nama}}</td>
                        <td>{{ $item->NRP}}</td>
                        <td>{{ $item->Pangkat}}</td>
                        <td>{{ $item->Jabatan}}</td>
                        <td>{{ $item->Nama_c}}</td>
                        <td>{{ $item->Pekerjaan_c}}</td>
                        <td>{{ $item->status_izinp}}</td>
                        <td>{{ $item->status_izins}}</td>
                        <td>{{ $item->status_izinr}}</td>
                        <td>
                            <a href="admin.php?target=anggota&action=edit&id={{ $item->NRP}}"><i class='material-icons text-success sm'>create</i></a>
                            <a href="admin.php?target=anggota&action=delete&id={{ $item->NRP}}"><i class='material-icons text-danger'>delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
 </div>
@endsection