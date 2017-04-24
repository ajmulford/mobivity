    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/dist/js/sb-admin-2.js"></script>

  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    var clientIP;
 
  $.get("http://ipinfo.io", function(response) {
        clientIP = response.ip;
        }, "jsonp");
 
    function add_contact()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Contact'); // Set Title to Bootstrap modal title
    }
 
    function edit_contact(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('/contacts/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="contactID"]').val(data.contactID);
            $('[name="clientIP"]').val(clientIP);
            $('[name="fullName"]').val(data.fullName);
            $('[name="company"]').val(data.company);
            $('[name="phone"]').val(data.phone);
            $('[name="email"]').val(data.email);
            $('[name="country"]').val(data.country);
 
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Contact'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('contacts/contacts_add')?>";
      }
      else
      {
        url = "<?php echo site_url('contacts/contacts_update')?>";
      }
 
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function delete_contact(id)
    {
      if(confirm('Are you sure delete this contact?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('contacts/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting contact');
            }
        });
 
      }
    }
 
  </script>
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Add Contact</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="contactID"/>
          <input type="hidden" value="" name="clientIP"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Full Name</label>
              <div class="col-md-9">
                <input name="fullName" placeholder="Full Name" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Company</label>
              <div class="col-md-9">
                <select name="company" class="form-control">
                <?php while (list($key, $val) = each($companies)) {
                echo "<option value=$key>$val</option>";
                } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Phone</label>
              <div class="col-md-9">
                <input name="phone" placeholder="Phone" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
                    <label class="control-label col-md-3">Email</label>
                    <div class="col-md-9">
                            <input name="email" placeholder="Email" class="form-control" type="text">
                    </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Country</label>
                <div class="col-md-9">
                <select name="country" class="form-control">
                <?php while (list($key, $val) = each($countries)) {
                echo "<option value=$key>$val</option>";
                } ?>
                </select>
                </div>
            </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
 
</body>

</html>
