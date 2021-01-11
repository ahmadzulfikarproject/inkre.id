<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Filter Data <small>berdasarkan kriteria</small></h2>
        <ul class="nav navbar-right panel_toolbox">
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
        <br>
        <?php
        $attributes = array('id' => 'form-filter', 'class' => 'form-horizontal form-label-left', 'role' => 'form');
        echo form_open_multipart('', $attributes);
        ?>
        <!-- <form id="form-filter" class="form-horizontal form-label-left"> -->
        <!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> -->
        <div class="col-md-7">
          <label for="Title">Title</label>
          <fieldset>
            <div class="form-group">
              <div class="controls">
                <div class="input-prepend input-group">
                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                  <input type="text" class="form-control" id="judul" placeholder="cari berdasarkan judul halaman...">
                </div>
              </div>
            </div>
          </fieldset>
        </div>

        <div class="col-md-5">

          <label for="Category">Category</label>
          <fieldset>
            <div class="form-group">
              <div class="controls">
                <div class="input-prepend input-group">
                  <?php echo $form_category; ?>
                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-list fa fa-list"></i></span>
                </div>
              </div>
            </div>
          </fieldset>
        </div>

        <div class="col-sm-12">
          <div class="ln_solid"></div>
          <label for="action"></label>
          <fieldset>
            <div class="form-group">
              <label for="LastName" class="col-sm-2 control-label"></label>
              <div class="col-sm-12">
                <span class="input-group-btn">
                  <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                  <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                </span>
              </div>
            </div>
          </fieldset>
        </div>
        </form>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_title">
        <h2>Form clients <small>halaman clients</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <!-- <li><a href="#resetModal" class="btn btn-lg btn-primary btn-sm" data-toggle="modal">Reset clients DB</a></li>
          <li><a class='btn btn-primary' href='<?php echo base_url(); ?>clients/add_clients'>Tambahkan Data</a></li> -->
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


        <!-- <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Data Filter : </h3>
          </div>
          <div class="panel-body">
            <form id="form-filter" class="form-horizontal">
              <div class="form-group">
                <label for="category" class="col-sm-2 control-label">category</label>
                <div class="col-sm-4">
                  <?php echo $form_category; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="judul" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="judul">
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
        </div> -->
        <table id="table" class="datalist table table-striped table-bordered" cellspacing="0" width="100%">
          <colgroup align="center">
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
          </colgroup>
          <thead>
            <tr>
              <th>No</th>
              <th>Image</th>
              <th>Judul</th>
              <!-- <th>Slug</th> -->
              <th>Category</th>
              <th>View</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>

          <tfoot>
            <tr>
              <th>No</th>
              <th>Image</th>
              <th>Judul</th>
              <!-- <th>Slug</th> -->
              <th>Category</th>
              <th>View</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
        <hr>
        <?= $button; ?>
        <?= $button_action; ?>
      </div>
    </div>
  </div>
</div>
<div class="loading" style="display: none;">
  <div class="content"><img src="<?php echo home_url() . 'asset/images/loading.gif'; ?>" /></div>
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
          // window.location.href = '<?php echo base_url("clients/tambah_clients/"); ?>';
        }
      }]
    });

    //datatables serverside
    table = $('#table').DataTable({
      "pageLength": 4,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('clients/ajax_list/') ?>",
        "type": "POST",
        "data": function(data) {
          data.category = $('#category').val();
          data.judul = $('#judul').val();
          // data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
          // data.date = $('#date').val();
        }
      },
      "createdRow": function(row, data, dataIndex) {

        // Add a class to the cell in the second column
        $(row).children(':nth-child(1)').addClass('text-center');
        $(row).children(':nth-child(2)').addClass('text-center img');
        $(row).children(':nth-child(6)').addClass('text-center actions');

        // Add a class to the row
        $(row).addClass('important');
      },
      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],
      // dom: 'Bfrtip',
      // buttons: [{
      //   text: 'Add Page',
      //   action: function(e, dt, node, config) {
      //     // alert('Button activated');
      //     // window.location.href = '<?php echo base_url("clients/tambah_clients/"); ?>';
      //   }
      // }]

    });

    $('#btn-filter').click(function() { //button filter event click
      table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
      $('#form-filter')[0].reset();
      table.ajax.reload(); //just reload table
    });
    //reset db
    $("#reset-db").click(function() {
      //var id = $(this).parents("tr").attr("id");


      //if(confirm('Are you sure to remove this record ?'))
      //{
      $.ajax({
        url: '<?php echo base_url("clients/reset_clients/"); ?>',
        type: 'DELETE',
        beforeSend: function() {
          //$('#enquiryList').hide();
          //$('#enquiryList').slideUp('slow');
          //$('#enquiryList table tbody').fadeOut("fast");
          //$('#enquiryList table tbody').css({'filter':'alpha(opacity=0)', 'zoom':'1', 'opacity':'0'});
          //$('#loadoverlay').show();
          //$('#enquiryList').html(html).hide().fadeOut();

          $('.loading').show();
        },
        error: function() {
          alert('Something is wrong');
        },
        success: function(data) {
          //$("#"+id).remove();

          $('.loading').fadeOut("fast", function() {
            table.ajax.reload(); //just reload table
            // searchFilter();
            // Animation complete.
            //$('#enquiryList').html(html);
            //$('#enquiryList table tbody').hide().fadeIn();
            //$('#loadoverlay').fadeOut("fast");
            //$('#enquiryList table tbody').fadeIn('fast');
            //$('#enquiryList table tbody').css({'filter':'alpha(opacity=100)', 'zoom':'1', 'opacity':'1'});
          });
          // alert("Record removed successfully");
        }
      });
      //}
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
<!-- Modal HTML -->
<div id="resetModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Do you want to save changes you made to document before closing?</p>
        <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="reset-db" type="button" class="btn btn-primary" data-dismiss="modal">Reset</button>
      </div>
    </div>
  </div>
</div>
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>