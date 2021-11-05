<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="shortcut icon" href="style_admin/images/PL.png">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Milestone">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Milestone">

    <meta name="theme-color" content="#4C7FF0">
    
    <title>SISTEM INFORMASI IZIN</title>

    <!-- page stylesheets -->
     <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> -->
    <!-- end page stylesheets -->

     <!-- page stylesheets -->
    <link rel="stylesheet" href="{{asset('style_admin/vendor/datatables/media/css/dataTables.bootstrap4.css')}}">
    <!-- end page stylesheets -->

    <link rel="stylesheet" href="{{asset('style_admin/vendor/jquery.tagsinput/src/jquery.tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/intl-tel-input/build/css/intlTelInput.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/clockpicker/dist/bootstrap-clockpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/jquery-labelauty/source/jquery-labelauty.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/multiselect/css/multi-select.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/ui-select/dist/select.css')}}">
    <link rel="stylesheet" href="{{asset('style_admin/vendor/select2/select2.css')}}"> 
    <link rel="stylesheet" href="{{asset('style_admin/vendor/selectize/dist/css/selectize.css')}}">

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="{{asset('style_admin/vendor/bootstrap/dist/css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('style_admin/vendor/pace/themes/blue/pace-theme-minimal.css')}}"/>
    <link rel="stylesheet" href="{{asset('style_admin/vendor/font-awesome/css/font-awesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('style_admin/vendor/animate.css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('style_admin/styles/app.css')}}" id="load_styles_before"/>
    <link rel="stylesheet" href="{{asset('style_admin/styles/app.skins.css')}}"/>

    <!-- endbuild -->
  </head>
  <body>

    <div class="app">
      <!--sidebar panel-->
      <div class="off-canvas-overlay" data-toggle="sidebar"></div>
      <div class="sidebar-panel">
        <div class="brand">
          <!-- toggle offscreen menu -->
          
          <!-- /toggle offscreen menu -->
          <!-- logo -->
          <a class="brand-logo">
          <!-- <center><h4 style="text-align: center; font-family: Times New Roman; color : blue;">SI</H4></center> -->
          <img class="expanding-hidden" src="{{asset('style_admin/images/barulagi.png')}}" width="90" height="150" alt=""/>
          </a>
          <!-- /logo -->
        </div>
        <!-- main navigation -->
        <nav>
          <p class="nav-title"></p>
          <ul class="nav">
            
            <!-- dashboard -->
            <li>
              <a href="{{url('/home')}}">
                <i class="material-icons text-primary">home</i>
                <span>Home</span>
              </a>
            </li>
            @if(auth()->user()->level=="Admin_SDM")
          <li>
              <a href="javascript:;">
                <span class="menu-caret">
                  <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-success">card_membership </i>
               <!--  <span class="badge bg-primary pull-right">08</span> -->
                <span>Master</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('master/user')}}">
                    <span>User</span>
                  </a>
                </li>
                 <li>
                  <a href="{{url('master/polisi')}}">
                    <span>Kepolisian</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('master/jabatan')}}">
                    <span>Jabatan</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('master/pimpinan')}}">
                    <span>Pimpinan</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('master/anggota')}}">
                    <span>Anggota</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('master/pekerjaan')}}">
                    <span>Pekerjaan</span>
                  </a>
                </li>

              </ul>
            </li>
             <li>
              <a href="javascript:;">
                <span class="menu-caret">
                  <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-danger">devices</i>
                <!-- <span class="badge bg-primary pull-right">08</span> -->
                <span>Transaksi</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('trans/izinnikah')}}">
                    <span>Surat Izin Nikah</span>
                  </a>
                </li>
              </ul>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('trans/izincerai')}}">
                    <span>Surat Izin Cerai</span>
                  </a>
                </li>
              </ul>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('trans/rujuk')}}">
                    <span>Surat Izin Rujuk</span>
                  </a>
                </li>
              </ul>
              <li>
              <a href="javascript:;">
                <span class="menu-caret">
                  <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-warning"> import_contacts</i>
                <!-- <span class="badge bg-primary pull-right">08</span> -->
                <span>Laporan</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('report/izinnikah')}}">
                    <span>Laporan Izin Nikah</span>
                  </a>
                </li>
              </ul>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('report/izincerai')}}">
                    <span>Laporan Izin Cerai</span>
                  </a>
                </li>
              </ul>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('report/izinrujuk')}}">
                    <span>Laporan Izin Rujuk</span>
                  </a>
                </li>
              </ul>
            <li>
              <a href="/logout">
                <i class="material-icons text-info">power_settings_new</i>
                <span>Logout</span>
              </a>
            </li>
            <li>  
            @endif
              <!-- <a href="?target=acc">
                <i class="material-icons text-danger">assignment_turned_in</i>
                <span>ACC</span>
              </a> -->
              @if(auth()->user()->level=="kapolres")
              <a href="javascript:;">
                <span class="menu-caret">
                  <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-success">assignment_turned_in </i>
               <!--  <span class="badge bg-primary pull-right">08</span> -->
                <span>ACC</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="{{url('acc/cerai/polres')}}">
                    <span>Nikah</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('acc/cerai/polres')}}">
                    <span>Cerai</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>Rujuk</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="/logout">
                <i class="material-icons text-info">power_settings_new</i>
                <span>Logout</span>
              </a>
            </li>
            @endif
            @if(auth()->user()->level=="anggota")
          <li>  
              <a href="{{url('master/pasangan')}}">
                <i class="material-icons text-warning">face</i>
                <span>Calon Pasangan</span>
              </a>
          </li>
          <li>  
              <a href="?target=viewizin">
                <i class="material-icons text-danger">open_with</i>
                <span>View Izin Nikah</span>
              </a>
            </li>
           <li>
              <a href="/logout">
                <i class="material-icons text-info">power_settings_new</i>
                <span>Logout</span>
              </a>
            </li>
            @endif
            @if(auth()->user()->level=="kapolsek")
          <li>  
           
              <!-- <a href="?target=accpolsek">
                <i class="material-icons text-warning">assignment_turned_in</i>
                <span>ACC KAPOLSEK</span>
              </a> -->

              <!-- <a href="?target=accbagian">
                <i class="material-icons text-success">assignment_turned_in</i>
                <span>ACC PIMPINAN BAGIAN</span>
              </a> -->
              <a href="javascript:;">
                <span class="menu-caret">
                  <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-success">assignment_turned_in </i>
               <!--  <span class="badge bg-primary pull-right">08</span> -->
                <span>ACC KAPOLSEK</span>
              </a>

              <ul class="sub-menu">
                <li>
                  <a href="{{url('acc/nikah/polsek')}}">
                    <span>Nikah</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('acc/cerai/polsek')}}">
                    <span>Cerai</span>
                  </a>
                </li>
                <li>
                  <a href="?target=user">
                    <span>Rujuk</span>
                  </a>
                </li>
              </ul>
          
          </li>
           <li>
              <a href="/logout">
                <i class="material-icons text-info">power_settings_new</i>
                <span>Logout</span>
              </a>
            </li>
            @endif
            @if(auth()->user()->level=="pimpinan")
          <li>  
            
              <!-- <a href="?target=accbagian">
                <i class="material-icons text-success">assignment_turned_in</i>
                <span>ACC PIMPINAN BAGIAN</span>
              </a> -->
              <a href="javascript:;">
                <span class="menu-caret">
                  <i class="material-icons">arrow_drop_down</i>
                </span>
                <i class="material-icons text-success">assignment_turned_in </i>
               <!--  <span class="badge bg-primary pull-right">08</span> -->
                <span>ACC PIMPINAN BAGIAN</span>
              </a>

              <ul class="sub-menu">
                <li>
                  <a href="{{url('acc/bagian')}}">
                    <span>Nikah</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('acc/cerai/pimpinan')}}">
                    <span>Cerai</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>Rujuk</span>
                  </a>
                </li>
              </ul>
          </li>
           <li>
              <a href="/logout">
                <i class="material-icons text-info">power_settings_new</i>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </nav>
        @endif
            <!-- apps -->
            <!-- menu levels -->
            
            <!-- menu levels -->
            <!-- /static -->
            <!-- documentation -->
            
            <!-- /documentation -->
          </ul>
        </nav>
        <!-- /main navigation -->
      </div>

      <!-- /sidebar panel -->
      <!-- content panel -->
      <div class="main-panel">
        <!-- top header -->
        <nav class="header navbar">
          <div class="header-inner">
            <div class="navbar-item navbar-spacer-right brand hidden-lg-up">
              <!-- toggle offscreen menu -->
              <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen">
                <i class="material-icons">menu</i>
              </a>
              <!-- /toggle offscreen menu -->
              <!-- logo -->
              <a class="brand-logo hidden-xs-down">
                <img src="{{asset('images/logo_white.png')}}" alt="logo"/>
              </a>
              <!-- /logo -->
            </div>
            <a class="navbar-item navbar-spacer-right navbar-heading hidden-md-down" href="#">
              <center><span><marquee direction="right"><b style="font-size:14pt;">SISTEM INFORMASI IZIN</marquee></span></b>
                </center>
              </a>
            <div class="navbar-search navbar-item">
            </div>
            <div class="navbar-item nav navbar-nav">
              <div class="nav-item nav-link dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  
                </a>
              
                <div class="dropdown-menu dropdown-menu-right notifications">
                  <div class="dropdown-item">
                    <div class="notifications-wrapper">
                      <ul class="notifications-list">
                        <li>
                          <a href="javascript:;">
                            <div class="notification-icon">
                              <div class="circle-icon bg-success text-white">
                                
                              </div>
                            </div>
                            <div class="notification-message">
                              
                          </a>
                        </li>
                        <li>
                          <a href="javascript:;">
                            <div class="notification-icon">
                              <div class="circle-icon bg-danger text-white">
                                <i class="material-icons">check</i>
                              </div>
                            </div>
                            <div class="notification-message">
                              <b>Removed calendar</b>
                              from app list
                              <span class="time">4 hours ago</span>
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="javascript:;">
                            <span class="notification-icon">
                              <span class="circle-icon bg-info text-white">J</span>
                            </span>
                            <div class="notification-message">
                              <b>Jack Hunt</b>
                              has
                              <b>joined</b>
                              mailing list
                              <span class="time">9 days ago</span>
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="javascript:;">
                            <span class="notification-icon">
                              <span class="circle-icon bg-primary text-white">C</span>
                            </span>
                            <div class="notification-message">
                              <b>Conan Johns</b>
                              created a new list
                              <span class="time">9 days ago</span>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="notification-footer">Notifications</div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </nav>
        <!-- /top header -->

        <!-- main area -->
        <div class="main-content">
          <div class="content-view">
             <div class="row">
                <div class="col-lg-12 col-md-12">
                   <div class="card">

                     @yield('card-header')

                     @yield('content')
                      
                   </div>
                </div>
             </div>
        </div>

    <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script>

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="{{asset('style_admin/vendor/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('style_admin/vendor/pace/pace.js')}}"></script>
    <script src="{{asset('style_admin/style_admin/vendor/tether/dist/js/tether.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap/dist/js/bootstrap.js')}}"></script>
    <script src="{{asset('style_admin/vendor/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('style_admin/scripts/constants.js')}}"></script>
    <script src="{{asset('style_admin/scripts/main.js')}}"></script>
    <script src="{{asset('style_admin/vendor/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <script src="{{asset('style_admin/vendor/intl-tel-input//build/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('style_admin/vendor/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
    <script src="{{asset('style_admin/vendor/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <script src="{{asset('style_admin/vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('style_admin/vendor/select2/select2.js')}}"></script>
    <script src="{{asset('style_admin/vendor/selectize/dist/js/standalone/selectize.min.js')}}"></script>
    <script src="{{asset('style_admin/vendor/jquery-labelauty/source/jquery-labelauty.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap-maxlength/src/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('style_admin/vendor/typeahead.js/dist/typeahead.bundle.js')}}"></script>
    <script src="{{asset('style_admin/vendor/multiselect/js/jquery.multi-select.js')}}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{asset('style_admin/scripts/forms/plugins.js')}}"></script>
    <!-- endbuild -->
    <!-- page scripts -->
    <script src="{{asset('style_admin/vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('style_admin/vendor/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
      $('#id_dataTables').DataTable({
        // 'ajax': 'data/datatables-arrays.json'
      });
    </script>
    <script>
      function getcalonCerai(id) {
          if (id == '') {
              $("#NRP").val('');
              $("#nama_kep").val('');
              $("#Pangkat").val('');
              $("#Jabatan").val('');
              $("#Nama_c").val('');
              $("#Pekerjaan_c").val('');
          }else{
              $.getJSON('/getDataCalonCerai/'+id, null,
                  function(data){
                      $("#NRP").val(data.dataCerai.NRP);
                      $("#nama_kep").val(data.dataCerai.nama_kep);
                      $("#Pangkat").val(data.dataCerai.Pangkat);
                      $("#Jabatan").val(data.dataCerai.Jabatan);
                      $("#Nama_c").val(data.dataCerai.Nama_c);
                      $("#Pekerjaan_c").val(data.dataCerai.Pekerjaan_c);
              });
          }
      }
      function getDataKepolisian(id) {
          if (id == '') {
              $("#nama_kep").val('');
          }else{
              $.getJSON('/getDataKepolisian/'+id, null,
                  function(data){
                      $("#nama_kep").val(data.dataKepolisian.nama_kep);
              });
          }
      }
      function getDataAnggota(id) {
          if (id == '') {
              $("#Pangkat").val('');
              $("#Jabatan").val('');
          }else{
              $.getJSON('/getDataAnggota/'+id, null,
                  function(data){
                    $("#Pangkat").val(data.dataAnggota.Pangkat);
                    $("#Jabatan").val(data.dataAnggota.Jabatan);
              });
          }
      }
      function getDataCalon(id) {
          if (id == '') {
              $("#Pekerjaan_c").val('');
          }else{
              $.getJSON('/getDataCalon/'+id, null,
                  function(data){
                    $("#Pekerjaan_c").val(data.dataCalon.Pekerjaan_c);
              });
          }
      }
  </script>
  </body>
</html>
