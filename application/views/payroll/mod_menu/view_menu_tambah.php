<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Menu Utama</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_menuutama',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Menu</th>  <td><input type='text' class='form-control' name='a'></td></tr>
                    <tr><th scope='row'>Link</th>                     <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Arrange</th>                     <td><input type='text' class='form-control' name='arrange'></td></tr>
                    <tr><th scope='row'>Aktif</th>                    <td><input type='radio' name='c' value='Y'> Y <input type='radio' name='c' value='N'> N</td></tr>
                    <tr><th scope='row'>Admin Menu</th>               <td><input type='radio' name='d' value='Y'> Y <input type='radio' name='d' value='N'> N</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
