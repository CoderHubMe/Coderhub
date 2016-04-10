<div class="row">
  <!-- left column -->
  <div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Creating a Company</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="company-form" action="POST">
        <div class="box-body">
          <div class="form-group" id="name-form-group">
            <label for="name">Company Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name">
          </div>
          <div class="form-group" id="street_address-form-group">
            <label for="street_address">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address"placeholder="Street Address">
          </div>
          <div class="form-group" id="owner-form-group">
            <label for="Owner">Owner</label>
            <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" id='submitBtn'>Submit</button>
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
    
    $.post('<?= base_url('companies/create_action') ?>', $('#company-form').serialize(), function(data) {
      if(data.create_success == true) {
        window.location.href = '<?= base_url('companies/show') ?>' + '/' + data.newCompanyId;
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