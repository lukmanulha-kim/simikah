@extends('main')

@section('card-header')

<div class="card-header">
    Edit Pimpinan
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="/pimpinan/update" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$pimpinan->NRP_pimpinan}}">
        
                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    NRP<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nrp" class="form-control" value="{{$pimpinan->NRP_pimpinan}}" required>
                  </div> 
                </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Nama<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nama" class="form-control" value="{{$pimpinan->Nama_p}}" required>
                  </div> 
                </fieldset>
              
                <fieldset class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        Kepolisiam<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="kepolisian" id="kepolisian" class="form-control" required>
                            <option value="{{$pimpinan->id_kepolisian}}">{{$pimpinan->nama_kep}}</option>
                            @foreach ($getKepolisian as $item)

                            <option value="{{$item->id_kepolisian}}">{{$item->nama_kep}}</option>
                            
                            @endforeach
                        </select>
                    </div>
                </fieldset>

                <fieldset class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        Jabatan<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="jabatan" id="jabatan" class="form-control" required>
                            <option value="{{$pimpinan->id_jabatan}}">{{$pimpinan->nm_jabatan}}</option>
                            @foreach ($getJabatan as $item)

                            <option value="{{$item->id_jabatan}}">{{$item->nm_jabatan}}</option>
                            
                            @endforeach
                        </select>
                    </div>
                </fieldset>
                <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Level
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="level" type="option" class="form-control" required/>
          <option value="{{$pimpinan->level}}">{{$pimpinan->level}}</option>
          <option value="kapolres">Kapolres</option>
          <option value="Kapolsek">Kapolsek</option>
          <option value="pimpinan">Pimpinan Bagian</option>
        </select>
      </div>
      </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Tahun Jabatan<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="tahhunjabatan" class="form-control" value="{{$pimpinan->thn_jabatan}}" required>
                  </div> 
                </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Foto<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="foto" class="form-control" id="foto">
                    Lewati Jika Tidak Ingin Merubah Foto
                    <br>
                    <img src="{{url('style_admin/data/img_pim')}}/{{$pimpinan->foto}}" alt="Foto {{$pimpinan->Nama_p}}" width="150">
                  </div> 
                </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Password<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="password" class="form-control" >
                    Lewati Jika Tidak Ingin Merubah Kata Sandi
                  </div> 
                </fieldset>
        
                <fieldset class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <input type="submit" class="btn btn-success" value="Simpan">
                        <a class="btn btn-danger" href="admin.php?target=anggota">Kembali</a>
                    </div>
                </fieldset>
        
        </form>
    </div>
 </div>
@endsection