@extends('main')

@section('card-header')

<div class="card-header">
    Form Pasangan
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="{{url('pasangan/update')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        CPA<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="id_cpsangan" class="form-control" value="{{$pasangan->id_cpsangan}}" readonly/>
      </div>
      </fieldset>

      <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Nama Lengkap<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="Nama_c" class="form-control" value="{{$pasangan->Nama_c}}" required/>
      </div>
      </fieldset>

      <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Tempat, Tanggal Lahir<span class="required"></span>
      </label>
      <div class="col-md-3 col-sm-3 col-xs-6">
        <input type="text" name="Tempat_lhrc" class="form-control" value="{{$pasangan->Tempat_lhrc}}" required/>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
        <input type="date" name="Tanggal_lhrc" class="form-control" value="{{$pasangan->Tanggal_lhrc}}" required/>
      </div>
      </fieldset>

      <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Pekerjaan<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="Pekerjaan_c" class="form-control" value="{{$pasangan->Pekerjaan_c}}" required/>
      </div>
      </fieldset>

      <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Agama
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="Agamac" type="option" class="form-control" required/>
                                <option value="{{$pasangan->Agamac}}">{{$pasangan->Agamac}}</option>
                                <option value="islam">Islma</option>
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
        <input type="text" name="Alamatc" class="form-control" value="{{$pasangan->Alamatc}}" required/>
      </div>
      </fieldset>

       <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Ayah<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="Nama_ayahc" class="form-control" value="{{$pasangan->Nama_ayahc}}" required/>
      </div>
      </fieldset>

       <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Pekerjaan<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="Pekerjaan_ayahc" class="form-control" value="{{$pasangan->Pekerjaan_ayahc}}" required/>
      </div>
      </fieldset>

      <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Agama
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="Agama_ayahc" type="option" class="form-control" required/>
                                <option value="{{$pasangan->Agama_ayahc}}">{{$pasangan->Agama_ayahc}}</option>
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
        <input type="text" name="Alamat_ayahc" class="form-control" value="{{$pasangan->Alamat_ayahc}}" required/>
      </div>
      </fieldset>

       <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Ibu<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="Nama_ibuc" class="form-control" value="{{$pasangan->Nama_ibuc}}" required/>
      </div>
      </fieldset>

       <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Pekerjaan<span class="required"></span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" name="Pekerjaan_ibuc" class="form-control" value="{{$pasangan->Pekerjaan_ibuc}}" required/>
      </div>
      </fieldset>

      <fieldset class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        Agama
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="Agama_ibuc" type="option" class="form-control" required/>
                                <option value="{{$pasangan->Agama_ibuc}}">{{$pasangan->Agama_ibuc}}</option>
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
        <input type="text" name="Alamat_ibuc" class="form-control" value="{{$pasangan->Alamat_ibuc}}" required/>
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