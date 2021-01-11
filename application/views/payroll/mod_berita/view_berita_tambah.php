<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Tambah Halaman Baru</h3>
        </div>
    </div>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_berita',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value=''>
              <tr><th width='120px' scope='row'>Judul</th><td><input type='text' class='form-control' name='judul'></td></tr>
              <tr><th scope='row'>Isi Halaman</th><td><textarea id='editor1' class='form-control' name='isi_berita' style='height:260px'></textarea></td></tr>
              <tr>
                <th scope='row'>Gambar</th>
                  <td>
                    <div id="file-upload">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">                                
                            <img data-src="holder.js/300x150" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-primary btn-file"><span class="fileinput-new"><span class='fa fa-upload'></span> Select image&hellip;</span><span class="fileinput-exists"><span class='fa fa-exchange'></span> Change</span><input type="file" name="gambar"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><span class='fa fa-exchange'></span> Remove</a>
                        </div>
                      </div>
                    </div>

                  </td>
              </tr>
              
              <tr><th scope='row'>Headline</th><td><input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak</td></tr>
              <tr class="hiddenz">
                <th scope='row'>Kategori</th>
                  <td>
                    <select id="id_kategori" class="selectpicker show-tick form-control" data-live-search="true">
                      <option value=''>- Pilih Kategori -</option>
                      <?php foreach ($record->result_array() as $row): ?>
                          <?php
                          if ($rows['id_kategori'] == $row['id_kategori']): ?>
                            <option value="<?php echo $row['id_kategori']; ?>" selected><?php echo $row['nama_kategori']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                          <?php endif; ?>
                          
                      <?php endforeach; ?>
                    </select>
                    <input type="text" name="id_kategorihasil" class="hidden">
                    <div id="results"></div>
                  </td>
              </tr>
              <tr>
                <th scope='row'>Tag</th>
                  <td>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                          <label>Enter tags</label>
                          <input type="text" name="tags" id="tags" class="form-control" />
                          <input type="text" name="tagshasil" id="tagshasil" class="form-control hidden"/>
                          
                      </div>
                    </div>
                    
                    <div class='checkbox-scroll hidden'>
                      <?php foreach ($tag->result_array() as $tag): ?>
                          <span style='display:block;'>
                            <input type=checkbox value="<?php echo $tag['tag_seo']; ?>" name="j[]"><?php echo $tag['nama_tag']; ?>
                          </span>
                      <?php endforeach; ?>
                    </div>
                  </td>
              </tr>
              <tr><th scope='row'>Users</th><td><select name='u' class='form-control' required>
                      <option value='' selected>- Pilih Users -</option>";
                      <?php foreach ($users->result_array() as $row): ?>
                          <option value="<?php echo $row['username'] ?>"><?php echo $row['nama_lengkap'] ?></option>
                      <?php endforeach; ?>
              </td></tr>
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
      <a href='<?php echo base_url('administrator/berita'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
      
    </div>
</div>
<?php 
/*
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Halaman Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_halamanbaru',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Judul</th>   <td><input type='text' class='form-control' name='a'></td></tr>
                    <tr><th scope='row'>Isi Halaman</th>                 <td><textarea id='editor1' class='form-control' name='b' style='height:260px'></textarea></td></tr>
                    <tr><th scope='row'>Gambar</th>                    <td><input type='file' class='form-control' name='c'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
*/