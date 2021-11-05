@extends('main')

@section('card-header')

<div class="card-header">
    Form Anggota
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="{{url('anggota/create')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                      Nama Pimpinan<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      
                      <select name="id_kepolisian"  id="id_kepolisian" onchange="getDataKepolisian(this.value)" class="select2 m-b-1" style="width: 100%;" >
                        <option>--Pilih Pimpinan--</option>
                        @foreach ($getPimpinan as $item)

                        <option value="{{$item->id_kepolisian}}">{{$item->Nama_p}}</option>
                            
                        @endforeach
                      </select>
                    </div>
                </fieldset>
        
                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Kepolisian<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="" class="form-control" id="nama_kep" required readonly="" >
                  </div> 
                </fieldset>
        
              
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                NRP<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="number" length="8" name="NRP" class="form-control" placeholder="NRP" required=/>
              </div>
              </fieldset>
        
              
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Nama Lengkap<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Nama" class="form-control" placeholder="Nama Lengkap" required/>
              </div>
              </fieldset>
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Tempat, Tanggal Lahir<span class="required"></span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <input type="text" name="Tempat_lhr" class="form-control" placeholder="Tempat Lahir" required/>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6">
                <input type="date" name="Tanggal_lhr" class="form-control" placeholder="Tanggal Lahir" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pekerjaan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pekerjaan" class="form-control" placeholder="Pekerjaan" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pangkat<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pangkat" class="form-control" placeholder="Pangkat" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Jabatan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Jabatan" class="form-control" placeholder="Jabatan" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Agama
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="Agama" type="option" class="form-control" required/>
                                        <option>--Pilih Agama--</option>
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
                <input type="radio" name="Status" value="jejaka" />   Jejaka &nbsp;&nbsp;
                <input type="radio" name="Status" value="perawan" />  Perawan  &nbsp;&nbsp;
                <input type="radio" name="Status" value="duda" />     Duda  &nbsp;&nbsp;
                <input type="radio" name="Status" value="janda" />  Janda  &nbsp;&nbsp;
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Alamat<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Alamat" class="form-control" placeholder="Alamat" required/>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Ayah<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Nama_bapak" class="form-control" placeholder="Nama Ayah" required/>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pekerjaan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pekerjaan_bapak" class="form-control" placeholder="Pekerjaan Ayah" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Agama
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="Agama_bapak" type="option" class="form-control" required/>
                                        <option>--Pilih Agama--</option>
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
                <input type="text" name="Alamat_bapak" class="form-control" placeholder="Alamat Ayah" required/>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Ibu<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Nama_ibu" class="form-control" placeholder="Nama Ibu" required/>
              </div>
              </fieldset>
        
               <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Pekerjaan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="Pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" required/>
              </div>
              </fieldset>
        
              <fieldset class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Agama
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="Agama_ibu" type="option" class="form-control" required/>
                                        <option>--Pilih Agama--</option>
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
                <input type="text" name="Alamat_ibu" class="form-control" placeholder="Pekerjaan Ibu" required/>
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
 <script type="text/javascript">
        {{$jsArray}}  
  </script>
@endsection