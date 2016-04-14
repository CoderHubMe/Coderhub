<div class="row">
  <?php
    foreach($skills as $skill) {
  ?>
  <div class="col-md-4">
    <!-- USERS LIST -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $skill->name ?></h3>
      <!-- /.box-footer -->
      </div>
    </div>
    <!--/.box -->
  </div>
<?php
  } // end foreach()
?>
</div>