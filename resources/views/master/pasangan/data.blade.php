@extends('main')

@section('card-header')

<div class="card-header">
    LIST PASANGAN
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection

@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <a class='btn btn-primary btn-sm' href="{{ url('master/pasangan/add')}}">Tambah</a><br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
                <tr>
                    <th>Nama</th>
                    <th>TTL</th>	
                    <th>Pekerjaan</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>Alamat</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Opsi</th>
                    </tr>
                    <tbody>
                        @foreach ($dataPasangan as $item)
                        <tr>
                            <td>{{ $item->Nama_c}}</td>
                            <td>{{ $item->Tempat_lhrc}}, {{ $item->Tanggal_lhrc}}</td>
                            <td>{{ $item->Pekerjaan_c}}</td>
                            <td>{{ $item->Agamac}}</td>
                            <td>{{ $item->Statusc}}</td>
                            <td>{{ $item->Alamatc}}</td>
                            <td>{{ $item->Nama_ayahc}}</td>
                            <td>{{ $item->Nama_ibuc}}</td>
                            <td>
                                <a href="{{url('master/pasangan/edit')}}/{{ $item->id_cpsangan }}"><i class='material-icons text-success sm'>create</i></a>
                                <!-- <a href="#"><i class='material-icons text-danger'>delete</i></a> -->
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
            </table>
        </div>
    </div>
 </div>
@endsection