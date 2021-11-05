@extends('main')

@section('card-header')

<div class="card-header">
    ACC SURAT IZIN CERAI
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
                <thead>
                    <tr>
                        <th>Nomor SIC</th>
                        <th>Nama Anggota</th>
                        <th>Calon Pasangan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataIzinCerai as $item)
                    <tr>
                        <td>{{ $item->nomor_sic}}</td>
                        <td>{{ $item->Nama}}</td>
                        <td>{{ $item->Nama_c}}</td>
                        <td>
                        @if($item->statuspb=="Diajukan")
                        <a onClick="return confirm('Apakah Anda akan meng-ACC SIN?')" href="/accceraibagian/{{ $item->id_izin}}"><i class='material-icons text-success sm'>offline_pin</i></a>
                        <a href="{{url('acc/izincerai')}}/{{ $item->id_izin}}"><i class='material-icons text-info sm'>visibility</i></a>
                        @else
                        <a href="{{url('acc/izincerai')}}/{{ $item->id_izin}}"><i class='material-icons text-info sm'>visibility</i></a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
 </div>
@endsection