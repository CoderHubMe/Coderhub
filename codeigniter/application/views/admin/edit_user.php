<div class="row">
  <!-- left column -->
  <div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editing <?= $user->username ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="user-update-form" action="POST">
        <div class="box-body">
          <div class="form-group" id="fname-form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" value="<?= $user->fname ?>">
          </div>
          <div class="form-group" id="lname-form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" value="<?= $user->lname ?>">
          </div>
          <div class="form-group" id="username-form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?= $user->username ?>">
          </div>
          <div class="form-group" id="email-form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $user->email ?>">
          </div>
          <div class="form-group" id="github_username-form-group">
            <label for="github_username">GitHub Username</label>
            <input type="text" class="form-control" id="github_username" name="github_username" placeholder="Enter GitHub Username" value="<?= $user->github_username ?>">
          </div>
          <div class="form-group" id="birthday-form-group">
            <label for="birthday">Birthday</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control" id="birthday" name="birthday" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="<?= $user->birthday ?>">
            </div>
          </div>
          <div class="form-group">
            <label>Admin?</label>
            <select id="is_admin" name="is_admin" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
              <option <?= $user->is_admin == 1 ? 'selected="selected"' : "" ?> value='1'>Yes</option>
              <option <?= $user->is_admin == 0 ? 'selected="selected"' : "" ?> value='0'>No</option>
            </select>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="button
          <button type="submit" class="btn btn-primary pull-right" id='submitBtn'>Submit</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
    <div class="box box-danger collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">Delete <?= $user->username ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="user-delete-form" action="POST">
        <div class="box-body">
          <h3>Click to Delete This User</h3>
          <span class="help-block">This is not reversible!</span>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-danger pull-right" id='deleteBtn'>DELETE</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
  <!--/.col (left) -->
</div>
<script>

  //Datemask dd/mm/yyyy
  $("#birthday").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
  
  $('#submitBtn').click(function(e) {
    e.preventDefault();
    $('.form-group .help-block')
      .slideUp('fast', function() {
        $(this).remove();
      });
    $('.form-group').removeClass('has-error');
    
    $('#submitBtn').addClass('disabled');
    var submitBtnText = $('#submitBtn').html();
    $("#submitBtn").html('<i class="fa fa-refresh fa-spin"></i>');
    
    $.post('<?= base_url('users/edit_action/'.$user->id) ?>', $('#user-update-form').serialize(), function(data) {
      if(data.edit_success == true) {
        window.location.href = '<?= base_url('../public/admin/show_all_users') ?>';
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
  
  // Delete Button Functionality
  $('#deleteBtn').click(function(e) {
    e.preventDefault();
    $.post("<?= base_url('users/delete_action/'.$user->id) ?>", {'userId': <?= $user->id ?> });
    window.location.href = '<?= base_url('../public/admin/show_all_users') ?>';
  })
</script>