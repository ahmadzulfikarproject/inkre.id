<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form validation <small>sub title</small></h2>
        <ul class="nav navbar-right panel_toolbox">
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
        echo form_open_multipart('contacts/edit_contact', $attributes); ?>
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
                  <input type='hidden' name='id' value='<?php echo $rows['id_contact']; ?>'>
                  <input type='text' class='form-control' name='nama' value='<?php echo $rows['nama'] ?>'>
                  <?php $this->template->title = 'Edit Halaman ' . $rows['nama']; ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Content</label>
                <div class="col-sm-10">
                  <textarea id='editor1' class='form-control' name='alamat' style='height:260px'><?php echo $rows['alamat'] ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='phone' value='<?php echo $rows['phone'] ?>'>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Mobile</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='mobile' value="<?php echo $rows['mobile']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">FAX</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='fax' value="<?php echo $rows['fax']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='email' value="<?php echo $rows['email']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Whatsapp</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='wa' value="<?php echo $rows['wa']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Facebook Page</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='fb' value="<?php echo $rows['fb']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='ig' value="<?php echo $rows['ig']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Twitter</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='twitter' value="<?php echo $rows['twitter']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gplus</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='gplus' value="<?php echo $rows['gplus']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Linkedin</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='lin' value="<?php echo $rows['lin']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Link</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='link' value="<?php echo $rows['link']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                  <input type='text' class='form-control' name='lokasi' value="<?php echo $rows['lokasi']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Info</label>
                <div class="col-sm-10">
                  <textarea id='info' class='form-control' name='info' style='height:260px'><?php echo $rows['info'] ?></textarea>
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
                    <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url() . '/' . webconfig('asset') . '/foto_contact/' . $rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                    <div class='row hidden'>
                      <div class='col-md-3'>
                        <img class='current-image' width='100%' src='<?php echo base_url() . "../asset/foto_contact/" . $rows['gambar'] ?>'>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div id="file-upload">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                        <?php if ($rows['gambar'] != '') : ?>
                          <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url() . '/' . webconfig('asset') . '/foto_contact/' . $rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                          <img class='current-imagez' width='100%' src='<?php echo base_url() . "../asset/foto_contact/" . $rows['gambar'] ?>'>
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
              <p>Pengatuan seo yang baik dapat membuat pencarian ke website ini menjadi lebih optimal</p>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Title</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type='text' class='form-control' name='meta_title' value='<?php echo $rows['meta_title'] ?>'>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Keywords</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type='text' class='form-control' name='meta_keywords' value='<?php echo $rows['meta_keywords'] ?>'>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Description</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type='text' class='form-control' name='meta_description' value='<?php echo $rows['meta_description'] ?>'>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type='submit' name='update' class='btn btn-success'>Update</button>
            <a class='btn btn-primary pull-right' href='<?php echo base_url('dashboard'); ?>'>Cancel</a>
          </div>
        </div>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>