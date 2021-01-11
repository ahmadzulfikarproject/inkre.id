<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Identitas Website</h3>
        </div>
    </div>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/identitaswebsite',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value=''>
              <tr><th width='120px' scope='row'>Nama Website</th><td><input type='text' class='form-control' name='a' value='<?php echo $record['nama_website']; ?>'></td></tr>
              <tr><th scope='row'>Link Website</th><td><input type='url' class='form-control' name='c' value='<?php echo $record['alamat_website']; ?>'></td></tr>
              
              <tr><th scope='row'>Favicon</th>
                <td>
                  <input type='file' class='form-control hidden' name='gambarz'>
                  <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='i' value='<?php echo $record['favicon']; ?>' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" placeholder="Pilih favicon website" readonly>
                    </div>
                    <span class="help-block hidden">
                      Pilih salah satu file gambar
                    </span>
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo base_url()."asset/".$record['favicon']; ?>'>
                </td>
              </tr>
              <tr><th scope='row'>Icon</th>
                <td>
                  <input type='file' class='form-control hidden' name='gambarz'>
                  <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='icon' value='<?php echo $record['icon']; ?>' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" placeholder="Pilih icon website" readonly>
                    </div>
                    <span class="help-block hidden">
                      Pilih salah satu file gambar
                    </span>
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo base_url()."asset/".$record['icon']; ?>'>
                </td>
              </tr>
              <tr><th scope='row'>Logo</th>
                <td>
                  <input type='file' class='form-control hidden' name='gambarz'>
                  <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='logo' value='<?php echo $record['logo']; ?>' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" placeholder="Pilih logo website" readonly>
                    </div>
                    <span class="help-block hidden">
                      Pilih salah satu file gambar
                    </span>
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo base_url()."asset/".$record['logo']; ?>'>
                </td>
              </tr>
              <tr><th scope='row'>Header</th>
                <td>
                  <input type='file' class='form-control hidden' name='gambarz'>
                  <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='header' value='<?php echo $record['header']; ?>' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" placeholder="Pilih gambar header website" readonly>
                    </div>
                    <span class="help-block hidden">
                      Pilih salah satu file gambar
                    </span>
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo base_url()."asset/".$record['header']; ?>'>
                </td>
              </tr>
              <tr><th scope='row'>Header LOGO</th>
                <td>
                  <input type='file' class='form-control hidden' name='gambarz'>
                  <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='headerlogo' value='<?php echo $record['headerlogo']; ?>' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" placeholder="Pilih gambar header logo website" readonly>
                    </div>
                    <span class="help-block hidden">
                      Pilih salah satu file gambar
                    </span>
                    header logo Aktif Saat ini : <img class='thumbnail' src='<?php echo base_url()."asset/".$record['headerlogo']; ?>'>
                </td>
              </tr>
              <tr><th scope='row'>Gambar Profil</th>
                <td>
                  <input type='file' class='form-control hidden' name='gambarz'>
                  <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='img_profil' value='<?php echo $record['img_profil']; ?>' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" placeholder="Pilih gambar profil website" readonly>
                    </div>
                    <span class="help-block hidden">
                      Pilih salah satu file gambar
                    </span>
                    <?php if ($record['img_profil']): ?>
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo base_url()."asset/".$record['img_profil']; ?>'>
                    <?php endif ?>
                </td>
              </tr>
              
            </tbody>
          </table>
          <h3>Search Engine Optimization (SEO)</h3>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <tr><th width='120px' scope='row'>META Title</th><td><input type='text' class='form-control' name='meta_title' value="<?php echo $record['nama_website']; ?>"></td></tr>
              <tr><th scope='row'>META Description</th><td><input type='text' class='form-control' name='g' value='<?php echo $record['meta_deskripsi']; ?>'></td></tr>
              <tr><th width='120px' scope='row'>META Keywords</th><td><input type='text' class='form-control' name='h' value='<?php echo $record['meta_keyword']; ?>'></td></tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class='box-footer'>
      <button type='submit' name='submit' class='btn btn-info'>Update</button>
      <a href='<?php echo base_url('administrator/identitaswebsite'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
      
      
    </div>
</div>

<?php 
/*
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Identitas Website</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/identitaswebsite',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Website</th>   <td><input type='text' class='form-control' name='a' value='$record[nama_website]'></td></tr>
                     <tr><th scope='row'>Alamat Website</th>              <td><input type='url' class='form-control' name='c' value='$record[alamat_website]'></td></tr>
                    <tr><th scope='row'>Meta Deskripsi</th>               <td><input type='text' class='form-control' name='g' value='$record[meta_deskripsi]'></td></tr>
                    <tr><th scope='row'>Meta Keyword</th>                 <td><input type='text' class='form-control' name='h' value='$record[meta_keyword]'></td></tr>
                    <tr><th scope='row'>Favicon</th>                      <td><input type='file' class='form-control' name='i' value='$record[favicon]' style='display:inline-block; width:300px'> NB: nama file gambar favicon harus favicon.ico <hr style='margin:5px'>
                                                                              Favicon Aktif Saat ini : <img class='thumbnail' src='".base_url()."asset/$record[favicon]'></td></tr>
                    <tr><th scope='row'>Logo</th>                      <td><input type='file' class='form-control' name='logo' value='$record[favicon]' style='display:inline-block; width:300px'> NB: nama file gambar Logo harus .jpg <hr style='margin:5px'>
                                                                              Logo Aktif Saat ini : <img class='thumbnail' src='".base_url()."asset/$record[logo]'></td></tr>
                    <tr><th scope='row'>Header</th>                      <td><input type='file' class='form-control' name='header' value='$record[header]' style='display:inline-block; width:300px'> NB: nama file gambar header harus .jpg <hr style='margin:5px'>
                                                                              header Aktif Saat ini : <img class='thumbnail' src='".base_url()."asset/$record[header]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
*/