@extends('main')

@section('card-header')

<div class="card-header">
    Form Izin Cerai
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="/izincerai/create" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor SIC<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_sic" class="form-control" value="<?php echo "SIC/../../../"?><?php echo date('Y');?>"required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="dasar_c" class="form-control" placeholder="Dasar" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_dsrc" class="form-control"  value="../../../../<?php echo date('Y');?>/.." required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Tanggal Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="date" name="tgl_dsr" class="form-control" placeholder="Tanggal Dasar" required/>
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
            TUJUAN / ALASAN <span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="alasan" class="form-control" placeholder="ALASAN" required/>
          </div>
          </fieldset>

      			<fieldset class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
              Nama Anggota Izin Cerai<span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
              <select name="id_izin" onchange="getcalonCerai(this.value)"  id="id_izin" class="select2 m-b-1" style="width: 100%;" >
                <option>--Pilih Anggota--</option>
                @foreach ($getData as $item)

                <option value="{{$item->id_izin}}">{{$item->Nama}}</option>
                    
            @endforeach
              </select>
            </div>
        </fieldset>

        

        <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            NRP<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" id="NRP" required readonly="" >
          </div> 
        </fieldset>

         <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            KEPOLISIAN<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" id="nama_kep" required readonly="" >
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
            Calon Pasangan<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" id="Nama_c" required readonly="" >
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