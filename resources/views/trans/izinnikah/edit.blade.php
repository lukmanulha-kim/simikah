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
        <form method="post" action="/izinnikah/update" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $izinnikah->id_izin }}">
        <fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor SIK<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_sik" class="form-control" value="{{ $izinnikah->nomor_sik }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="dasar" class="form-control" value="{{ $izinnikah->dasar }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_dsr" class="form-control"  value="{{ $izinnikah->nomor_dsr }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Tanggal Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="date" name="tgl_dasar" class="form-control" value="{{ $izinnikah->tgl_dasar }}" required/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Perihal <span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="perihal" class="form-control" value="{{ $izinnikah->perihal }}" required/>
      		</div>
      		</fieldset>

      			<fieldset class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
              Nama Anggota<span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
                <input type="text" name="" class="form-control" value="{{ $izinnikah->Nama }}" required readonly="" >
            </div>
        </fieldset>

        <fieldset class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
              NRP<span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
                <input type="text" name="" class="form-control" value="{{ $izinnikah->NRP }}" required readonly="" >
            </div>
        </fieldset>

				<fieldset class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
						Pangkat<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="" class="form-control" value="{{ $izinnikah->Pangkat }}" required readonly="" >
					</div> 
				</fieldset>

				<fieldset class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
						Jabatan<span class="required"></span>
					</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="" class="form-control" value="{{ $izinnikah->Jabatan }}" required readonly="" >
					</div> 
				</fieldset>

				<fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Nama Calon <span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" value="{{ $izinnikah->Nama_c }}" required readonly="" >
          </div>
        </fieldset>

        <fieldset class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Pekerjaan<span class="required"></span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="" class="form-control" value="{{ $izinnikah->Pekerjaan_c }}" required readonly="" >
          </div> 
        </fieldset>
        
            <fieldset class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="submit" class="btn btn-success" value="Update">
                    <!-- <a class="btn btn-danger" href="admin.php?target=anggota">Kembali</a> -->
                 </div>
              </fieldset>
        
        </form>
    </div>
 </div>
@endsection