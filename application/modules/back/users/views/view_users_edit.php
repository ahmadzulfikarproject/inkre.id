<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit users Statis</h3>
        </div>
    </div>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('users/edit_users',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value='<?php echo $rows['username']?>'>
              <tr><th width='120px' scope='row'>nama_lengkap</th><td><input type='text' class='form-control' name='a' value='<?php echo $rows['nama_lengkap']?>'></td></tr>
              <tr><th width='120px' scope='row'>password</th><td><input type='text' class='form-control' name='x' value=''></td></tr>
              <tr><th scope='row'>Isi users</th><td><textarea id='editor1' class='form-control' name='b' style='height:260px'><?php //echo $rows['isi_users']?></textarea></td></tr>
              <tr>
                <th scope='row'>usergambar</th>
                  <td>
                    <input type='file' class='form-control hidden' name='usergambarz'>
                    <div class="input-group hidden">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='usergambarxxx' style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" readonly>
                    </div>
                    <span class="help-block">
                      Pilih salah satu file usergambar
                    </span>
                    <?php if ($rows['usergambar'] != ''): ?>
                      <!--<i style='color:red'>Lihat usergambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url().'/'.webconfig('asset').'/foto_schedules/'.$rows['usergambar'] ?>"><?php echo $rows['usergambar'] ?></a>-->
                      <div class='row hidden'>
                        <div class='col-md-3'>
                          <img class='current-image' width='100%' src='<?php echo base_url()."../asset/foto_statis/".$rows['usergambar']?>'>
                        </div>
                      </div>
                    <?php endif; ?>

                    <div id="file-upload">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          
                          <?php if ($rows['usergambar'] != ''): ?>
                            <!--<i style='color:red'>Lihat usergambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url().'/'.webconfig('asset').'/foto_schedules/'.$rows['usergambar'] ?>"><?php echo $rows['usergambar'] ?></a>-->
                            <img class='current-imagez' width='100%' src='<?php echo base_url()."../asset/foto_statis/".$rows['usergambar']?>'>
                          <?php else: ?>
                            <img data-src="holder.js/300x150" alt="...">
                          <?php endif; ?>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-primary btn-file"><span class="fileinput-new"><span class='fa fa-upload'></span> Select image&hellip;</span><span class="fileinput-exists"><span class='fa fa-exchange'></span> Change</span><input type="file" name="c"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><span class='fa fa-exchange'></span> Remove</a>
                        </div>
                      </div>
                    </div>

                  </td>
              </tr>
            </tbody>
          </table>
         
          
        </div>
      </div>
    </div>
    <div class='box-footer'>
      <button type='submit' name='submit' class='btn btn-info'>Update</button>
      <a href='<?php echo base_url('users'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
      
    </div>
</div>
