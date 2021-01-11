<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Tambah contact Baru</h3>
        </div>
    </div>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('contacts/tambah_contact',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value=''>
              <tr><th width='120px' scope='row'>Nama</th><td><input type='text' class='form-control' name='nama'></td></tr>
              <tr><th scope='row'>Alamat</th><td><textarea id='editor1' class='form-control' name='alamat' style='height:260px'></textarea></td></tr>
              <tr><th width='120px' scope='row'>Phone</th><td><input type='text' class='form-control' name='phone'></td></tr>
              <tr><th width='120px' scope='row'>Mobile</th><td><input type='text' class='form-control' name='mobile'></td></tr>
              <tr><th width='120px' scope='row'>Fax</th><td><input type='text' class='form-control' name='fax'></td></tr>
              <tr><th width='120px' scope='row'>email</th><td><input type='text' class='form-control' name='email'></td></tr>
              <tr><th width='120px' scope='row'>Whatsapp</th><td><input type='text' class='form-control' name='wa'></td></tr>
              <tr><th width='120px' scope='row'>Facebook Page</th><td><input type='text' class='form-control' name='fb'></td></tr>
              <tr><th width='120px' scope='row'>Instagram</th><td><input type='text' class='form-control' name='ig'></td></tr>
              <tr><th width='120px' scope='row'>Twitter</th><td><input type='text' class='form-control' name='twitter'></td></tr>
              <tr><th width='120px' scope='row'>link</th><td><input type='text' class='form-control' name='link'></td></tr>
              <tr><th width='120px' scope='row'>lokasi</th><td><input type='text' class='form-control' name='lokasi'></td></tr>
              <tr><th width='120px' scope='row'>info</th><td><textarea id='info' class='form-control' name='info' style='height:160px'></textarea></td></tr>
              <tr><th scope='row'>Gambar</th><td><input type='file' class='form-control' name='gambar'></td></tr>
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
      <a href='<?php echo base_url('contacts'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
      
    </div>
</div>