<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit user</h3>
        </div>
    </div>
    <?php //echo $rows['judul'];?>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_manajemenuser',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value="<?php echo $rows['username'];?>">

              <tr><th width='120px' scope='row'>Username</th><td><input type='text' class='form-control' name='a' value="<?php echo $rows['username'];?>" required readonly='on'></td></tr>
              <tr><th width='120px' scope='row'>password</th><td><input type='password' class='form-control' name='b' value="<?php //echo $rows['b'];?>"></td></tr>
              <tr><th width='120px' scope='row'>nama_lengkap</th><td><input type='text' class='form-control' name='c' value="<?php echo $rows['nama_lengkap'];?>" required></td></tr>
              <tr><th width='120px' scope='row'>email</th><td><input type='email' class='form-control' name='d' value="<?php echo $rows['email'];?>" required></td></tr>
              <tr><th width='120px' scope='row'>Telpon</th><td><input type='number' class='form-control' name='e' value="<?php echo $rows['no_telp'];?>" required></td></tr>
              
              <?php if ($this->session->level == 'admin'):?>
              <tr><th width='120px' scope='row'>Level</th><td><input type='text' class='form-control' name='l' value="<?php echo $rows['level'];?>"></td></tr>
              <?php endif; ?>
              
              <tr>
                <th scope='row'>Gambar</th>
                  <td>
                    

                    <div id="file-upload">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          
                          <?php if ($rows['usergambar'] != ''): ?>
                            
                            <img class='current-imagez' width='100%' src='<?php echo base_url('../asset/').$rows['usergambar']?>'>
                          <?php else: ?>
                            <img data-src="holder.js/300x150" alt="...">
                          <?php endif; ?>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-primary btn-file"><span class="fileinput-new"><span class='fa fa-upload'></span> Select image&hellip;</span><span class="fileinput-exists"><span class='fa fa-exchange'></span> Change</span><input type="file" name="usergambar"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><span class='fa fa-exchange'></span> Remove</a>
                        </div>
                      </div>
                    </div>

                  </td>
              </tr>
              
              <tr class="">
                <th scope='row'>Blokir</th>
                  <td>
                    <select id="h" class="form-control">
                      <option value=''>- Blokir -</option>
                      <?php //foreach ($record->result_array() as $row): ?>
                          <?php
                          if ($rows['blokir']=='Y'): ?>
                            <option value="<?php echo $row['blokir']; ?>" selected>Ya</option>
                            <option value="N">Tidak</option>

                          <?php else: ?>
                            <option value="Y">Ya</option>
                            <option value="N" selected>Tidak</option>
                          <?php endif; ?>
                          
                      <?php //endforeach; ?>
                    </select>
                    
                    
                  </td>
              </tr>
              
            </tbody>
          </table>
          
        </div>
      </div>
    </div>
    <div class='box-footer'>
      <button type='submit' name='submit' class='btn btn-info'>Update</button>
      
      <a href='<?php echo base_url('administrator/manajemenuser'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
       <button class="hidden" onclick="goBack()">Go Back</button>

        <script>
        function goBack() {
            window.history.back();
        }
        </script> 
    </div>
</div>
<?php 
/*
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data User</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_manajemenuser',$attributes); 
          echo "<div class='col-md-12'>
                  <div class='alert alert-warning'><b>Username</b> tidak bisa diubah, dan Apabila password tidak diubah, dikosongkan saja...</div>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[username]'>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='a' value='$rows[username]' readonly='on'></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>             <td><input type='text' class='form-control' name='c' value='$rows[nama_lengkap]'></td></tr>
                    <tr><th scope='row'>Email</th>                    <td><input type='email' class='form-control' name='d' value='$rows[email]'></td></tr>
                    <tr><th scope='row'>No Telp</th>                  <td><input type='number' class='form-control' name='e' value='$rows[no_telp]'></td></tr>";
                     if ($this->session->level == 'admin'){
                        echo "<tr><th scope='row'>Level</th><td><input type='text' class='form-control' name='l' value='$rows[level]'></td></tr>";
                      }
                  echo "
                    <tr><th scope='row'>Blokir</th>                   <td>"; if ($rows['blokir']=='Y'){ echo "<input type='radio' name='h' value='Y' checked> Ya &nbsp; <input type='radio' name='h' value='N'> Tidak"; }else{ echo "<input type='radio' name='h' value='Y'> Ya &nbsp; <input type='radio' name='h' value='N' checked> Tidak"; } echo "</td></tr>
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