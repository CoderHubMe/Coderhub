<?php
  require_once(APPPATH . "/libraries/github-helper.php");
  $user = (array)$user_data;
?>
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?=$_SESSION['profile_image']?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?=$_SESSION['user_fname']?> <?=$_SESSION['user_lname']?></h3>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Following</b> <a class="pull-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="pull-right">13,287</a>
          </li>
        </ul>
      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">About Me</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa fa-book margin-r-5"></i>Education</strong>
        <p class="text-muted">
          B.S. in Computer Science from the University of Tennessee at Knoxville
        </p>

        <hr>

        <strong><i class="fa fa-map-marker margin-r-5"></i>Location</strong>
        <p class="text-muted">Malibu, California</p>

        <hr>

        <strong><i class="fa fa-pencil margin-r-5"></i>Skills</strong>
        <p>
          <span class="label label-danger">UI Design</span>
          <span class="label label-success">Coding</span>
          <span class="label label-info">Javascript</span>
          <span class="label label-warning">PHP</span>
          <span class="label label-primary">Node.js</span>
        </p>
        <hr>

        <strong><i class="fa fa-file-text-o margin-r-5"></i>Description</strong>
        <p><?= $user['description'] ?></p>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab">GitHub</a></li>
      </ul>
      <div class="tab-content">
        <?php
          if(strcmp($_SESSION['token'], '') == false) {
        ?>
            <div class="social-auth-links text-center">
              <p>You are not connected to GitHub!</p>
              <form action="https://github.com/login/oauth/authorize" method='GET'>
                <input type="hidden" name="client_id" value=<?= CLIENT_ID ?>>
                <input type="hidden" name="scope" value=<?= "user,repo" ?>>
                <button class="btn btn-block btn-social btn-github btn-flat">
                  <i class="fa fa-github"></i> 
                  Sign in using Github
                </button>
              </form>
            </div>
        <?php 
          } else {
            $response = git_repos($_SESSION['user_github']);
            $repos = json_decode($response, true);
            foreach($repos as $repo) {
              echo "<p>" . $repo['name'] . "</p>";
            }
          }
        ?>
      </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
  </div><!-- /.col -->
</div><!-- /.row -->