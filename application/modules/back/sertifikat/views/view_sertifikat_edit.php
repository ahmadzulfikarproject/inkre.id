<div class="col-md-12">
    <div class="box box-info">
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit sertifikat</h3>
        </div>
    </div>
    <?php //echo $rows['judul'];?>
    <div class="box-body">
      <?php   $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('sertifikat/edit_sertifikat',$attributes); ?>
      <div class='col-md-12'>
          <table class='table table-condensed table-bordered'>
            <tbody>
              <input type='hidden' name='id' value="<?php echo $rows['id_sertifikat'];?>">
              <tr><th width='120px' scope='row'>Judul sertifikat</th><td><input type='text' class='form-control' name='judul' value="<?php echo $rows['judul'];?>" required></td></tr>
              <tr>
                <th scope='row'>Isi Halaman </th>
                  <td>
                    <textarea id='editor1' class='form-control' name='isi_sertifikat' style='height:320px' required> <?php echo $rows['isi_sertifikat'] ?></textarea>
                  </td>
              </tr>
              <tr><th width='120px' scope='row'>Harga</th><td>
                
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input id='price' type='text' placeholder="harga produk" class='form-control' name='price' value="<?php echo $rows['price'];?>">
                </div>
                
              </td></tr>
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
                          <img class='current-image' width='100%' src='<?php echo home_url()."asset/foto_sertifikat/".$rows['gambar']?>'>
                        </div>
                      </div>
                    <?php endif; ?>

                    <div id="file-upload">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          
                          <?php if ($rows['gambar'] != ''): ?>
                            <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url().'/'.webconfig('asset').'/foto_schedules/'.$rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                            <img class='current-imagez' width='100%' src='<?php echo home_url()."asset/foto_sertifikat/".$rows['gambar']?>'>
                          <?php else: ?>
                            <img data-src="holder.js/300x150" alt="...">
                          <?php endif; ?>
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
              
              <tr class="">
                <th scope='row'>Kategori</th>
                  <td>
                    <select id="id_kategori" class="selectpicker show-tick form-control" data-live-search="true">
                      <option value=''>- Pilih Kategori -</option>
                      <?php foreach ($record->result_array() as $row): ?>
                          <?php
                          if ($rows['id_categories'] == $row['id']): ?>
                            <option value="<?php echo $row['id']; ?>" selected><?php echo $row['name']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                          <?php endif; ?>
                          
                      <?php endforeach; ?>
                    </select>
                    <input type="text" name="id_kategorihasil" class="hidden">
                    <div id="results"></div>
                    
                  </td>
              </tr>
              <tr class="">
                <th scope='row'>Tag</th>
                  <td>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                          <label>Enter tags</label>
                          <?php //print_r($tags->result_array()) ;
                            //echo $tags;
                          $tags_data = array();
                          foreach ($tags->result_array() as $key => $value) {
                            $tags_data[] = $value['slug'];
                            # code...
                          }
                          
                          //print_r($tags_data);
                          $tags_value = implode(',',$tags_data);
                          //echo $tags_value;
                          ?>
                          <input type="text" name="tags" id="tags" class="form-control" value="<?php echo $tags_value; ?>" />
                          <input type="text" name="tagshasil" id="tagshasil" value="<?php echo $tags_value; ?>" class="form-control hidden"/>
                         
                      </div>
                    </div>
                    <div class='checkbox-scroll hidden'>
                      <?php 
                            $_arrNilai = explode(',', $rows['id_tag']);
                            foreach ($tag->result_array() as $tag): ?>
                              <?php $_ck = (array_search($tag['tag_seo'], $_arrNilai) === false)? '' : 'checked'; ?>
                              <span style='display:block;'>
                                <input type=checkbox value="<?php echo $tag['tag_seo']; ?>" name="j[]" <?php echo $_ck ?>><?php echo $tag['nama_tag']; ?>
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
      <a href='<?php echo base_url('sertifikat'); ?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
       <button class="hidden" onclick="goBack()">Go Back</button>

        <script>
        function goBack() {
            window.history.back();
        }
        </script> 
    </div>
</div>

<script type="text/javascript">
        //jQuery.noConflict();
    //alert('zzzzzzzzz');
    $(document).ready(function(){
        $('#tags').tokenfield({
            autocomplete: {
                source: "<?php echo site_url('sertifikat/get_autocomplete');?>",
 
                select: function (event, ui) {
                    $('[name="tags"]').val(ui.item.label); 
                    //$('[name="description"]').val(ui.item.description); 
                }
            },
            showAutocompleteOnFocus: true,
            beautify: false
        });

        $('#tags').on('tokenfield:createdtoken tokenfield:initialize tokenfield:editedtoken tokenfield:removedtoken', function (e) {
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