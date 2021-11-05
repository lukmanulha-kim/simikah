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
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0">
                <thead>
                    <tr>
                        <th>Nomor SIK</th>
                        <th>Nama Anggota</th>
                        <th>Calon Pasangan</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataIzinNikah as $item)
                    <tr>
                        <td>{{ $item->nomor_sik}}</td>
                        <td>{{ $item->Nama}}</td>
                        <td>{{ $item->Nama_c}}</td>
                        <td> @if($item->status_izinr=="Diajukan")Belum ACC @else Disetujui @endif</td>
                        <td>
                        @if($item->status_izinr=="Diajukan")
                        <a onClick="return confirm('Apakah Anda akan meng-ACC SIN?')" href="/accnikahpolres/{{ $item->id_izin}}"><i class='material-icons text-success sm'>offline_pin</i></a>
                        <a href="{{url('acc/izinnikah')}}/{{ $item->id_izin}}"><i class='material-icons text-info sm'>visibility</i></a>
                        @else
                        <a href="{{url('acc/izinnikah')}}/{{ $item->id_izin}}"><i class='material-icons text-info sm'>visibility</i></a>
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