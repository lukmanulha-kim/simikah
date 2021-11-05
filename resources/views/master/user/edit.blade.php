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
        <form method="post" action="{{url('user/update')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($dataUser as $item)
            <input type="hidden" name="id" value="{{ $item->id }}">
            <fieldset class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Nama<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>
                </div> 
            </fieldset>
            <fieldset class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Username<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="username" class="form-control" id="username" value="{{ $item->email }}" required>
                </div> 
            </fieldset>
            
            <fieldset class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                Password<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="password" class="form-control" id="password">
                Kosongi Jika Tidak Ingin Merubah Password
                </div> 
            </fieldset>
            
            <fieldset class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
            Level<span class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="level" id="level" class="form-control" required>
                <option value="{{ $item->level }}">{{ $item->level }}</option>
                <option value="Admin_SDM">Admin SDM</option>
                <option value="Kapolres">Kapolres</option>
                <option value="Kapolsek">Kapolsek</option>
            </select>
            </div>
            </fieldset>
            @endforeach
        
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