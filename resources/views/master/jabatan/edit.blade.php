@extends('main')

@section('card-header')

<div class="card-header">
    Edit Jabatan
    <div class="card-controls">
        <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
</div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
        <form method="post" action="/jabatan/update" enctype="multipart/form-data" class="form-horizontal form-label-left">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $jabatan->id_jabatan }}">
        
                <fieldset class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Nama Jabatan<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="jabatan" class="form-control" value="{{$jabatan->nm_jabatan}}" required>
                  </div> 
                </fieldset>
        
            <fieldset class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="submit" class="btn btn-success" value="Simpan">
                    <a class="btn btn-danger" href="#">Kembali</a>
                 </div>
              </fieldset>
        
        </form>
    </div>
 </div>
@endsection