<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Setting <small>Website</small></h2>
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
                <p><?php echo lang('settings_help_txt'); ?></p>
                <!-- Nav tabs -->

                <div>
                    <?= validation_errors() ?>
                </div>
                <?php if (isset($message)) : ?>
                    <div>
                        <?= $message ?>
                    </div>
                <?php endif ?>
                <?php //$attributes = array('class' => 'form-horizontal', 'role' => 'form');

                ?>
                <?
                ?>
                <?php echo form_open_multipart(); ?>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php $count = 0 ?>
                        <?php foreach ($settings as $tab) : ?>
                            <li role="presentation" <?php if ($count == 0) echo ' class="active"' ?>><a href="#<?= $tab->tab ?>" aria-controls="<?= $tab->tab ?>" role="tab" data-toggle="tab"><?= ucfirst($tab->tab) ?></a></li>
                            <?php $count++ ?>
                        <?php endforeach ?>
                        <!-- <li role="presentation" class=""><a href="#tab_content1" id="content-tab" role="tab" data-toggle="tab" aria-expanded="true">Content</a>
                        </li> -->
                        <!-- <li role="presentation" class=""><a href="#tab_content2" role="tab" id="seo-tab" data-toggle="tab" aria-expanded="false">SEO</a>
                        </li> -->
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <?php $count = 0 ?>
                        <?php foreach ($settings as $tab) : ?>
                            <div role="tabpanel" class="tab-pane fade<?php echo ($count == 0) ? ' in active' : ''; ?>" id="<?= $tab->tab ?>">
                                <?php if ($tab->tab == 'seo') : ?>
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
                                <?php endif; ?>
                                <?php foreach ($tab->list as $item) : ?>
                                    <?php if ($item->field_type == 'image') : ?>
                                        <div class="form-group row">
                                            <label for="<?= $item->name ?>" class="control-label col-sm-2 col-form-label"><?= lang($item->name . '_label') ?></label>
                                            <div class="col-sm-10 img-group">
                                                <span id="helpBlock" class="help-block"><?= lang($item->name . '_desc') ?></span>

                                                <label>Upload Image</label>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-default btn-file">
                                                            Browse… <?= $item->input; ?>
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" value="<?= $item->value; ?>" readonly>
                                                </div>
                                                <img class="img-upload thumbnail img-preview" src='<?php echo $item->value ? home_url() . "asset/settings/" . $item->value : "holder.js/200x150" ?>' />

                                                <hr>
                                            </div>
                                        </div>

                                    <?php else : ?>
                                        <div class="form-group row">
                                            <label for="<?= $item->name ?>" class="control-label col-sm-2 col-form-label"><?= lang($item->name . '_label') ?></label>
                                            <div class="col-sm-10">
                                                <span id="helpBlock" class="help-block"><?= lang($item->name . '_desc') ?></span>
                                                <?= $item->input ?>
                                                <hr>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </div>
                            <?php $count++ ?>
                        <?php endforeach ?>
                        <div role="tabpanel" class="tab-pane hidden" id="tab_content1" aria-labelledby="content-tab">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type='hidden' name='id' value='<?php echo $rows['id_berita'] ?>'>
                                    <input type='text' class='form-control' name='a' value='<?php echo $rows['judul'] ?>'>
                                    <?php $this->template->title = 'Edit Halaman ' . $rows['judul']; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea id='editor1' class='form-control' name='b' style='height:260px'><?php echo $rows['isi_berita'] ?></textarea>
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
                                                <img class='current-image' width='100%' src='<?php echo base_url() . "../asset/foto_berita/" . $rows['gambar'] ?>'>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div id="file-upload">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                <?php if ($rows['gambar'] != '') : ?>
                                                    <!--<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href="<?php echo base_url() . '/' . webconfig('asset') . '/foto_schedules/' . $rows['gambar'] ?>"><?php echo $rows['gambar'] ?></a>-->
                                                    <img class='current-imagez' width='100%' src='<?php echo base_url() . "../asset/foto_berita/" . $rows['gambar'] ?>'>
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
                        <!-- <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="seo-tab">


                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Meta Title</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="meta-title" type='text' class='form-control' name='meta_title' value='<?php echo $rows['meta_title'] ? $rows['meta_title'] : $rows['judul'] ?>' palceholder="Meta title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Meta Url</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="meta-url" class='form-control' palceholder="google link" value="<?php echo home_url('berita/detail/' . $rows['slug']) ?>" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Description</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea id="meta-desc" type='text' class='form-control' name='meta_description'><?php echo $rows['meta_description'] ? $rows['meta_description'] : character_limiter(strip_tags($rows['isi_berita']), '222') ?></textarea>
                                    <input type="text" id="meta-featured-image" class="hidden" value="<?php echo base_url() . "../asset/foto_berita/" . $rows['gambar'] ?>" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">META Keywords</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type='text' class='form-control' name='meta_keywords' value='<?php echo $rows['meta_keywords'] ?>'>
                                </div>
                            </div>

                        </div> -->
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type='submit' name='submit' class='btn btn-success'>Update</button>
                        <a class='btn btn-primary pull-right' href='<?php echo base_url('news'); ?>'>Cancel</a>
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
                    $(input).closest('.img-group').find('img').attr('src', e.target.result);
                    // $(input).closest("div.form-group img").attr('src', e.target.result);
                    // $(e.target).closest("div.form-group .img-preview").removeClass('has-error alert alert-warning');
                    // $('.img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#site_logo").change(function() {
            // readURL(this);
        });
        // $('.form-group').each(function() {
        //     var imageinput = $(this).find('.imgupload');
        //     // imageinput.change(function() {
        //     //     alert('testt');
        //     //     readURL(imageinput);
        //     // });
        //     imageinput.change(function() {
        //         //checkboxValidator(chk, form, 2);
        //         // alert(this);
        //         // readURL(this);
        //         // $(e.target).closest("div.form-group .img-preview").removeClass('has-error alert alert-warning');
        //     });
        // });
        var imageinput = $("input.imgupload");
        imageinput.on('change', function(e) {
            //checkboxValidator(chk, form, 2);
            alert('check');
            readURL(e.target);
            // $(e.target).closest('.img-group').find('img').attr('src', '');
        });
        // $('input[type=file]').each(function() {
        //     $(this).change(function() {
        //         readURL(this);
        //     });
        // });
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