            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">users</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>users/tambah_users'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="datalist table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Image</th>
                        <th>nama_lengkap</th>
                        <th>Link</th>
                        <th>Tgl Posting</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    //$tgl_posting = tgl_indo($row['tgl_posting']);
                    if ($row['usergambar'] != ''){
                      $usergambar = getnameimage($row['usergambar'],'_200_400_thumb');
                    }
                    //echo $usergambar."<br>";
                    //$imglink = 'http://localhost/alphajayatehnik.co.id//../asset/admin/dist/img/users.gif';
                    //echo '<img src="'.base_url().'../asset/foto_statis/'.$usergambar.'">';
                    echo "<tr><td>$no</td>
                              <td>";
                              if ($row['usergambar'] != ''){ echo "<img src='".home_url()."asset/foto_statis/".$usergambar."'>"; }
                              echo "</td>
                              <td>$row[nama_lengkap]</td>
                              <td><a target='_BLANK' href='".home_url()."page/detail/".$row['username']."'>page/detail/".$row['username']."</a></td>
                              <td></td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."users/edit_users/$row[username]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."users/delete_users/$row[username]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>