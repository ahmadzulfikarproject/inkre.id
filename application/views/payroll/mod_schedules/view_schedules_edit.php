<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit schedules</h3>
        </div>
    </div>
    <?php //echo $rows['judul'];?>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_schedules',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value="<?php echo $rows['id_schedules'];?>">
              <tr><th width='120px' scope='row'>Judul schedules</th><td><input type='text' class='form-control' name='judul' value="<?php echo $rows['judul'];?>" required></td></tr>
              <tr>
                <th scope='row'>Isi Halaman </th>
                  <td>
                    <textarea id='editor1' class='form-control' name='isi_schedules' style='height:320px' required> <?php echo $rows['isi_schedules'] ?></textarea>
                  </td>
              </tr>
              <tr><th width='120px' scope='row'>Lokasi</th><td>
                
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                  <input type='text' placeholder="Lokasi kegiatan" class='form-control' name='lokasi' value="<?php echo $rows['lokasi'];?>" required>
                </div>
              </td></tr>
              <tr><th width='120px' scope='row'>Hari</th><td><input type='text' class='form-control' name='hari' value="<?php echo $rows['hari'];?>" required></td></tr>
              
              <tr><th width='120px' scope='row'>Tanggal Mulai</th>
                <td>
                
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="tanggal1" type='text' placeholder="Tanggal mulai" class='form-control' name='tgl_mulai' value="<?php echo tanggalindo($rows['tgl_mulai'],"d-m-Y")?>" required>
              </div>
              </td>
            </tr>
              <tr><th width='120px' scope='row'>Tanggal selesai</th><td>
                
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="tanggal2" type='text' placeholder="Tanggal selesai" class='form-control' name='tgl_selesai' value="<?php echo tanggalindo($rows['tgl_selesai'],"d-m-Y");?>" required>
              </div>
              </td></tr>
              <tr><th width='120px' scope='row'>jam_mulai</th><td>
                 <div class="bootstrap-timepicker">
                      
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input type='text' placeholder="waktu dimulai kegiatan" class='form-control timepicker' name='jam_mulai' value="<?php echo $rows['jam_mulai'];?>" required>
                      </div>
                </div>
                  
                  </td></tr>
              <tr>
                <th scope='row'>Gambar</th>
                  <td>
                    <input type='file' class='form-control hidden' name='gambarz'>
                    <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='gambar' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" readonly>
                    </div>
                    <span class="help-block">
                      Pilih salah satu file gambar
                    </span>
                    <?php if ($rows['gambar'] != ''): ?>
                      <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url().'/'.webconfig('asset').'/foto_schedules/'.$rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                      <div class='row'>
                        <div class='col-md-3'>
                          <img width='100%' src='<?php echo base_url().'/'.webconfig('asset')."/foto_schedules/".$rows['gambar']?>'>
                        </div>
                      </div>
                    <?php endif; ?>
                  </td>
              </tr>
              
              <tr class="hidden">
                <th scope='row'>Kategori</th>
                  <td><select name='id_kategori' class='form-control'>
                      <option value='' selected>- Pilih Kategori -</option>
                      <?php foreach ($record->result_array() as $row): ?>
                          <?php
                          if ($rows['id_kategori'] == $row['id_kategori']): ?>
                            <option value="<?php echo $row['id_kategori']; ?>" selected><?php echo $row['nama_kategori']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                          <?php endif; ?>
                          
                      <?php endforeach; ?>
                  </td>
              </tr>
              <tr class="hidden">
                <th scope='row'>Tag</th>
                  <td>
                    <div class='checkbox-scroll'>
                      <?php 
                            $_arrNilai = explode(',', $rows['tag']);
                            foreach ($tag->result_array() as $tag): ?>
                              <?php $_ck = (array_search($tag['tag_seo'], $_arrNilai) === false)? '' : 'checked'; ?>
                              <span style='display:block;'>
                                <input type=checkbox value="<?php echo $tag['tag_seo']; ?>" name="j[]" <?php echo $_ck ?>><?php echo $tag['nama_tag']; ?>
                              </span>
                      <?php endforeach; ?>
                    </div>
                  </td>
              </tr>
            </tbody>
          </table>
          <h3>Search Engine Optimization (SEO)</h3>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <tr><th width='120px' scope='row'>META Title</th><td><input type='text' class='form-control' name='meta_title' value="<?php echo $rows['meta_title'];?>"></td></tr>
              <tr><th scope='row'>META Keywords</th><td><input type='text' class='form-control' name='meta_keywords' value="<?php echo $rows['meta_keywords'];?>"></td></tr>
              <tr><th width='120px' scope='row'>META Description</th><td><input type='text' class='form-control' name='meta_description' value="<?php echo $rows['meta_description'];?>"></td></tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class='box-footer'>
      <button type='submit' name='update' class='btn btn-info'>Update</button>
      <button type='submit' name='submit' class='btn btn-info'>save &amp; close</button>
      <a href='<?php echo base_url('administrator/schedules'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
       <button class="hidden" onclick="goBack()">Go Back</button>

        <script>
        function goBack() {
            window.history.back();
        }
        </script> 
    </div>
</div>