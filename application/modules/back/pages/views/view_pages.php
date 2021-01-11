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
        <form class="form-horizontal form-label-left" novalidate="">
          <table id="example1" class="datalist table table-bordered table-striped">
            <thead>
              <tr>
                <th><input type="checkbox" id="check-all" class="flat"></th>
                <th style='width:20px'>No</th>
                <th class="img">Image</th>
                <th>Judul</th>
                <th>Link</th>
                <th>Tgl Posting</th>
                <th style='width:120px'>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($record->result_array() as $row) {
                $tgl_posting = tgl_indo($row['tgl_posting']);
                if ($row['gambar'] != '') {
                  $gambar = getnameimage($row['gambar'], '_200_400_thumb');
                }
                //echo $gambar."<br>";
                //$imglink = 'http://localhost/alphajayatehnik.co.id//../asset/admin/dist/img/users.gif';
                //echo '<img src="'.base_url().'../asset/foto_statis/'.$gambar.'">';
                echo "<tr><td><input type='checkbox' id='check-all' class='flat'></td><td>$no</td>
                                      <td class='img'>";
                if ($row['gambar'] != '') {
                  echo "<img class='imglist' src='" . home_url() . "asset/foto_statis/" . $gambar . "'>";
                }
                echo "</td>
                                      <td>$row[judul]</td>
                                      <td><a target='_BLANK' href='" . home_url() . "page/detail/" . $row['slug'] . "'>page/detail/" . $row['slug'] . "</a></td>
                                      <td>$tgl_posting</td>
                                      <td><center>
                                        <a class='btn btn-success btn-xs' title='Edit Data' href='" . base_url() . "pages/edit_pages/$row[id_pages]'><span class='glyphicon glyphicon-edit'></span></a>
                                        <a class='btn btn-danger btn-xs' title='Delete Data' href='" . base_url() . "pages/delete_pages/$row[id_pages]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                      </center></td>
                                  </tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>


        </form>
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
  });
</script>
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>