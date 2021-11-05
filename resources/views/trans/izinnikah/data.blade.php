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
        <a class='btn btn-primary btn-sm' href="{{ url('trans/izinnikah/add')}}">Tambah</a><br><br>
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
                        @if($item->status_izinp=="ACC" && $item->status_izins=="ACC" && $item->status_izinr=="ACC")
                        <td>
                            <div class="dropdown btn-group m-r-xs m-b-xs">
                                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                    CETAK
                                    <span class="caret">
                                    </span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="file_data/izin/views/c_izinp.php?id=">
                                    Surat Izin Pimpinan
                                    </a>
                                    <a class="dropdown-item" href="file_data/izin/views/c_izin.php?id=">
                                    Surat Izin Kawin
                                    </a>
                                    <a class="dropdown-item" href="file_data/izin/views/c_sanggupa.php?id=">
                                    Surat Sanggup Dari Anggota
                                    </a>
                                    <a class="dropdown-item" href="file_data/izin/views/c_sanggupc.php?id=">
                                    Surat Sanggup Dari Calon Pasangan
                                    </a>
                                    <a class="dropdown-item" href="file_data/izin/views/c_sanggupwa.php?id=">
                                    Surat Setuju Dari Wali Anggota
                                    </a>
                                    <a class="dropdown-item" href="file_data/izin/views/c_sanggupwc.php?id=">
                                    Surat Setuju Dari Wali Calon Pasangan
                                    </a>
                                </div>
                            </div>
                        </td>
                        @else
                        <td>
                            <a href="{{url('trans/izinnikah/edit')}}/{{ $item->id_izin}}"><i class='material-icons text-success sm'>create</i></a>
                            <a href="{{url('izinnikah/delete')}}/{{ $item->id_izin}}" onClick="return confirm(Apakah Anda Yakin Ingin Menghapus Data Ini?)"><i class='material-icons text-danger'>delete</i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
 </div>
@endsection