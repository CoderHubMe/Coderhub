<div class="row">
  <?php
    foreach($users as $user) {
  ?>
  <div class="col-md-4">
    <!-- USERS LIST -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $user->fname ?> <?= $user->lname ?></h3>
  
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <dl class="dl-horizontal">
          <dt>First Name</dt>
            <dd><?= $user->fname ?></dd>
          <dt>Last Name</dt>
            <dd><?= $user->lname ?></dd>
          <dt>Username</dt>
            <dd><?= $user->username ?></dd>
          <dt>Email</dt>
            <dd><?= $user->email ?></dd>
          <dt>Github Username</dt>
            <dd><?= $user->github_username ?></dd>
          <dt>Birthday</dt>
            <dd><?= $user->birthday ?></dd>
          <dt>Admin?</dt>
            <dd><?= $user->is_admin == 1 ? 'Yes' : 'No' ?></dd>
        </dl>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href='<?= base_url('admin/delete_user_action/'.$user->id) ?>' class="btn btn-danger pull-left" id='delete_<?= $user->id ?>'>DELETE <?= $user->username ?></a>
        <a href='<?= base_url('admin/edit_user/'.$user->id) ?>' class="btn btn-primary pull-right" id='edit_<?= $user->id ?>'>Edit <?= $user->username ?></a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!--/.box -->
  </div>


<?php
  } // end foreach()
?>
</div>