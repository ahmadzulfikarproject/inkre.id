<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Page <small>halaman statis</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class='btn btn-primary' href='<?php echo base_url(); ?>pages/tambah_pages'>Tambahkan Data</a></li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Custom Filter : </h3>
          </div>
          <div class="panel-body">
            <form id="form-filter" class="form-horizontal">
              <div class="form-group">
                <label for="country" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-4">
                  <?php echo $form_country; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="FirstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="FirstName">
                </div>
              </div>
              <div class="form-group">
                <label for="LastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="LastName">
                </div>
              </div>
              <div class="form-group">
                <label for="LastName" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-4">
                  <textarea class="form-control" id="address"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="LastName" class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                  <span class="input-group-btn">
                    <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                    <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>City</th>
              <th>Country</th>
            </tr>
          </thead>
          <tbody>
          </tbody>

          <tfoot>
            <tr>
              <th>No</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>City</th>
              <th>Country</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
ob_start();
?>
<script type="text/javascript">
  // var backend_url = '<?php echo base_url(); ?>';
  var table;
  $(document).ready(function() {
    $('#example1').DataTable({
      dom: 'Bfrtip',
      buttons: [{
        text: 'Add Page',
        action: function(e, dt, node, config) {
          // alert('Button activated');
          // window.location.href = '<?php echo base_url("pages/tambah_pages"); ?>';
        }
      }]
    });

    //datatables serverside
    table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('customers/ajax_list') ?>",
        "type": "POST",
        "data": function(data) {
          data.country = $('#country').val();
          data.FirstName = $('#FirstName').val();
          data.LastName = $('#LastName').val();
          data.address = $('#address').val();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],

    });

    $('#btn-filter').click(function() { //button filter event click
      table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
      $('#form-filter')[0].reset();
      table.ajax.reload(); //just reload table
    });
    //enter keyboard
    $(document).on("keypress", ".form-group:has(input:input, span.input-group-btn:has(button#btn-filter)) input:input", function(e) {
      if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("btn-filter").click();
        // $(this).closest(".form-group").find("button#btn-filter").click();
      }
    });
    // Get the input field

    // var input = document.getElementsByClassName("form-control");

    // // Execute a function when the user releases a key on the keyboard
    // input.addEventListener("keyup", function(event) {
    //   // Number 13 is the "Enter" key on the keyboard
    //   if (event.keyCode === 13) {
    //     // Cancel the default action, if needed
    //     event.preventDefault();
    //     // Trigger the button element with a click
    //     document.getElementById("btn-filter").click();
    //   }
    // });
  });
</script>
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>
