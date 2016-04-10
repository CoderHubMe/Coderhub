<?php
foreach($companies as $company) {
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <a href="<?= base_url('companies/show/' . $company->id) ?>"><?= $company->name ?></a>
      <!-- /.box-body -->
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>

<?php
}
?>