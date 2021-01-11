<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Autocomplete</title>
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css'?>">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <style type="text/css">
        html{
            position: relative;
            height: 100%;
            overflow-y: visible;

        }
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
        </style>
</head>
<body>

    <div class="container">

        <!--<input type="text" name="tags" class="form-control" id="tokenfield" />-->
        <!--<textarea name="description" class="form-control" placeholder="Description" style="width:500px;"></textarea>-->
        <span id="success_message"></span>
        <form method="post" id="programmer_form">
            <div class="form-group">
                <label>Enter Title</label>
                <input type="text" name="blog_title" id="blog_title" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter deskripsi</label>
                <input type="text" name="blog_description" id="blog_description" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter tags</label>
                <input type="text" name="tags" id="tags" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
            </div>
        </form>
        <div id="results" class="alert alert-success"></div>
            
        </div>
        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div></div>

    </div>

	<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			/*
		    $('#title').autocomplete({
                source: "<?php echo site_url('blog/get_autocomplete');?>",
     
                select: function (event, ui) {
                    $('[name="title"]').val(ui.item.label); 
                    $('[name="description"]').val(ui.item.description); 
                }
            });
            */
		    //fikar tag coba
		    $('#tokenfieldz').autocomplete({
                source: "<?php echo site_url('blog/get_autocomplete');?>",
     
                select: function (event, ui) {
                    $('[name="tags"]').val(ui.item.label); 
                    $('[name="description"]').val(ui.item.description); 
                }
            });
            // tags
            $('#tokenfieldxx').tokenfield({
            	autocomplete: {
            		source: "<?php echo site_url('tags/get_autocomplete');?>",
     
	                select: function (event, ui) {
	                    //$('[name="tags"]').val(ui.item.label); 
	                    //$('[name="description"]').val(ui.item.description); 
	                }
            	}
            	/*
            	autocomplete: {
            		source: function (request, response) {
            			jQuery.get("<?php echo site_url('blog/get_autocomplete');?>", {
            				query: request.term
            			}, function (data) {
            				data = $.parseJSON(data);
            				response(data);
            			});
            		},
            		delay: 100
            	},
            	showAutocompleteOnFocus: true
            	*/
            });

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
            $('#programmer_form').on('submit', function(event){
                event.preventDefault();
                if($.trim($('#blog_title').val()).length == 0)
                {
                    alert("Please Enter Your blog_title");
                    return false;
                }
                /*else if($.trim($('#tags').val()).length == 0)
                {
                    alert("Please Enter Atleast one tags");
                    return false;
                }
                */
                else
                {
                    var form_data = $('#programmer_form').serialize();
                    var d_blog_title = $("input#blog_title").val();
                    //var d_tags = $("input#tags").val();
                    //$( "#results" ).text( form_data );
                    $('#submit').attr("disabled","disabled");
                    $.ajax({
                        url:"<?php echo site_url('tags/add_blog');?>",
                        //method:"POST",
                        type: "POST",
                        dataType: "JSON",
                        data:form_data,
                        //data: {blog_title: d_blog_title},
                        beforeSend:function(){
                            $('#submit').val('Submitting...');
                            $('.loading').show();
                        },
                        success:function(data){
                            if(data != '')
                            {
                                $('#blog_title').val('');
                                $('#tags').tokenfield('setTokens',[]);
                                $('#success_message').html(data);
                                $('#submit').attr("disabled", false);
                                //$('.loading').fadeOut("slow");
                                

                                $('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    $('#submit').val('Submit');
                                    $( "#results" ).text( 'berhasil !!' );
                                    //$('#results').show();
                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });


                            }
                        }
                    });
                    setInterval(function(){
                        $('#success_message').html('');
                    }, 5000);
                }
            });            
            

		});
	</script>

</body>
</html>