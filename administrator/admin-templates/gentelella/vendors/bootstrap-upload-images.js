$(document).ready(function() {
    var fileArray = [];
    document.getElementById('pro-image').addEventListener('change', readImage, false);
    //document.getElementById('pro-image').addEventListener('change', gantigambar, false);
    
    $( ".preview-images-zone" ).sortable();
    

    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        var imgsrc =  $("#pro-img-"+no).attr('src');

        alert(imgsrc);
        $("#deleteimages").val(imgsrc);
        $(".preview-image.preview-show-"+no).remove();

    });
});

var num = 4;
function readImage(fileArray) {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var dFiles = [];
        var output = $(".preview-images-zone");
        $(".preview-image").remove();
        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;
            
            var picReader = new FileReader();
           
            

            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">edit</a></div>' +
                            '</div>';

                output.append(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
            dFiles.push(file);

            //fileArray.push(picReader);
            //console.log (picReader);
        }
        //$("#pro-image").val('');
        $("#pro-hasil").val(files);
        
        console.log (dFiles);
        //var dFilesku = $('#dFiles');
        
        //$('#dFiles').val(dFiles);
        //$("#hasil-image").text(picReader.readAsDataURL(file));
        var form_data = $('#formupload').serialize();
        
        //$("#hasil-image").html(form_data);
        //console.log (files);
        //console.log ($('#pro-hasil').prop('files'))
        
        
    } else {
        console.log('Browser not support');
    }
}
