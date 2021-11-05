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
        <form method="post" action="/izinnikah/create" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor SIK<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_sik" class="form-control" value="<?php echo "SIK/../../../"?><?php echo date('Y');?>"required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="dasar" class="form-control" placeholder="Dasar" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_dsr" class="form-control"  value="../../../../<?php echo date('Y');?>/.." required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Tanggal Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="date" name="tgl_dasar" class="form-control" placeholder="Tanggal Dasar" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Perihal <span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="perihal" class="form-control" placeholder="Perihal Dasar" required/>
      		</div>
      		</fieldset>

      			<fieldset class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
              Nama Anggota<span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
              <select name="NRP" onchange="getDataAnggota(this.value)"  id="NRP" class="select2 m-b-1" style="width: 100%;" >
                <option>--Pilih Anggota--</option>
                @foreach ($getAnggota as $item)

                <option value="{{$item->NRP}}">{{$item->Nama}}</option>
                {{
                    $jsArray .= "dtangg['" . $item->NRP . "'] = {nama_kep:'" . addslashes($item->Nama). "'};\n"
                }}
                    
                @endforeach
              </select>
            </div>
        </fieldset>

				<fieldset class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
						Pangkat<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="" class="form-control" id="Pangkat" required readonly="" >
					</div> 
				</fieldset>

				<fieldset class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
						Jabatan<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="" class="form-control" id="Jabatan" required readonly="" >
					</div> 
				</fieldset>

				<fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Nama Calon <span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_cpsangan" onchange="getDataCalon(this.value)"  id="id_cpsangan" class="select2 m-b-1" style="width: 100%;" >
              <option>--Pilih Calon--</option>
              @foreach ($getCaPasangan as $item)

                <option value="{{$item->id_cpsangan}}">{{$item->Nama_c}}</option>
                {{
                    $jsArray .= "dtcalon['" . $item->id_cpsangan . "'] = {nama_calon:'" . addslashes($item->Nama_c). "'};\n"
                }}
                    
            @endforeach
              
            </select>
          </div>
        </fieldset>

        <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Pekerjaan<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" id="Pekerjaan_c" required readonly="" >
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