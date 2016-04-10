<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CoderHub.me | Registration Page</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('plugins/iCheck/square/blue.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url() ?>">Coder<b>Hub</b>.me</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form method="post" id="registerForm">
      <div id="username-form-group" class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" id="username" name="username">
        <span class="glyphicon glyphicon-tags form-control-feedback"></span>
      </div>
      <div id="fname-form-group" class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="First name" id="fname" name="fname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div id="lname-form-group"class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Last name" id="lname" name="lname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div id="email-form-group" class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div id="password-form-group" class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div id="password-confirm-form-group" class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" id="password-confirm" name="password-confirm">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">-->
          <!--  <label>-->
          <!--    <input type="checkbox"> I agree to the <a href="#">terms</a>-->
          <!--  </label>-->
          <!--</div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="submitBtn">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="<?= base_url('login') ?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="<?= base_url('plugins/jQuery/jQuery-2.2.0.min.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $("#submitBtn").click(function(e) {
    e.preventDefault();
    $('.form-group .help-block')
      .slideUp('fast', function() {
        $(this).remove();
      });
    $('.form-group').removeClass('has-error');
    
    $('#submitBtn').addClass('disabled');
    var submitBtnText = $('#submitBtn').html();
    $("#submitBtn").html('<i class="fa fa-refresh fa-spin"></i>');
    
    $.post("<?= base_url('login/register_action') ?>", $("#registerForm").serialize(), function(data) {
      if(data.register_success == true) {
        window.location.href = '<?= base_url('login') ?>';
      } else {
        console.dir(data);
        $.each(data.errors, function( key, value ) {
          $('#' + key + '-form-group')
            .addClass('has-error')
            .append('<span class="help-block">' + value +'</span>')
          
        });
        $(".help-block")
          .hide()
          .slideDown('fast');
        $('#submitBtn').removeClass('disabled');
        $('#submitBtn').html(submitBtnText);
      }
    })
  })
  

</script>
</body>
</html>
