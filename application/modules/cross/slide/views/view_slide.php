            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Images slide list</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>slide/tambah_slidebaru'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="datalist table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Image</th>
                        <th>Judul</th>
                        
                        <th>Tgl Posting</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tgl_posting = tgl_indo($row['tgl_posting']);
                    if ($row['gambar'] != ''){
                      $gambar = getnameimage($row['gambar'],'_200_400');
                    }
                    //echo $gambar."<br>";
                    //$imglink = 'http://localhost/alphajayatehnik.co.id//asset/admin/dist/img/users.gif';
                    //echo '<img src="'.base_url().'asset/foto_slide/'.$gambar.'">';
                    echo "<tr><td>$no</td>
                              <td>";
                              if ($row['gambar'] != ''){ echo "<img src='".base_url()."../asset/foto_slide/".$gambar."'>"; }
                              echo "</td>
                              <td>$row[judul]</td>
                              
                              <td>$tgl_posting</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."slide/edit_slidebaru/$row[id_slide]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."slide/delete_slidebaru/$row[id_slide]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>