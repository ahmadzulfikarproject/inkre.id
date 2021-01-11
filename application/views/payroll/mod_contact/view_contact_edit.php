<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit contact</h3>
        </div>
    </div>
    <?php //echo $rows['nama'];?>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_contact',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value="<?php echo $rows['id_contact'];?>">
              <tr><th width='120px' scope='row'>nama contact</th><td><input type='text' class='form-control' name='nama' value="<?php echo $rows['nama'];?>" required></td></tr>
              <tr>
                <th scope='row'>Alamat </th>
                  <td>
                    <textarea id='editor1' class='form-control' name='alamat' style='height:320px' required> <?php echo $rows['alamat'] ?></textarea>
                  </td>
              </tr>
              <tr><th width='120px' scope='row'>Phone</th><td><input type='text' class='form-control' name='phone' value="<?php echo $rows['phone'];?>"></td></tr>
              <tr><th width='120px' scope='row'>Mobile</th><td><input type='text' class='form-control' name='mobile' value="<?php echo $rows['mobile'];?>" ></td></tr>
              <tr><th width='120px' scope='row'>Fax</th><td><input type='text' class='form-control' name='fax' value="<?php echo $rows['fax'];?>" ></td></tr>
              <tr><th width='120px' scope='row'>email</th><td><input type='text' class='form-control' name='email' value="<?php echo $rows['email'];?>" ></td></tr>
              <tr><th width='120px' scope='row'>Whatsapp</th><td><input type='text' class='form-control' name='wa' value="<?php echo $rows['wa'];?>"></td></tr>
              <tr><th width='120px' scope='row'>Facebook Page</th><td><input type='text' class='form-control' name='fb' value="<?php echo $rows['fb'];?>"></td></tr>
              <tr><th width='120px' scope='row'>Instagram</th><td><input type='text' class='form-control' name='ig' value="<?php echo $rows['ig'];?>"></td></tr>
              <tr><th width='120px' scope='row'>Twitter</th><td><input type='text' class='form-control' name='twitter' value="<?php echo $rows['twitter'];?>"></td></tr>
              <tr><th width='120px' scope='row'>link</th><td><input type='text' class='form-control' name='link' value="<?php echo $rows['link'];?>" ></td></tr>
              <tr><th width='120px' scope='row'>lokasi</th><td><input type='text' class='form-control' name='lokasi' value="<?php echo $rows['lokasi'];?>" ></td></tr>
              <tr><th width='120px' scope='row'>info</th><td><textarea id='info' class='form-control' name='info' style='height:160px'><?php echo $rows['info'] ?></textarea></td></tr>
              
              <tr>
                <th scope='row'>Gambar</th>
                  <td>
                    <input type='file' class='form-control hidden' name='gambarz'>
                    <div class="input-group hidden">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='gambarxxx' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" readonly>
                    </div>
                    <span class="help-block">
                      Pilih salah satu file gambar
                    </span>
                    <?php if ($rows['gambar'] != ''): ?>
                      <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url().'/'.webconfig('asset').'/foto_schedules/'.$rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                      <div class='row hidden'>
                        <div class='col-md-3'>
                          <img class='current-image' width='100%' src='<?php echo base_url()."../asset/foto_contact/".$rows['gambar']?>'>
                        </div>
                      </div>
                    <?php endif; ?>

                    <div id="file-upload">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          
                          <?php if ($rows['gambar'] != ''): ?>
                            <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url().'/'.webconfig('asset').'/foto_schedules/'.$rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                            <img class='current-imagez' width='100%' src='<?php echo base_url()."../asset/foto_contact/".$rows['gambar']?>'>
                          <?php else: ?>
                            <img data-src="holder.js/300x150" alt="...">
                          <?php endif; ?>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="gambar"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
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
      <a href='<?php echo base_url('administrator/home'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
       <button class="hidden" onclick="goBack()">Go Back</button>

        <script>
        function goBack() {
            window.history.back();
        }
        </script> 
    </div>
</div>