<div class="row">
  <!-- left column -->
  <div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editing <?= $company->name ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="company-update-form" action="POST">
        <div class="box-body">
          <div class="form-group" id="name-form-group">
            <label for="name">Company Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" value="<?= $company->name ?>">
          </div>
          <div class="form-group" id="street_address-form-group">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Street Address" value="<?= $company->street_address ?>">
          </div>
          <div class="form-group" id="owner-form-group">
            <label for="Owner">Owner</label>
            <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner" value="<?= $company->owner ?>">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" id='submitBtn'>Submit</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
    <div class="box box-danger collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">Delete <?= $company->name ?></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="company-delete-form" action="POST">
        <div class="box-body">
          <h3>Click to Delete This Company</h3>
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
    
    $.post('<?= base_url('companies/edit_action/'.$company->id) ?>', $('#company-update-form').serialize(), function(data) {
      if(data.edit_success == true) {
        window.location.href = '<?= base_url('companies/show/'.$company->id) ?>';
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
    $.post("<?= base_url('companies/delete_action/'.$company->id) ?>", {'companyId': <?= $company->id ?> });
    window.location.href = '<?= base_url() ?>';
  })
</script>