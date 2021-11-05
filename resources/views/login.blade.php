<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="shortcut icon" href="images/PL.png">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Milestone">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Milestone">

    <meta name="theme-color" content="#4C7FF0">
    
    <title>SISTEM INFORMASI IZIN</title>

    <!-- page stylesheets -->
    <!-- end page stylesheets -->

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

    <div class="app no-padding no-footer layout-static">
      <div class="session-panel">
        <div class="session">
          <div class="session-content">
            <div class="card card-block">
              <form method="post" action="ceklogin">
              @csrf
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="text-xs-center">
                  <img src="{{asset('style_admin/images/PL.png')}}" height="80" alt="" class="m-b-1"/>
                  <h5>
                    SIMIKAH-SISTEM INFORMASI NIKAHsjdkhskj
                  </h5>
                  <p class="text-muted">
                    Silahkan Login untuk masuk.
                  </p>
                </div>
                <fieldset class="form-group">
                  <label for="username">
                    username
                  </label>
                  <input type="text" name="email" class="form-control" id="username" placeholder="username" required/>
                </fieldset>
                <fieldset class="form-group">
                  <label for="password">
                    password
                  </label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="********" required/>
                </fieldset>
                <button class="btn btn-primary btn-block" type="submit">
                  Login
                </button>
                <div class="divider">
                  <span>
                  </span>
                </div>
                </form>
            </div>
          </div>
          
</div>
</div>
</div>

    {{-- <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script> --}}

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    <script src="{{asset('style_admin/vendor/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('style_admin/vendor/pace/pace.js')}}"></script>
    <script src="{{asset('style_admin/vendor/tether/dist/js/tether.js')}}"></script>
    <script src="{{asset('style_admin/vendor/bootstrap/dist/js/bootstrap.js')}}"></script>
    <script src="{{asset('style_admin/vendor/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('style_admin/scripts/constants.js')}}"></script>
    <script src="{{asset('style_admin/scripts/main.js')}}"></script>
    <!-- endbuild -->

    <!-- page scripts -->
   
    
  </body>
</html>