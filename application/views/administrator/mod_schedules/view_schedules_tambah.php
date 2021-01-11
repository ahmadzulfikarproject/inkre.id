<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Tambah schedules Baru</h3>
        </div>
    </div>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_schedules',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value=''>
              <tr><th width='120px' scope='row'>Judul</th><td><input type='text' class='form-control' name='judul'></td></tr>
              <tr><th scope='row'>Isi schedules</th><td><textarea id='editor1' class='form-control' name='isi_schedules' style='height:260px'></textarea></td></tr>
             <tr><th width='120px' scope='row'>Lokasi</th><td>
                
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                  <input type='text' placeholder="Lokasi kegiatan" class='form-control' name='lokasi' value="" required>
                </div>
              </td></tr>
              <tr><th width='120px' scope='row'>Hari</th><td><input type='text' class='form-control' name='hari' value="" required></td></tr>
              
              <tr><th width='120px' scope='row'>Tanggal Mulai</th>
                <td>
                
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="tanggal1" type='text' placeholder="Tanggal mulai" class='form-control' name='tgl_mulai' value="" required>
              </div>
              </td>
            </tr>
              <tr><th width='120px' scope='row'>Tanggal selesai</th><td>
                
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input id="tanggal2" type='text' placeholder="Tanggal selesai" class='form-control' name='tgl_selesai' value="" required>
              </div>
              </td></tr>
              <tr><th width='120px' scope='row'>jam_mulai</th>
                <td>
                 <div class="bootstrap-timepicker">
                      
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                        <input type='text' placeholder="waktu dimulai kegiatan" class='form-control timepicker' name='jam_mulai' value="" required>
                      </div>
                  </div>
                  
                </td>
              </tr>
              <tr><th scope='row'>Gambar</th>
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
                </td>
              </tr>
              <tr class="hidden">
                <th scope='row'>Kategori</th>
                  <td><select name='id_kategori' class='form-control'>
                      <option value='' selected>- Pilih Kategori -</option>
                      <?php foreach ($record->result_array() as $row): ?>
                          <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                      <?php endforeach; ?>
                  </td>
              </tr>
              <tr class="hidden">
                <th scope='row'>Tag</th>
                  <td>
                    <div class='checkbox-scroll'>
                      <?php foreach ($tag->result_array() as $tag): ?>
                          <span style='display:block;'>
                            <input type=checkbox value="<?php echo $tag['tag_seo']; ?>" name="j[]"><?php echo $tag['nama_tag']; ?>
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
              <tr><th width='120px' scope='row'>META Title</th><td><input type='text' class='form-control' name='meta_title'></td></tr>
              <tr><th scope='row'>META Keywords</th><td><input type='text' class='form-control' name='meta_keywords'></td></tr>
              <tr><th width='120px' scope='row'>META Description</th><td><input type='text' class='form-control' name='meta_description'></td></tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class='box-footer'>
      <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
      <button type='submit' name='savenew' class='btn btn-info'>save &amp; new</button>
      <a href='<?php echo base_url('administrator/schedules'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
      
    </div>
</div>
