<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
        <div class='box-header with-border'>
          <h3 class='box-title'>Identitas Website MODULE</h3>
        </div>
    </div>
    <div class="panel-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('settings',$attributes); ?>
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
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo home_url()."asset/".$record['favicon']; ?>'>
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
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo home_url()."asset/".$record['icon']; ?>'>
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
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo home_url()."asset/".$record['logo']; ?>'>
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
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo home_url()."asset/".$record['header']; ?>'>
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
                    header logo Aktif Saat ini : <img class='thumbnail' src='<?php echo home_url()."asset/".$record['headerlogo']; ?>'>
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
                    header Aktif Saat ini : <img class='thumbnail' src='<?php echo home_url()."asset/".$record['img_profil']; ?>'>
                    <?php endif ?>
                </td>
              </tr>
              
            </tbody>
          </table>
          <h3>Search Engine Optimization (SEO)</h3>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <tr><th width='120px' scope='row'>META Title</th><td><input type='text' class='form-control' name='meta_title' value="<?php echo $record['meta_title']; ?>"></td></tr>
              <tr><th scope='row'>META Description</th><td><input type='text' class='form-control' name='g' value='<?php echo $record['meta_deskripsi']; ?>'></td></tr>
              <tr><th width='120px' scope='row'>META Keywords</th><td><input type='text' class='form-control' name='h' value='<?php echo $record['meta_keyword']; ?>'></td></tr>

            </tbody>
          </table>
      </div>
    </div>
    <div class='panel-footer'>
      <button type='submit' name='submit' class='btn btn-info'>Update</button>
      <a href='<?php echo base_url('settings'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
    </div>
  </div>
</div>
<?php
ob_start();
?>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#site_logo").change(function() {
            readURL(this);
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/js-seopreview/js/jquery-seopreview.js"></script>
<link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/js-seopreview/css/jquery-seopreview.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    $(document).ready(function() {
        $.seoPreview({
            google_div: "#seopreview-google",
            facebook_div: "#seopreview-facebook",
            metadata: {
                title: $('#meta_title'),
                desc: $('#meta_description'),
                url: {
                    full_url: $('#meta-url')
                }
            },
            google: {
                show: true,
                date: false
            },
            facebook: {
                show: true,
                featured_image: $('#meta-featured-image')
            }
        });
    });
</script>
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>