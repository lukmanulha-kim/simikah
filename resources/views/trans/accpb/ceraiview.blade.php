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
        <form method="post" action="/izincerai/update" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor SIK<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_sik" class="form-control" value="{{$izincerai->nomor_sic}}" readonly/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="dasar" class="form-control" value="{{$izincerai->dasar_c}}" readonly/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Nomor Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="nomor_dsr" class="form-control"  value="{{$izincerai->nomor_dsrc}}" readonly/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Tanggal Dasar<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="date" name="tgl_dasar" class="form-control" value="{{$izincerai->tgl_dsr}}" readonly/>
      		</div>
      		</fieldset>

      		<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Perihal <span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="perihal" class="form-control" value="{{$izincerai->perihal_c}}" readonly/>
      		</div>
      		</fieldset>

              <fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        		Alasan <span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="perihal" class="form-control" value="{{$izincerai->alasan}}" readonly/>
      		</div>
      		</fieldset>

      		
			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Nama Anggota <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" class="form-control" value="{{$izincerai->Nama}}" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				NRP <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->NRP}}" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        	Pekerjaan<span class="required"></span>
      		</label>
      		<div class="col-md-6 col-sm-6 col-xs-12">
        	<input type="text" name="Pekerjaan" class="form-control" value="{{$izincerai->Pekerjaan}}" readonly/>
     		</div>
      		</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Pangkat <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Pangkat}}" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Jabatan <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="Jabatan" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        	Tempat, Tanggal Lahir<span class="required"></span>
      		</label>
      		<div class="col-md-3 col-sm-3 col-xs-6">
        	<input type="text" name="Tempat_lhr" class="form-control" value="{{$izincerai->Tempat_lhr}}" readonly/>
      		</div>
      		<div class="col-md-3 col-sm-3 col-xs-6">
        	<input type="date" name="Tanggal_lhr" class="form-control" value="{{$izincerai->Tanggal_lhr}}" readonly/>
      		</div>
      		</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Agama <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Agama}}" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Status <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Status}}" class="form-control" readonly="">
			</div>
			</fieldset>
			

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Alamat <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Alamat}}" class="form-control" readonly="">
			</div>
			</fieldset>

			
			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Nama Calon <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Nama_c}}" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Pekerjaan <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Pekerjaan_c}}" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
      		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
        	Tempat, Tanggal Lahir<span class="required"></span>
      		</label>
      		<div class="col-md-3 col-sm-3 col-xs-6">
        	<input type="text" name="Tempat_lhr" class="form-control" value="{{$izincerai->Tempat_lhrc}}" readonly/>
      		</div>
      		<div class="col-md-3 col-sm-3 col-xs-6">
        	<input type="date" name="Tanggal_lhr" class="form-control" value="{{$izincerai->Tanggal_lhrc}}" readonly/>
      		</div>
      		</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Agama <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Agamac}}" class="form-control" readonly="">
			</div>
			</fieldset>

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Status <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Statusc}}" class="form-control" readonly="">
			</div>
			</fieldset>
			

			<fieldset class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
				Alamat <span class="required"></span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" value="{{$izincerai->Alamatc}}" class="form-control" readonly="">
			</div>
			</fieldset>
        
        </form>
    </div>
 </div>
@endsection