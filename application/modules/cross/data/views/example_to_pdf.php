<!DOCTYPE html>
<html>
<head>
  <title>Report Table Data</title>
  <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      width:100%;
      border-radius: 5px;
    }
 
    .short{
      width: 50px;
    }
 
    .normal{
      width: 150px;
    }
 
    table{
      border-collapse: collapse;
      font-family: arial;
      color:#5E5B5C;
      width: 100%;
    }
 
    thead th{
      text-align: left;
      padding: 10px;
    }
 
    tbody td{
      border-top: 1px solid #e3e3e3;
      padding: 10px;
    }
 
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
 
    tbody tr:hover{
      background: #EAE9F5
    }
    #watermark {
      display: block;
      line-height: 40px;
                position: fixed;

                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   0;
                left:     0;
                margin-left: 0px;
                margin-bottom: -30px;

                /** Change image dimensions**/
                width:    100%;
                height:   50px;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
    #watermark img{
      display: inline;
      width: auto;
      height: 40px;

    }
    #watermark .text-footer{
      display: inline;
    }
  </style>
</head>
<body>
  <div id="watermark">
      <img src="<?php echo home_url().'asset/'.logo(); ?>" height="100%" width="100%" />
      <small class='text-footer'>Copyright (c) <?php echo date('Y'); ?> - <?php echo setting('site_name'); ?> . All Rights Reserved.<br></small>
  </div>
  <div id="outtable">
    <h1>Report Table Data</h1>
    <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="short" >No.</th>
                    <th class="normal">Nama</th>
                    <th class="normal">Telp.</th>
                    <th class="normal">Pesan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = $start; if(!empty($posts)): foreach($posts as $post): ?>
                        <tr class="list-item">
                          <td><?php echo $no+1; ?></td>
                          <td>
                            <a href="javascript:void(0);"><?php echo $post['name']; ?></a>
                          </td>
                          <td><?php echo $post['phone']; ?></td>
                          <td><?php echo $post['message']; ?></td>
                        </tr>
                    <?php $no++; endforeach; else: ?>
                    <p>Post(s) not available.</p>
                    <?php endif; ?>
                  
                </tbody>
              </table>
   </div>
   <br>
   
</body>
</html>