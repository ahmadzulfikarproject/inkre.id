<div class="col-md-12">
  <div class="box box-info">
    <div class='box-header with-border'>
      <h3 class='box-title'>Tambah gallery Baru</h3>
    </div>
  </div>
  <div class="box-body">
    <?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
    echo form_open_multipart('gallery/tambah_gallery', $attributes); ?>
    <div class='col-md-12'>
      <table class='table table-condensed table-bordered'>
        <tbody>
          <input type='hidden' name='id' value=''>
          <tr>
            <th width='120px' scope='row'>Judul</th>
            <td><input type='text' class='form-control' name='judul'></td>
          </tr>
          <tr>
            <th scope='row'>Isi gallery</th>
            <td><textarea id='editor1' class='form-control' name='isi_gallery' style='height:260px'></textarea></td>
          </tr>
          <tr>
            <th width='120px' scope='row'>Harga</th>
            <td>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input id='price' type='text' placeholder="harga produk" class='form-control' name='price' value="">
              </div>
            </td>
          </tr>
          <tr>
            <th width='120px' scope='row'>Video</th>
            <td>
              <textarea id='video' class='form-control' name='video' style='height:100px'> </textarea>
            </td>
          </tr>
          <tr>
            <th scope='row'>Gambar</th>
            <td>
              <input type='file' class='form-control hidden' name='gambarz'>
              <div class="input-group hidden">
                <label class="input-group-btn">
                  <span class="btn btn-primary">
                    <span class='fa fa-upload'></span> Browse&hellip; <input type="file" name='gambarx' style="display: none;" multiple>
                  </span>
                </label>
                <input type="text" class="form-control" readonly>
              </div>
              <span class="help-block hidden">
                Pilih salah satu file gambar
              </span>
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
          <tr>
            <th>Gallery Foto</th>
            <td>
              <section class="demo hidden">
                <h2>Demo</h2>
                <input id="file_input" type="file" name="dFiles[]" multiple>
                <input id="deleteimages" type="text" class="form-control" value="">

              </section>

              <div class="containerz">
                <div class="input-group">
                  <label class="input-group-btn">
                    <a class="btn btn-primary" href="javascript:void(0)" onclick="$('#pro-image').click()"><span class='fa fa-upload'></span> Upload Image</a>
                    <input type="file" id="pro-image" name="pro-image[]" class="form-control hidden" multiple>
                  </label>

                  <input type="text" class="form-control" readonly>
                </div>

                <!--<div class="input-group">
                        <label class="input-group-btn">
                          <a class="btn btn-primary" href="javascript:void(0)" onclick="$('#pro-image').click()">
                            <span class='fa fa-upload'></span> Browse&hellip; <input type="file" id="pro-image" name="pro-image[]" class="form-control hidden" multiple>
                          </a>
                        </label>
                        <input type="text" class="form-control" readonly>
                      </div>-->

                <div id="hasil-image"></div>

                <div class="preview-images-zone">
                  <!-- display uploaded images -->

                  <?php if (!empty($files)) {
                    $i = 1;
                    foreach ($files as $file) {
                      $thumb = getnameimage($file['file_name'], '_200_400');

                  ?>
                      <div class="preview-image preview-show-<?php echo $i; ?>">
                        <div class="image-cancel" data-no="<?php echo $i; ?>">x</div>
                        <div class="image-zone">
                          <img id="pro-img-<?php echo $i; ?>" src="<?php echo base_url('../asset/foto_gallery/gallery/' . $thumb); ?>">
                        </div>
                        <p>Uploaded On <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                      </div>

                    <?php $i++;
                    }
                  } else { ?>
                    <p>Image(s) not found.....</p>
                  <?php } ?>

                </div>
              </div>

            </td>
          </tr>
          <tr class="hiddenz">
            <th scope='row'>Kategori</th>
            <td>
              <select id="id_kategori" class="selectpicker show-tick form-control" data-live-search="true">
                <option value=''>- Pilih Kategori -</option>
                <?php foreach ($record->result_array() as $row) : ?>

                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>


                <?php endforeach; ?>
              </select>
              <input type="text" name="id_kategorihasil" class="hidden">
              <div id="results"></div>
            </td>
          </tr>
          <tr class="hiddenz">
            <th scope='row'>Tag</th>
            <td>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Enter tags</label>
                  <input type="text" name="tags" id="tags" class="form-control" value="<?php //echo $rows['id_tag']; 
                                                                                        ?>" />
                  <input type="text" name="tagshasil" id="tagshasil" value="<?php //echo $rows['id_tag']; 
                                                                            ?>" class="form-control hidden" />

                </div>
              </div>
              <div class='checkbox-scroll hidden'>
                <?php foreach ($tag->result_array() as $tag) : ?>
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
          <tr>
            <th width='120px' scope='row'>META Title</th>
            <td><input type='text' class='form-control' name='meta_title'></td>
          </tr>
          <tr>
            <th scope='row'>META Keywords</th>
            <td><input type='text' class='form-control' name='meta_keywords'></td>
          </tr>
          <tr>
            <th width='120px' scope='row'>META Description</th>
            <td><input type='text' class='form-control' name='meta_description'></td>
          </tr>

        </tbody>
      </table>
      <hr>
      <div class="input-group">
        <label>
          <input type="checkbox" name="watermark" class="minimal">
          Watermark Images
        </label>
      </div>
      <hr>
    </div>
  </div>
</div>
<div class='box-footer'>
  <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
  <button type='submit' name='savenew' class='btn btn-info'>save &amp; new</button>
  <a href='<?php echo base_url('gallery'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>

</div>
</div>

<script type="text/javascript">
  //jQuery.noConflict();
  //alert('zzzzzzzzz');
  $(document).ready(function() {
    $('#tags').tokenfield({
      autocomplete: {
        source: "<?php echo site_url('gallery/get_autocomplete'); ?>",

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