@extends('main')

@section('card-header')

<div class="card-header">
    LIST USER
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection

@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <a class='btn btn-primary btn-sm' href="{{ url('master/pimpinan/add')}}">Tambah</a><br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
            <tr>
                <th>NRP</th>
                <th>Kepolisian</th>
                <th>Nama Pimpinan</th>
                <th>Jabatan</th>
                <th>Thn Jabatan</th>
                <th>Foto</th>
                <th>Level</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
                    <tbody>
                        @foreach ($dataPimpinan as $item)
                        <tr>
                            <td>{{ $item->NRP_pimpinan}}</td>
                            <td>{{ $item->nama_kep}}</td>
                            <td>{{ $item->Nama_p}}</td>
                            <td>{{ $item->nm_jabatan}}</td>
                            <td>{{ $item->thn_jabatan}}</td>
                            <td><img src="{{url('style_admin/data/img_pim')}}/{{ $item->foto}}" alt="Foto {{ $item->Nama_p}}" width='100px'> </td>
                            <td>{{ $item->level}}</td>
                            <td>{{ $item->status_p}}</td>
                            <td>
                                <a href="{{url('master/pimpinan/edit')}}/{{ $item->NRP_pimpinan}}"><i class='material-icons text-success sm'>create</i></a>
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