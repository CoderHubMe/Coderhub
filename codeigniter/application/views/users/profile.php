<?php
  require_once(APPPATH . "/libraries/github-helper.php");
?>
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= isset($user->profile_image_url) ? $user->profile_image_url : base_url('dist/img/avatar5.png')  ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?= $user->fname ?> <?= $user->lname ?></h3>

        <ul class="list-group list-group-unbsessordered">
          <li class="list-group-item">
            <b><?= count($user->accepted_connections) == 1 ? 'Connection' : 'Connections' ?></b> <a class="pull-right"><?= count($user->accepted_connections) ?></a>
          </li>
        </ul>
        <?php 
          $stopFlag = false;
          if(!isset($_SESSION['userId'])) {
            $stopFlag = true;
          }
          
          if(!$stopFlag) {
            foreach($user->accepted_connections as $connection) {
              if($connection->id == $_SESSION['userId']) {
                echo 'You Are Connected!';
                $stopFlag = true;
                break;
              }
            }
          }
          
          if(!$stopFlag){
            foreach($user->requested_connections as $connection) {
              if($connection->id == $_SESSION['userId']) {
                echo 'Waiting on them to accept your connection request';
                $stopFlag = true;
                break;
              }
            }
          }
          
          if(!$stopFlag) {
            if($user->id !== $_SESSION['userId']) {
              echo "<a href='" . base_url('connections/request_connection/' . $_SESSION['userId'] . '/' . $user->id) ."' class='btn btn-primary btn-block'><b>Connect With Me</b></a>";
            }
          }
        ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">About Me</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
       <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

        <p>
        <?php $skillColors = array("danger", "success", "info", "warning", "primary"); ?>
        <?php foreach($user->skills as $skill): ?>
          <span class="label label-<?=$skillColors[array_rand($skillColors)]?>"><?=$skill->name?></span>
        <?php endforeach ?>
        </p>

        <hr>

        <strong><i class="fa fa-file-text-o margin-r-5"></i> About Me</strong>

        <p><?= $user->description ?></p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#work_history" data-toggle="tab">Work History</a></li>
        <li><a href="#education_history" data-toggle="tab">Education History</a></li>
        <li><a href="#github" data-toggle="tab">GitHub</a></li>
        <li><a href="#connections" data-toggle="tab">Connections</a></li>
      <?php if(isset($_SESSION['userId']) && $user->id === $_SESSION['userId']): ?>
        <li><a href="#pending_connections" data-toggle="tab">Pending Connections</a></li>
      <?php endif ?>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="work_history">
        <?php foreach($user->work_nodes as $workNode): ?>
          <!-- Post -->
          <div class="post clearfix">
            <p>
              <b><?= $workNode->position ?></b><br>
              <?= $workNode->company_name ?><br>
              <?= $workNode->start_date . ' to ' . ($workNode->end_date == null ? 'Present' : $workNode->end_date) ?><br>
              <?= $workNode->description ?>
            </p>
          </div>
          <!-- /.post -->
        <?php endforeach ?>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="education_history">
        <?php foreach($user->education_nodes as $educationNode): ?>
          <!-- Post -->
          <div class="post clearfix">
            <p>
              <b><?= $educationNode->school_name ?></b><br>
              <?= $educationNode->degree_type . ' degree, ' . $educationNode->major ?><br>
              <?= $educationNode->start_date . ' to ' . ($educationNode->end_date == null ? 'Present' : $educationNode->end_date) ?><br>
            </p>
          </div>
          <!-- /.post -->
        <?php endforeach ?>
          
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="github">
          <?php
            if(isset($_SESSION['token']) && strcmp($_SESSION['token'], '') == false) {
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
            } elseif(isset($_SESSION['user_github'])) {
              $response = git_repos($_SESSION['user_github']);
              $repos = json_decode($response, true);
              foreach($repos as $repo) {
                echo "<p>" . $repo['name'] . "</p>";
              }
            }
          ?>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="connections">
        <?php foreach($user->accepted_connections as $connection): ?>
          <!-- Post -->
          <div class="post clearfix">
            <p>
              <a href="<?= base_url('users/profile/' . $connection->id) ?>">
                <b><?= $connection->username ?></b> 
                <?= $connection->fname ?>
                <?= $connection->lname ?>
              </a><br>
            </p>
          </div>
          <!-- /.post -->
        <?php endforeach ?>
        </div>
      <!-- /.tab-content -->
      <?php if(isset($_SESSION['userId']) && $user->id === $_SESSION['userId']): ?>
        <div class="tab-pane" id="pending_connections">
        <?php foreach($user->requested_connections as $connection): ?>
          <!-- Post -->
          <div class="post clearfix">
            <!--<div class="row">-->
              <div class="col-md-8">
                <a href="<?= base_url('users/profile/' . $connection->id) ?>">
                  <b><?= $connection->username ?></b> 
                  <?= $connection->fname ?> <?= $connection->lname ?>
                </a>
              </div>
              <div class="col-md-2">
                <a href="#" class="btn btn-primary">Add Me!</a>
              </div>
              <div class="col-md-2">
                <a href="#" class="btn btn-danger">Block Me</a>
              </div>
            <!--</div>-->
          </div>
          <!-- /.post -->
        <?php endforeach ?>
        </div>
      <?php endif ?>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
