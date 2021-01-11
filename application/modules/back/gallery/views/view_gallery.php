            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua gallery</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>gallery/update_semua_gallery'>update slug gallery</a>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>gallery/tambah_gallery'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped datalist">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th style='width:100px'>Image</th>
                        <th>Judul gallery</th>
                        <th>Kategori</th>
                        <th>view</th>
                        <th>Tgl Posting</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php $no = 1; foreach ($record->result_array() as $row):?>
                      <?php 
                        $created_time = tgl_indo($row['created_time']);
                        if ($row['id_categories']=='0'){
                          $kategori = '<i style="color:red">Pending</i>';
                        }else{
                          $kategori = $row['name'];
                        }
                        if ($row['gambar'] != ''){
                          $gambar = getnameimage($row['gambar'],'_200_400_thumb');
                        }

                                //print_r($row);
                      ?>
                          <tr>
                      <td><?= $no ?></td>
                      <td>
                        <?php if ($row['gambar'] != ''): ?>
                            <img src='<?= home_url('asset/foto_gallery/').$gambar;?>'>
                        <?php endif;?> 
                      </td>
                      <td><a title='Edit Data' href='<?= base_url('gallery/edit_gallery/'.$row['id_gallery']); ?>'><?=$row['judul'] ?></a></td>
                      <td><?= $kategori ?></td>
                      <td><?php if ($row['dibaca'] > 0){echo $row['dibaca'].' Kali';}?></td>
                      <td><?php echo tanggalindo($row['created_time'],"d-m-Y H:i:s");?></td>
                      <td><center>
                              <a class='btn btn-success btn-xs' title='Edit Data' href='<?php echo base_url('gallery/edit_gallery/').$row['id_gallery']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                              <a class='btn btn-danger btn-xs' title='Delete Data' href='<?php echo base_url('gallery/delete_gallery/').$row['id_gallery']; ?>' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                          </center>
                      </td>
                    </tr>
                  <?php $no++; endforeach; ?>
                       
                    

                    <?php /*
                    echo "<tr>
                              <td>$no</td>
                              <td>";
                              if ($row['gambar'] != ''){ echo "<img src='".home_url()."asset/foto_gallery/".$gambar."'>"; }
                              echo "</td>
                              <td><a title='Edit Data' href='".base_url()."gallery/edit_gallery/$row[id_gallery]'>".$row[judul]."</a></td>
                              <td>$kategori</td>
                              <td class='hidden'>$row[dibaca] Kali</td>
                              <td>$created_time</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."gallery/edit_gallery/$row[id_gallery]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."gallery/delete_gallery/$row[id_gallery]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                    */
                  ?>
                
                  </tbody>
                </table>
              </div>