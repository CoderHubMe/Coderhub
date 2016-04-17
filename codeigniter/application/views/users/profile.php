<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= $user->profile_image_url == null ? base_url("dist/img/avatar5.png") : $user->profile_image_url ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?= $user->fname . ' ' . $user->lname ?></h3>

        <p class="text-muted text-center"><?= !isset($user->work_nodes[0]) ? "No Position" : $user->work_nodes[0]->position ?></p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Connection</b> <a class="pull-right">1,322</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Connect With Me</b></a>
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
          <b>Nothing Here For Now</b>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->