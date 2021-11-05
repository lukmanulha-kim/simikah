@extends('main')

@section('card-header')

<div class="card-header">
    Form User
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="/pimpinan/create" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    NRP<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nrp" class="form-control" id="nrp" required>
                  </div> 
                </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Nama<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nama" class="form-control" id="nama" required>
                  </div> 
                </fieldset>
              
                <fieldset class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        Kepolisiam<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="kepolisian" id="kepolisian" class="select2 m-b-1" style="width: 100%;" required>
                            <option value="">Pilih Kepolisian</option>
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
                        <select name="jabatan" id="jabatan" class="select2 m-b-1" style="width: 100%;" required>
                            <option value="">Pilih Level</option>
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
          <option>--Pilih Level--</option>
          <option value="kapolres">Kapolres</option>
          <option value="kapolsek">Kapolsek</option>
          <option value="pimpinan">Pimpinan Bagian</option>
        </select>
      </div>
      </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Tahun Jabatan<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="tahhunjabatan" class="form-control" id="tahhunjabatan" required>
                  </div> 
                </fieldset>

                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Foto<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="foto" class="form-control" id="foto" required>
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