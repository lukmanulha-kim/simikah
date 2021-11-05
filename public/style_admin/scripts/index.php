<?php
$host = "localhost";//nama host dari database
$user = "root";//username host dari database
$pass = ""; //password database
$db = "ubudiyah"; //nama database
$koneksi = mysql_connect($host, $user, $pass); //melakukan koneksi ke host
  if (!$koneksi){ //jika konesi ke database gagal maka munculkan pesan error
  echo "Couldn't connect to host $host because <b> ".mysql_error()."</b>";
  }else{//sebaliknya jika koneksi berhasil
  $select_db = mysql_select_db($db);//melakukan pemilihan database berdasarkan value dari $db
    if (!$select_db){//jika pemilihan database gagal maka munculkan pesan error
      echo "Couldn't select database $db because <b>".mysql_error()."</b>";
    }
  }
if (isset($_POST['login'])) {
$username = $_POST['username'];
$pass     = md5($_POST['pass']);

$login = mysql_query("SELECT * FROM tbpetugas WHERE username='$username' AND password='$pass'");
$ketemu= mysql_num_rows($login);
$r = mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  
  header('location:ubudiyah.php');
}
else{
  header('location:index.php');
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Sistem Informasi Ubudiyah</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" class="input-block-level" placeholder="Username">
        <input type="password" name="pass" class="input-block-level" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" name="login" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>