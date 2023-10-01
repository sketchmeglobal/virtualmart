<?php 
include '../function/functions.php';

$_SESSION['msg'] = '';
if (isset($_POST['submit'])) {
  extract($_POST);
  $user = login($userid,$password,$admin=true);

  if ($token == $_SESSION['token']) {
    if ($user['status']>0) {
    header('location:index.php');
    exit();
    }else{
      $_SESSION['msg'] = 'Invalid username or password';
    }
  }else{
    $_SESSION['msg'] = 'Please try again';
  }
  
}

$_SESSION['token'] = sha1(rand());
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Login</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-dark">
 <!-- Start wrapper-->
 <div id="wrapper">
  <div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
     <div class="card-content p-2">
      <div class="text-center">
        <img src="assets/images/logo-icon.png" alt="logo icon">
      </div>
      <div class="card-title text-uppercase text-center py-3">Sign In</div>
      <?php echo '<p class="text-center text-danger">'.$_SESSION['msg'].'</p>'; ?>

        <form action="" method="post">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <div class="form-group">
        <label for="exampleInputEmailId" class="">Username</label>
         <div class="position-relative has-icon-right">
          <input type="text" id="exampleInputEmailId" class="form-control input-shadow" name="userid" placeholder="Enter Your Email ID">
          <div class="form-control-position">
            <i class="icon-envelope-open"></i>
          </div>
         </div>
        </div>
        <div class="form-group">
         <label for="exampleInputPassword" class="">Password</label>
         <div class="position-relative has-icon-right">
          <input type="text" id="exampleInputPassword" class="form-control input-shadow" name="password" placeholder="Choose Password">
          <div class="form-control-position">
            <i class="icon-lock"></i>
          </div>
         </div>
        </div>
        
       <button type="submit" class="btn btn-primary shadow-primary btn-block waves-effect waves-light" name="submit">Sign In</button>
       </form>
       </div>
      </div>
       </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    
  </div><!--wrapper-->
  
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  
</body>
</html>
