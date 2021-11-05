@extends('main')

@section('card-header')

<div class="card-header">
    <b style="font-size:12pt;">Halaman Utama</b>
    <div class="card-controls">
       <a href="javascript:;" class="card-collapse" data-toggle="card-collapse"></a>
    </div>
 </div>
    
@endsection


@section('content')
<div class="card-block">
    <p class="card-text">
    <div class="main-content">
       <div class="content-view">
          <div class="row">
             <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block">
                   <h5 class="m-b-0 v-align-middle text-overflow">
                      <span class="small pull-xs-right">
                      <i class="material-icons text-success" style="width: 16px;">arrow_drop_up</i>
                      <span style="line-height: 24px;"></span>
                      query
                      </span>
                      <span>2</span>
                   </h5>
                   <div class="small text-overflow text-muted">
                      JUMLAH
                   </div>
                   <div class="small text-overflow">
                      DATA&nbsp;<span>USER</span>
                   </div>
                </div>
             </div>
             <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block">
                   <h5 class="m-b-0 v-align-middle text-overflow">
                      <span class="small pull-xs-right">
                      <i class="material-icons text-success" style="width: 16px;">arrow_drop_up</i>
                      <span style="line-height: 24px;"></span>
                      query
                      </span>
                      <span>2</span>
                   </h5>
                   <div class="small text-overflow text-muted">
                      JUMLAH
                   </div>
                   <div class="small text-overflow">
                      DATA&nbsp;<span>ANGGOTA</span>
                   </div>
                </div>
             </div>
             <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block">
                   <h5 class="m-b-0 v-align-middle text-overflow">
                      <span class="small pull-xs-right">
                      <i class="material-icons text-success" style="width: 16px;">arrow_drop_up</i>
                      <span style="line-height: 24px;"></span>
                      query
                      </span>
                      <span>2</span>
                   </h5>
                   <div class="small text-overflow text-muted">
                      JUMLAH
                   </div>
                   <div class="small text-overflow">
                      DATA&nbsp;<span>CALON PASANGAN</span>
                   </div>
                </div>
             </div>
             <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block">
                   <h5 class="m-b-0 v-align-middle text-overflow">
                      <span class="small pull-xs-right">
                      <i class="material-icons text-danger" style="width: 16px;">arrow_drop_down</i>
                      <span style="line-height: 24px;"></span>
                      query
                      </span>
                      <span>2</span>
                   </h5>
                   <div class="small text-overflow text-muted">
                      JUMLAH
                   </div>
                   <div class="small text-overflow">
                      DATA&nbsp;<span>SURAT IZIN NIKAH</span>
                   </div>
                </div>
             </div>
             <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block">
                   <h5 class="m-b-0 v-align-middle text-overflow">
                      <span class="small pull-xs-right">
                      <i class="material-icons text-danger" style="width: 16px;">arrow_drop_down</i>
                      <span style="line-height: 24px;"></span>
                      query
                      </span>
                      <span>2</span>
                   </h5>
                   <div class="small text-overflow text-muted">
                      JUMLAH
                   </div>
                   <div class="small text-overflow">
                      DATA&nbsp;<span>SIN ACC KAPOLRES</span>
                   </div>
                </div>
             </div>
             <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block">
                   <h5 class="m-b-0 v-align-middle text-overflow">
                      <span class="small pull-xs-right">
                      <i class="material-icons text-success" style="width: 16px;">arrow_drop_up</i>
                      <span style="line-height: 24px;"></span>
                      query
                      </span>
                      <span>1</span>
                   </h5>
                   <div class="small text-overflow text-muted">
                      JUMLAH
                   </div>
                   <div class="small text-overflow">
                      DATA&nbsp;<span>SIN ACC KAPOLSEK</span>
                   </div>
                </div>
             </div>
          </div>
          <div class="alert alert-info">
             <b style="">SILAHKAN UNTUK MENGAKSES MENU DI SEBELAH KIRI</b>
          </div>
          <div style="font-size:14pt; text-decoration : bold; color : blue; text-align: center;">
             <div style="font-size:14pt; font-family: Segoe UI Black;">GRAFIK SURAT IZIN KAWIN</i></div>
             <br>
             grafik halaman
             <div style="font-size:12pt; text-decoration : bold; color : blue;">
                <br><br>
                <div style="font-size:12pt; font-family: Segoe UI Black;">IP Adress Anda <?php echo $_SERVER['REMOTE_ADDR']; ?></i></div>
                <b style="font-size:12pt; font-family: Segoe UI Black;"><?php echo date("l, d F Y")?>, <?php echo date('H:i:s')?></b></center>
                </p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection