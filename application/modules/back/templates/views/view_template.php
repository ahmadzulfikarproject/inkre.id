            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Template Website</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>templates/tambah_templates'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Template</th>
                        <th>Pembuat</th>
                        <th>Directory</th>
                        <th>Aktif</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row): ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row['judul'] ?></td>
                        <td><?php echo $row['pembuat'] ?></td>
                        <td><?php echo $row['folder'] ?></td>
                        <td><?php echo $row['aktif'] ?></td>
                        <td><center>
                              <a class='btn btn-success btn-xs' title='Edit Data' href='<?php base_url();?>templates/edit_templates/<?php echo $row['id_templates']  ?>'><span class='glyphicon glyphicon-edit'></span></a>
                              <a class='btn btn-danger btn-xs' title='Delete Data' href='<?php base_url();?>templates/delete_templates/<?php echo $row['id_templates']  ?>' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                            </center>
                        </td>
                      </tr>
                    <?php 
                      $no++;
                      endforeach;
                  ?>
                  </tbody>
                </table>
              </div>