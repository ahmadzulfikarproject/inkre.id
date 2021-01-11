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
                        <h1><?php echo lang('edit_user_heading'); ?></h1>
                        <p><?php echo lang('edit_user_subheading'); ?></p>
                        <div id="infoMessage"><?php echo $message; ?></div>
                        <?php echo form_open_multipart(uri_string()); ?>

                        <p>
                              <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br />
                              <?php echo form_input($first_name); ?>
                        </p>

                        <p>
                              <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br />
                              <?php echo form_input($last_name); ?>
                        </p>

                        <p>
                              <?php echo lang('edit_user_company_label', 'company'); ?> <br />
                              <?php echo form_input($company); ?>
                        </p>

                        <p>
                              <?php echo lang('edit_user_phone_label', 'phone'); ?> <br />
                              <?php echo form_input($phone); ?>
                        </p>

                        <p>
                              <?php echo lang('edit_user_password_label', 'password'); ?> <br />
                              <?php echo form_input($password); ?>
                        </p>

                        <p>
                              <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
                              <?php echo form_input($password_confirm); ?>
                        </p>

                        <?php if ($this->ion_auth->is_admin()) : ?>

                              <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                              <?php foreach ($groups as $group) : ?>
                              <div class="checkbox">
                                    <label class="checkboxz">
                                          <?php
                                          $gID = $group['id'];
                                          $checked = null;
                                          $item = null;
                                          foreach ($currentGroups as $grp) {
                                                if ($gID == $grp->id) {
                                                      $checked = ' checked="checked"';
                                                      break;
                                                }
                                          }
                                          ?>
                                          <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo $checked; ?>>
                                          <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </label>

                              </div>
                              <?php endforeach ?>

                        <?php endif ?>

                        <?php echo form_hidden('id', $user->id); ?>
                        <?php echo form_hidden($csrf); ?>

                        <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary"'); ?></p>

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