<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
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
		</style>

	</head>
	<body>
		<h1 class="text-center">Hello World</h1>
		<div class="container">
		    <h1>Ajax Pagination with Search in CodeIgniter</h1>
		    <div class="row">
		        <div class="post-search-panel">
		            <input type="text" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()"/>
		            <select id="sortBy" onchange="searchFilter()">
		                <option value="">Sort By</option>
		                <option value="asc">Ascending</option>
		                <option value="desc">Descending</option>
		            </select>
		        </div>
		       
		        <table class=" table table-striped table-hover">
		        	<thead>
		        		<tr>
		        			<th>Title</th>
		        			<th>description</th>
		        		</tr>
		        	</thead>
		        	<tbody id="postList" class="post-list">
		        		<?php if(!empty($posts)): foreach($posts as $post): ?>
		                <tr class="list-item">
		                	<td>
		                		<a href="javascript:void(0);"><?php echo $post['title']; ?></a>
		                	</td>
		                	<td>
		                		<?php echo $post['content']; ?>
		                	</td>
		                </tr>
			            <?php endforeach; else: ?>
			            <p>Post(s) not available.</p>
			            <?php endif; ?>
			            <?php echo $this->ajax_pagination->create_links(); ?>
		        	</tbody>
		        </table>
		        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div></div>
		    </div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
 		<script>
		function searchFilter(page_num) {
		    page_num = page_num?page_num:0;
		    var keywords = $('#keywords').val();
		    var sortBy = $('#sortBy').val();
		    $.ajax({
		        type: 'POST',
		        url: '<?php echo base_url(); ?>posts/ajaxPaginationData/'+page_num,
		        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
		        beforeSend: function () {
		            $('.loading').show();
		        },
		        success: function (html) {
		            $('#postList').html(html);
		            $('.loading').fadeOut("slow");
		        }
		    });
		}
		</script>
	</body>
</html>