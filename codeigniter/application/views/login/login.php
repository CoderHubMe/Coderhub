<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CoderHub | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/AdminLTE.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('/plugins/iCheck/square/blue.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url()?>"> < Coder<b>Hub</b> /> </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?= base_url()?>" method="post" id="login-form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" id="password-form-group">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="signInBtn">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-github btn-flat"><i class="fa fa-github"></i> Sign up using
          Github</a>
      </div>
    <div class="row">
      <div class="col-xs-8">
        <!--<div class="checkbox icheck">-->
        <!--  <label>-->
        <!--    <input type="checkbox"> I agree to the <a href="#">terms</a>-->
        <!--  </label>-->
        <!--</div>-->
        <a href="<?= base_url('/login/register') ?>" class="text-center">Register a new membership</a>
      </div>
    </div>
    <!-- /.social-auth-links -->

    <!--<a href="#" class='btn disabled'>I forgot my password</a><br>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="<?= base_url('/plugins/jQuery/jQuery-2.2.0.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- iCheck -->
<script src="<?= base_url('/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $('#signInBtn').click(function(e) {
    e.preventDefault();
    $(".help-block").remove();
    $("#password-form-group").removeClass('has-error');
    
    $('#signInBtn').addClass('disabled');
    var signInBtnText = $('#signInBtn').html();
    $("#signInBtn").html('<i class="fa fa-refresh fa-spin"></i>');
    z
    $.post('<?= base_url('login/login_action') ?>', $('#login-form').serialize(), function(data) {
      if(data.login_success == true) {
        window.location.href = '<?= base_url() ?>';
      } else {
        $("#password-form-group").addClass('has-error').append('<span class="help-block">Password Does Not Match Username</span>');
        $('#signInBtn').removeClass('disabled');
        $('#signInBtn').html(signInBtnText);
      }
    });
  });
</script>
</body>
</html>
