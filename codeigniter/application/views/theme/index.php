<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Top Navigation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('dist/css/skins/_all-skins.min.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?= base_url() ?>" class="navbar-brand">Coder<b>Hub</b>.me</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown <?= menu_is_active('users', $theme) ? 'active' : '' ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Edit Resume</a></li>
                <li><a href="<?= base_url('users/show_resume') ?>">View Resume</a></li>
              </ul>
            </li>
            <li class="dropdown <?= menu_is_active('connections', $theme) ? 'active' : '' ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connections <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">View Connections</a></li>
                <li><a href="<?= base_url() ?>">Search For User</a></li>
              </ul>
            </li>
            <li class="dropdown <?= menu_is_active('companies', $theme) ? 'active' : '' ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Companies <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">View Connected Companies</a></li>
                <li><a href="<?= base_url() ?>">Search For Company</a></li>
                <li><a href="<?= base_url() ?>">Search For Company</a></li>
                <li class="divider"></li>
                <li><a href="<?= base_url() ?>">Edit My Company</a></li>
                <li><a href="<?= base_url() ?>">View My Company</a></li>
                <li><a href="<?= base_url() ?>">Create A Company</a></li>
                
              </ul>
            </li>
            <li class="<?= menu_is_active('link', $theme) ? 'active' : '' ?>"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li class="<?= menu_is_active('link', $theme) ? 'active' : '' ?>"><a href="#">Link</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Pearse Hutson</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">

                  <p>
                    Pearse Hutson - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-6 text-center">
                      <a href="#">Profile</a>
                    </div>
                    <div class="col-xs-6 text-center">
                      <a href="#">Connections</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="text-center">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $theme['title'] ?>
          <small><?= $theme['subtitle'] ?></small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <?php
          foreach($theme['breadcrumbs'] as $text => $url) {
            if(strtolower($text) != 'home') {
              echo "<li><a href='{$url}'>{$text}</a></li>";
            }
          }
        ?>
      </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?= $view_content ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 0.3.0
      </div>
      <strong>Copyright &copy; 2016 <a href="coderhub.me">Coder<b>Hub</b>.me</a>.</strong> All rights reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="<?= base_url('plugins/jQuery/jQuery-2.2.0.min.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- SlimScroll -->
<script src="<?= base_url('plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= base_url('plugins/fastclick/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/js/app.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('dist/js/demo.js') ?>"></script>
</body>
</html>
