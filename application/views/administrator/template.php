<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="language" content="Indonesia">
    <title>WELCOME ADMINISTRATOR</title>
    <meta name="author" content="phpmu.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bootstrap/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bootstrap/fontawesome-free-5.2.0-web/css/all.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/icheck/all.css">

    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/timepicker/bootstrap-timepicker.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style type="text/css"> .files{ position:absolute; z-index:2; top:0; left:0; filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; opacity:0; background-color:transparent; color:transparent; } </style>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/plugins/jquery/jquery-3.3.1.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.1/js/jasny-bootstrap.js"></script>-->
    
    <script type="text/javascript" src="<?php echo base_url(''); ?>asset/admin/holder.js"></script>
    <link href="<?php echo base_url('asset/admin/plugins'); ?>/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    
    <script type="text/javascript" src="<?php echo base_url(''); ?>asset/admin/admin.js"></script>
    <script type="text/javascript" src="<?php echo base_url(''); ?>asset/admin/bootstrap-upload-images.js"></script>
    

    <?php if (is_admin_home()):?>
    <script type="text/javascript" src="<?php echo base_url(''); ?>asset/admin/preloader.js"></script>
    <?php endif; ?>
    <!--tagmanager-->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/bootstrap-select-1.12.4/css/bootstrap-select.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/jqueryui/jquery-ui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/admin/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.css'); ?>">
    <link rel="shortcut icon" href="<?php echo home_url().'asset/'.idwebsite('favicon'); ?>">
    <script language="javascript" type="text/javascript"> 
      var maxAmount = 160;
      function textCounter(textField, showCountField) {
        if (textField.value.length > maxAmount) {
          textField.value = textField.value.substring(0, maxAmount);
        }else{ 
          showCountField.value = maxAmount - textField.value.length;
        }
      }
    </script>
    <!--<script src="<?php echo base_url(''); ?>asset/ckeditor/ckeditor.js"></script>-->
    <script src="<?php echo base_url(''); ?>asset/tinymce/tinymce.min.js"></script>
    <style type="text/css">
      .checkbox-scroll { border:1px solid #ccc; width:100%; height: 114px; padding-left:8px; overflow-y: scroll; }
    </style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/adminku.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/bootstrap-upload-images.css">
    <?php if (is_admin_home()):?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/loader.css">
    <?php endif; ?>
    <!-- Le styles -->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/css/style.css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <style type="text/css">
        .loading{
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -30px;
            margin-left: -30px;
            z-index: 99;
        }
        .paginationz{
            line-height: 34px;
        }
        .pagination li{
            float: left;
        }
        .numpage{
            padding: 6px 12px;
            padding-right: 10px;
        }
        #results{
            display: none;
        }
        .input-group {
            margin-bottom: 10px;
        }
        
        .inquery img{
            max-width: 100%;
        }
        .toggle-modal{
          width: 200px;
          position: fixed;
          margin: 0 auto;
          z-index: 1;
          bottom: 20px;
          right: 0;
          left: 0;
        }
        .uploaded_image{
          max-width: 100px;
          max-height: 100px;
          display: inline-block;
          margin-right: 10px;
        }
        .multifile_preview{
          max-width: 100px;
          max-height: 100px;
          width: auto;
          clear: both;
          display: block;
        }
        

    </style>
    <?php if (! is_level('admin')):?>
      <style type="text/css">
        .is-admin{
          display: none;
          visibility: hidden;
        }

    </style>
    <?php endif; ?>
    <?php if(!empty($css_files)): ?>
        <?php foreach($css_files as $file): ?>
          <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <?php if (is_admin_home()):?>
    <div class="preloader-wrapper hidden">
        <div class="preloader">
        </div>
    </div>
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div id="logoweb">
        <div id="logowebtext">PT-CMP.COM</div>     
      </div>
      <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

    </div>
    <?php endif; ?>
    <div class="wrapper">
      <header class="main-header">
          <?php include "main-header.php"; ?>
      </header>

      <aside class="main-sidebar">
          <?php include "menu-admin.php"; ?>
      </aside>

      <div class="content-wrapper">

        
        <section class="content-header" style="background-image: url(<?php //echo base_url().'/asset/'.idwebsite('header'); ?>);">
          <h1> Dashboard <small>Control panel </small> </h1>
        </section>

        <section class="content">
            <?php echo $contents; ?>
            

        </section>
        <div style='clear:both'></div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
          <?php include "footer.php"; ?>
      </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/jquery/jquery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/jqueryui/jquery-ui.min.js"></script>
    
    <!-- nested menu -->
    <script src="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/js/jquery.mjs.nestedSortable.js"></script>
    <script src="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/js/scripts.js"></script>
   
    <script>
      var BASE_URL = "<?php echo base_url(); ?>";
      var LIST_MAX_LEVELS = "<?php echo $this->config->item('max_levels', 'adjacency_list');?>";
    </script>
    <!--nested menu end-->
    
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/highchart/js/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/highchart/js/modules/data.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/highchart/js/modules/exporting.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>asset/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/timepicker/bootstrap-timepicker.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/icheck/icheck.min.js"></script>

    <!-- InputMask -->
    <!--
    <script src="<?php echo base_url(); ?>asset/admin/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/input-mask/jquery.inputmask.numeric.extensions.js"></script>-->
    <script src="<?php echo base_url('asset/admin/plugins/jqueryinputmask/jquery.inputmask.bundle.min.js'); ?>"></script>
    <!--tagmanager-->
    <script src="<?php echo base_url('asset/admin/plugins/bootstrap-tokenfield/bootstrap-tokenfield.js'); ?>"></script>
    <script src="<?php echo base_url('asset/admin/plugins/bootstrap-select-1.12.4/js/bootstrap-select.min.js'); ?>"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>asset/admin/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/jquery-multifile/js/jquery.multifile.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/jquery-multifile/js/jquery.multifile.preview.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/datepicker/jquery.datetimepicker.css" />
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datepicker/jquery.datetimepicker.full.min.js"></script>

    <script>
      $(function () {
        //alert('zzzz');
        jQuery('#bulan').datetimepicker({
          format:'d-m-Y',
          //inline:true,
          lang:'en',
          timepicker:false
        });
        //============
        jQuery('#date_timepicker_start').datetimepicker({
          format:'Y-m-d',
          onShow:function( ct ){
           this.setOptions({
            maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
           })
          },
          timepicker:false
        });
        jQuery('#date_timepicker_end').datetimepicker({
          format:'Y-m-d',
          onShow:function( ct ){
           this.setOptions({
            minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
           })
          },
          timepicker:false
        });
        jQuery('.date_timepicker_edit').datetimepicker({
          format:'d-m-Y',
          //onShow:function( ct ){
          // this.setOptions({
           // minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
           //})
          //},
          timepicker:false
        });
        jQuery('.pilihwaktu').datetimepicker({
          format:'d-m-Y H:i:s',
          onShow:function( ct ){
           this.setOptions({
            minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
           })
          },
          timepicker:true
        });
         //==============
        jQuery('.pilihwaktu').datetimepicker({
          format:'d-m-Y H:i:s',
          onShow:function( ct ){
           this.setOptions({
            //minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
           })
          },
          timepicker:true,
          datepicker:false
        });
      });
    </script>
    <script type="text/javascript">
      jQuery(function($)
      {
        $('#file_input').multifile();
      });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //fikar selectpicker kategori
        

        //var bar= $('#id_kategori').find("option:selected").val();


        $('.selectpicker').selectpicker();
       // $('.selectpicker').selectpicker('val', bar);
        //$('select[name=selValue]').val(sVal);
        /*
        $('.selectpicker').on('changed.bs.select', function(e){
          console.log(this.value,
                      this.options[this.selectedIndex].value,
                      $(this).find("option:selected").val(),);
          //$( "#results" ).text(this.value,
          //            this.options[this.selectedIndex].value,
          //            $(this).find("option:selected").val(),);
          //var selectedid = this.value,this.options[this.selectedIndex].value,$(this).find("option:selected").val();
          $( "#results" ).text(this.value,this.options[this.selectedIndex].value,$(this).find("option:selected").val(),);
          //$('.selectpicker').val(this.value,this.options[this.selectedIndex].value,$(this).find("option:selected").val(),);
          var selected = $('.selectpicker option:selected').val();
          //alert(selected);
          $('input[name=id_kategorihasil]').val(selected);
          $("select option[value=selected]").attr("selected","selected");
          $("select option").each(function(){
            if ($(this).val() == selected){
              $(this).attr("selected",true);
              //$('#selectbox').prop('selectedIndex',i);
            }else{
              $(this).attr("selected",false);
            }
          });
          
        });
        */
        /*
        $('#id_jabatan').on('changed.bs.select', function(e){
          $("select option[value=selected]").attr("selected","selected");
          $("select option").each(function(){
            if ($(this).val() == selected){
              $(this).attr("selected",true);
              //$('#selectbox').prop('selectedIndex',i);
            }else{
              $(this).attr("selected",false);
            }
          });
          alert($('#id_jabatan option:selected').val());
          console.log(this.value,
                      this.options[this.selectedIndex].value,
                      $(this).find("option:selected").val(),);
          var selected = $('#id_jabatan option:selected').val();
          //alert(selected);
          $('input[name=id_jabatanhasil]').val(selected);
          
        });
        */
        
       
        //$('#id_kategori').selectpicker('val', ['Teknologi']);
        //fikar tag coba
      
        /*
        //ajax input
        $('#tags').tokenfield({
            autocomplete: {
                source: "<?php echo site_url('tags/get_autocomplete');?>",
 
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
       */


                
            

      });
    </script>
    <script>
    $('#rangepicker').daterangepicker();
      $(function () { 
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
<script>
  $(function () {
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
     //Date picker
    $('#tanggal1').datepicker({
      format: 'dd-mm-yyyy',
      startDate: '-3d',
      autoclose: true
    })
    $('#tanggal2').datepicker({
      format: 'dd-mm-yyyy',
      startDate: '-3d',
      autoclose: true
    })
    $('.datepickerku').datepicker({
      format: 'dd-mm-yyyy',
        showMeridian: true,
        autoclose: true,
        todayBtn: true
    })
    
  })
  /*
  $(function () {
    $(".textarea").wysihtml5();
  });

  CKEDITOR.replace('editor1' ,{
    filebrowserImageBrowseUrl : '<?php echo base_url('asset/kcfinder'); ?>'
  });
  */
  //tinymce.init({
  //  selector: '#editor1'
  //})
  tinymce.init({
    selector: "#editor1",
    plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime nonbreaking save table contextmenu directionality",
    "emoticons template paste textcolor colorpicker textpattern responsivefilemanager code"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | print preview code pagebreak",
    image_advtab: true,
    relative_urls: false,
    remove_script_host : false,
    external_filemanager_path:"<?php echo base_url('asset/admin/plugins/filemanager/')?>",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "<?php echo base_url('asset/admin/plugins/filemanager/plugin.min.js')?>"}
        /*
        automatic_uploads: true,
        image_advtab: true,
        images_upload_url: "<?php //echo base_url("CONTROLLER_UPLOAD")?>",
        file_picker_types: 'image', 
        paste_data_images:true,
        relative_urls: false,
        remove_script_host: false,
          file_picker_callback: function(cb, value, meta) {
             var input = document.createElement('input');
             input.setAttribute('type', 'file');
             input.setAttribute('accept', 'image/*');
             input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                   var id = 'post-image-' + (new Date()).getTime();
                   var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                   var blobInfo = blobCache.create(id, file, reader.result);
                   blobCache.add(blobInfo);
                   cb(blobInfo.blobUri(), { title: file.name });
                };
             };
             input.click();
          }
          */
   });
  tinymce.init({
    selector: "#info",
    plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime nonbreaking save table contextmenu directionality",
    "emoticons template paste textcolor colorpicker textpattern responsivefilemanager code"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | print preview code pagebreak",
    image_advtab: true,
    relative_urls: false,
    remove_script_host : false,
    external_filemanager_path:"<?php echo base_url('asset/admin/plugins/filemanager/')?>",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "<?php echo base_url('asset/admin/plugins/filemanager/plugin.min.js')?>"}
   });
</script>
 <script src="<?php echo base_url('asset/admin/plugins'); ?>/jasny-bootstrap/js/jasny-bootstrap.js"></script>
  <?php if(!empty($js_files)): ?>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
  <?php endif; ?>
  </body>
</html>
