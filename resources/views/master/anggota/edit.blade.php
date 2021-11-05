@extends('main')

@section('card-header')

<div class="card-header">
    Edit Anggota
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="{{url('anggota/update')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" name="id_kep" value="{{$anggota->id_kepolisian}}">
        <input type="hidden" name="id" value="{{$anggota->NRP}}">
            <fieldset class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      Nama Pimpinan<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" value="{{$anggota->Nama_p}}" class="form-control" id="nama_kep" required readonly="" >
                    </div>
                </fieldset>
        
                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Kepolisian<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="{{$anggota->nama_kep}}" class="form-control" id="nama_kep" required readonly="" >
                  </div> 
                </fieldset>
        
              
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                NRP<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" max="8" name="NRP" value="{{$anggota->NRP}}" class="form-control" placeholder="NRP" required=/>
              </div>
              </fieldset>
        
              
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Nama Lengkap<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Nama" value="{{$anggota->Nama}}" class="form-control" placeholder="Nama Lengkap" required/>
              </div>
              </fieldset>
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Tempat, Tanggal Lahir<span class="required"></span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <input type="text" name="Tempat_lhr" class="form-control" value="{{$anggota->Tempat_lhr}}" required/>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <input type="date" name="Tanggal_lhr" class="form-control" value="{{$anggota->Tanggal_lhr}}" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pekerjaan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pekerjaan" class="form-control"value="{{$anggota->Pekerjaan}}" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pangkat<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pangkat" class="form-control" value="{{$anggota->Pangkat}}" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Jabatan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Jabatan" class="form-control" value="{{$anggota->Jabatan}}" required/>
              </div>
              </fieldset>
        
                <fieldset class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        Agama
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="Agama" type="option" class="form-control" required/>
                            <option value="{{$anggota->Agama}}">{{$anggota->Agama}}</option>
                            <option value="islam">Islam</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                        </select>
                    </div>
                </fieldset>
        
                <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Status 
              </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="Status" type="option" class="form-control" required/>
                            <option value="{{$anggota->Status}}">{{$anggota->Status}}</option>
                            <option value="jejaka">Jejaka</option>
                            <option value="perawan">Perawan</option>
                            <option value="duda">Duda</option>
                            <option value="janda">Janda</option>
                        </select>
                    </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Alamat<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="Alamat" class="form-control">{{$anggota->Alamat}}</textarea>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Ayah<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Nama_bapak" class="form-control" value="{{$anggota->Nama_bapak}}" required/>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pekerjaan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pekerjaan_bapak" class="form-control" value="{{$anggota->Pekerjaan_bapak}}" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Agama
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="Agama_bapak" type="option" class="form-control" required/>
                                        <option value="{{$anggota->Agama_bapak}}">{{$anggota->Agama_bapak}}</option>
                                        <option value="islam">Islam</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="katolik">Katolik</option>
                                      </select>
                    </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Alamat<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="Alamat_bapak" class="form-control">{{$anggota->Alamat_bapak}}</textarea>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Ibu<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Nama_ibu" class="form-control" value="{{$anggota->Nama_ibu}}" required/>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pekerjaan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pekerjaan_ibu" class="form-control" value="{{$anggota->Pekerjaan_ibu}}" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Agama
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="Agama_ibu" type="option" class="form-control" required/>
                                        <option value="{{$anggota->Agama_ibu}}">{{$anggota->Agama_ibu}}</option>
                                        <option value="islam">Islam</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="katolik">Katolik</option>
                                      </select>
                    </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Alamat<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="Alamat_ibu" class="form-control">{{$anggota->Alamat_ibu}}</textarea>
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