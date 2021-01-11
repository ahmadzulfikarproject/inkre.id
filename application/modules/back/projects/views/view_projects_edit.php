<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form validation <small>sub title</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><?php echo anchor(home_url('projects/detail/' . $rows['slug']), 'View', array('class' => 'btn btn-success btn-sm', 'target' => '_blank', 'title' => $rows['judul'])); ?>
          </li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
        echo form_open_multipart('projects/edit_projects', $attributes); ?>
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="content-tab" role="tab" data-toggle="tab" aria-expanded="true">Content</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="seo-tab" data-toggle="tab" aria-expanded="false">SEO</a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="content-tab">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                  <input type='hidden' name='id' value='<?php echo $rows['id_projects'] ?>'>
                  <input type='text' class='form-control' name='a' value='<?php echo $rows['judul'] ?>'>
                  <?php $this->template->title = 'Edit Halaman ' . $rows['judul']; ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='lokasi' value='<?php echo $rows['lokasi'] ?>'>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Content</label>
                <div class="col-sm-10">
                  <textarea id='editor1' class='form-control' name='b' style='height:260px'><?php echo $rows['isi_projects'] ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
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
                  <?php if ($rows['gambar'] != '') : ?>
                    <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url() . '/' . webconfig('asset') . '/foto_schedules/' . $rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                    <div class='row hidden'>
                      <div class='col-md-3'>
                        <img class='current-image' width='100%' src='<?php echo base_url() . "../asset/foto_projects/" . $rows['gambar'] ?>'>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div id="file-upload">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                        <?php if ($rows['gambar'] != '') : ?>
                          <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url() . '/' . webconfig('asset') . '/foto_schedules/' . $rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                          <img class='current-imagez' width='100%' src='<?php echo base_url() . "../asset/foto_projects/" . $rows['gambar'] ?>'>
                        <?php else : ?>
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
                  <hr>

                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                  <?php echo $form_category; ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tag</label>
                <div class="col-sm-10">
                  <label>Enter tags</label>
                  <input type="text" name="tags" id="tags" class="form-control" value="<?php echo $tags; ?>" />
                  <input type="text" name="tagshasil" id="tagshasil" value="<?php echo $tags; ?>" class="form-control hidden" />

                  <!-- <input id="tags_1" type="text" class="tags form-control" value="social, adverts, sales" />
                  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div> -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Watermark</label>
                <div class="col-sm-10">

                  <div class="checkbox">
                    <label class="">
                      <input type="checkbox" name="watermark" class="js-switch" />
                    </label>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="seo-tab">
              <h3>Search Engine Optimization (SEO)</h3>
              <p>Pengatuan seo yang baik dapat membantu pencarian ke website ini menjadi lebih optimal</p>
              <div class="ln_solid"></div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Gooogle Search</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <div id="seopreview-google"></div>

                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Facebook</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <div id="seopreview-facebook"></div>

                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Meta Title</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input id="meta-title" type='text' class='form-control' name='meta_title' value='<?php echo $rows['meta_title'] ? $rows['meta_title'] : $rows['judul'] ?>' palceholder="Meta title">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Meta Url</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type="text" id="meta-url" class='form-control' palceholder="google link" value="<?php echo home_url('projects/detail/' . $rows['slug']) ?>" readonly />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Description</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <textarea id="meta-desc" type='text' class='form-control' name='meta_description'><?php echo $rows['meta_description'] ? $rows['meta_description'] : character_limiter(strip_tags($rows['isi_projects']), '222') ?></textarea>
                  <input type="text" id="meta-featured-image" class="hidden" value="<?php echo base_url() . "../asset/foto_projects/" . $rows['gambar'] ?>" readonly />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Keywords</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type='text' class='form-control' name='meta_keywords' value='<?php echo $rows['meta_keywords'] ?>'>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- <div class="ln_solid"></div> -->
        <div class="form-group">
          <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
            <?= $button ?>
            <!-- <button type='submit' name='submit' class='btn btn-success'>Update</button>
            <a class='btn btn-primary pull-right' href='<?php echo base_url('projects'); ?>'>Cancel</a> -->
          </div>
        </div>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<?php
ob_start();
?>
<!--tagmanager-->
<link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/bootstrap-select-1.12.4/css/bootstrap-select.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/jqueryui/jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/admin/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.css'); ?>">
<!--tagmanager-->
<script src="<?php echo base_url('asset/admin/plugins/bootstrap-tokenfield/bootstrap-tokenfield.js'); ?>"></script>
<script src="<?php echo base_url('asset/admin/plugins/bootstrap-select-1.12.4/js/bootstrap-select.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>asset/admin/plugins/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript">
  //jQuery.noConflict();
  //alert('zzzzzzzzz');
  $(document).ready(function() {
    $('#tags').tokenfield({
      autocomplete: {
        source: "<?php echo site_url('projects/get_autocomplete'); ?>",

        select: function(event, ui) {
          $('[name="tags"]').val(ui.item.label);
          //$('[name="description"]').val(ui.item.description); 
        }
      },
      showAutocompleteOnFocus: true,
      beautify: false
    });

    $('#tags').on('tokenfield:createdtoken tokenfield:initialize tokenfield:editedtoken tokenfield:removedtoken', function(e) {
      var dataList = $(".token").map(function() {
        return $(this).data("value");
      }).get();

      //console.log(dataList.join(","));
      var datatags = $('#tags').tokenfield('getTokensList', ', ');
      //$( "#results" ).text(datatags);
      $('#tagshasil').val(datatags);
      //$('#results').text($('#tags').val());
      //$( "#results" ).text( dataList.join(',') );
      //$('#tags').val(dataList.join(','))


    }).tokenfield();
    //fikar token exsisit

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
        title: $('#meta-title'),
        desc: $('#meta-desc'),
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