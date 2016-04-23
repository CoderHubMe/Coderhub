<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Responsive Hover Table</h3>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
          </tr>
          <?php foreach($users as $user): ?>
          <tr data-user-id="<?= $user->id ?>">
            <td><?= $user->fname ?></td>
            <td><?= $user->lname ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
          </tr>
          <?php endforeach ?>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

<script>
  $(document).ready(function() {
    $("tr[data-user-id]").click(function(e) {
      e.preventDefault();
      window.location.href = "<?= base_url('users/profile') ?>" + '/' + $(this).attr('data-user-id')
    });
  });
</script>