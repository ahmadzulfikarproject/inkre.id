<script>
  $(function () {
    
     //Date picker
    $('#tanggal1').datepicker({
      autoclose: true
    })
    $('#tanggal2').datepicker({
      autoclose: true
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
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager pagebreak",
        //toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        //automatic_uploads: true,
        image_advtab: true,
        external_filemanager_path:"<?php echo base_url('filemanager')?>",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "<?php echo base_url('filemanager/plugin.min.js')?>"}
        //images_upload_url: "<?php //echo base_url("CONTROLLER_UPLOAD")?>",
        /*
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
             */
          }

   });
</script>
