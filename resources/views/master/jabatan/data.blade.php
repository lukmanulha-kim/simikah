@extends('main')

@section('card-header')

<div class="card-header">
    LIST JABATAN
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection

@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <a class='btn btn-primary btn-sm' href="{{ url('master/jabatan/add')}}">Tambah</a><br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
                <tr>
                    <th>Nama Jabatan</th>
                    <th>Opsi</th>
                    </tr>
                    <tbody>
                        @foreach ($dataJabatan as $item)
                        <tr>
                            <td>{{ $item->nm_jabatan}}</td>
                            <td>
                                <a href="{{url('master/jabatan/edit')}}/{{ $item->id_jabatan }}"><i class='material-icons text-success sm'>create</i></a>
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