<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
  <link rel="icon" href="assets/img/favicon.ico">

  <!--copy cat kent city font (aka free font)-->
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

  <title>Kent Serves</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">

  <!-- Font Awesome styles for this template -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/editedStyle.css" rel="stylesheet">
  <!--  <link href="assets/css/style.css" rel="stylesheet"> -->



  <!-- Nicole's CSS -->
  <link href="assets/css/nicole.css" rel="stylesheet">

  <!-- Sergio's CSS -->
  <link href="assets/css/sergio.css" rel="stylesheet">

  <!-- Chris' CSS -->
  <link href="assets/css/chris.css" rel="stylesheet">


  <!-- Just for debugging purposes. Don't actually copy this line! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="assets/js/modernizr.js"></script>
</head>

<body>
  <?php // Get page name so we can display the proper active link
  $currentPage = basename($_SERVER['PHP_SELF']);
  ?>
  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php"><img class="logo" src="assets/img/LogoNew.png" alt="Kent Serves"></a>
        <!--<a class="navbar-brand" href="index.php">Kent Serves</a>-->
      </div>
      <div class="navbar-collapse collapse navbar-right">
        <ul class="nav navbar-nav">
          <li <?php if($currentPage == "index.php") echo 'class="current-menu-item"'; ?>><a href="index.php">HOME</a></li>
          <li <?php if($currentPage == "register.php") echo 'class="current-menu-item"'; ?>><a href="register.php">REGISTER</a></li>
          <li <?php if($currentPage == "partnerstable.php") echo 'class="current-menu-item"'; ?>><a href="partnerstable.php">PARTNERS</a></li>
          <li <?php if($currentPage == "calendar.php") echo 'class="current-menu-item"'; ?>><a href="calendar.php">EVENTS</a></li>
          <?php $linkToDisplay = ($user) ? "<a href='profile.php'>PROFILE</a>" : "<a href='login.php'>LOGIN</a>"; ?>
          <li><?php echo $linkToDisplay; ?></li>
          <?php if($user) echo "<li><a href='logout.php'>LOGOUT</a></li>"; ?>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>

  <?php require_once('../db.php'); ?>
