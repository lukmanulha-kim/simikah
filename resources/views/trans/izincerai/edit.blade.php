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
        <form method="post" action="/izincerai/update" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $dataCerai->id_cerai }}">
        <fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor SIC<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_sic" class="form-control" value="{{ $dataCerai->nomor_sic }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="dasar_c" class="form-control" value="{{ $dataCerai->dasar_c }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_dsrc" class="form-control"  value="{{ $dataCerai->nomor_dsrc }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Tanggal Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="date" name="tgl_dsr" class="form-control"value="{{ $dataCerai->tgl_dsr }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Perihal <span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="perihal" class="form-control" value="{{ $dataCerai->perihal_c }}" required/>
      		</div>
      		</fieldset>

          <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            TUJUAN / ALASAN <span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="alasan" class="form-control" value="{{ $dataCerai->alasan }}" required/>
          </div>
          </fieldset>

      			<fieldset class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
              Nama Anggota Izin Cerai<span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="" class="form-control" value="{{ $dataCerai->Nama }}" required readonly="" >
              
            </div>
        </fieldset>

        

        <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            NRP<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" value="{{ $dataCerai->NRP }}" required readonly="" >
          </div> 
        </fieldset>

				<fieldset class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
						Pangkat<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="" class="form-control" value="{{ $dataCerai->Pangkat }}" required readonly="" >
					</div> 
				</fieldset>

				<fieldset class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
						Jabatan<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="" class="form-control" value="{{ $dataCerai->Jabatan }}" required readonly="" >
					</div> 
				</fieldset>

				<fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Calon Pasangan<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" value="{{ $dataCerai->Nama_c }}" required readonly="" >
          </div> 
        </fieldset>

        <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Pekerjaan<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" value="{{ $dataCerai->Pekerjaan_c }}" required readonly="" >
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