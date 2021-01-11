<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Posts Management class created by CodexWorld
 */
class Data extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('enquiry/enquiry_model');
        $this->load->library('Ajax_pagination');
        $this->perPage = 10;
        //pdf xls import
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->helper('date');

    }
    
    public function index(){
        $data = array();
        //$this->perPage = 10;
        //total rows count
        $totalRec = count($this->enquiry_model->getenquiry());
        
        //pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'data/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->enquiry_model->getenquiry(array('limit'=>$this->perPage));
        $data['start'] = 0;
        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
         
        $config['full_tag_open'] = '<ul class="pagination fikar">';
        $config['full_tag_close'] = '</ul>';
         
        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<li><span class="firstlink">';
        $config['first_tag_close'] = '</span></li>';
         
        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<li><span class="lastlink">';
        $config['last_tag_close'] = '</span></li>';
         
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li><span class="nextlink">';
        $config['next_tag_close'] = '</span></li>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<li><span class="prevlink">';
        $config['prev_tag_close'] = '</span></li>';

        $config['cur_tag_open'] = '<li class="active"><span class="curlink">';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li><span class="numlink">';
        $config['num_tag_close'] = '</span></li>';
         
        $this->ajax_pagination->initialize($config);
        //load the view
        //$this->load->view('postsview/index', $data);

        //fikar
        cek_session_admin();
        //$data['record'] = $this->model_berita->list_berita();
        
        //view
        $this->template->load('administrator/template','view_data',$data);

        
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $numView = $this->input->post('numView');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->enquiry_model->getenquiry($conditions));
        if(!empty($numView)){
            //$conditions['limit'] = $numView;
            $config['per_page']    = $numView;
        }
        else{
            //$conditions['limit'] = $this->perPage;
            $config['per_page']    = $this->perPage;
        }
        //pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'data/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        //$config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        if(!empty($numView)){
            $conditions['limit'] = $numView;
            //$config['per_page']    = $numView;
        }
        else{
            $conditions['limit'] = $this->perPage;
            //$config['per_page']    = $this->perPage;
        }
        /*
        //fikar cookie
        $cookie= array(
   
             'name'   => 'numvewku',
   
             'value'  => $numView,
   
             'expire' => '3600',
   
        );
        $this->load->helper('cookie');
        $this->input->set_cookie($cookie);
        */
        
         //end cookie
        //get posts data
        $data['posts'] = $this->enquiry_model->getenquiry($conditions);
        $data['start'] = $offset;
        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
         
        $config['full_tag_open'] = '<ul class="pagination fikar">';
        $config['full_tag_close'] = '</ul>';
         
        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<li><span class="firstlink">';
        $config['first_tag_close'] = '</span></li>';
         
        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<li><span class="lastlink">';
        $config['last_tag_close'] = '</span></li>';
         
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li><span class="nextlink">';
        $config['next_tag_close'] = '</span></li>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<li><span class="prevlink">';
        $config['prev_tag_close'] = '</span></li>';

        $config['cur_tag_open'] = '<li class="active"><span class="curlink">';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li><span class="numlink">';
        $config['num_tag_close'] = '</span></li>';
         
        $this->ajax_pagination->initialize($config);
        //load the view
        $this->load->view('ajax-pagination-data', $data, false);

    }
    //==download end 
    function save(){
        //$this->load->library('phpexcel');
        //$this->load->library('PHPExcel/iofactory');
        $conditions = array();
        $keywords = $this->input->cookie('keywords',true);
        $sortBy = $this->input->cookie('sortBy',true);
        $numView = $this->input->cookie('numView',true);
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }

        //$totalRec = count($this->enquiry_model->getenquiry());
        if ($this->input->cookie('numView',true) !== '') {
          $this->perPage = $this->input->cookie('numView',true);
        }
        $conditions['limit'] = $this->perPage;
        
        //get the posts data
        //$data['posts'] = $this->enquiry_model->getenquiry($conditions);

        $select = $this->enquiry_model->getenquiry($conditions);
        
        //$objPHPExcel = new PHPExcel();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17);

        $objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

        $header = array(
          'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
          ),
          'font' => array(
              'bold' => true,
              'color' => array('rgb' => 'FF0000'),
              'name' => 'Verdana'
          )
        );
        $objPHPExcel->getActiveSheet()->getStyle("A1:G2")
              ->applyFromArray($header)
              ->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G2');
        $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'Export Data Enquiry')
          ->setCellValue('A3', 'No')
          ->setCellValue('B3', 'Name')
          ->setCellValue('C3', 'Email')
          ->setCellValue('D3', 'Phone')
          ->setCellValue('E3', 'Subjek')
          ->setCellValue('F3', 'Message')
          ->setCellValue('G3', 'Date');

        $ex = $objPHPExcel->setActiveSheetIndex(0);
        $no = 1;
        $counter = 4; //batas mulai record
        
        foreach ($select as $row){
            //print_r($row);
            //echo $row['name'];
        
          $ex->setCellValue('A'.$counter, $no++);
          //$ex->setCellValue('A'.$counter, $row->id);
          $ex->setCellValue('B'.$counter, $row['name']);
          $ex->setCellValue('C'.$counter, $row['email']);
          $ex->setCellValue('D'.$counter, $row['phone']);
          $ex->setCellValue('E'.$counter, $row['subjek']);
          $ex->setCellValue('F'.$counter, $row['message']);
          $ex->setCellValue('G'.$counter, $row['date']);

          $counter = $counter+1;
          
        }
        

        $objPHPExcel->getProperties()->setCreator("Ahmad Zulfikar")
          ->setLastModifiedBy("Ahmad Zulfikar")
          ->setTitle("Export PHPExcel Test Document")
          ->setSubject("Export PHPExcel Test Document")
          ->setDescription("Test doc for Office 2007 XLSX, generated by PHPExcel.")
          ->setKeywords("office 2007 openxml php")
          ->setCategory("PHPExcel");
        $objPHPExcel->getActiveSheet()->setTitle('Data Orang');
                                
        // Assign cell values
        //$objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getActiveSheet()->setCellValue('A1', 'cell value here');

        // Save it as an excel 2003 file
        //$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter  = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Last-Modified:'. gmdate("D, d M Y H:i:s").'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ExportDataOrangPHPExcel'. date('Ymd') .'.xlsx"');
        $objWriter->save('php://output');
        
    }
    function savepdf(){
        $data = array();
        //$this->perPage = 10;
        //total rows count
        $conditions = array();
        $keywords = $this->input->cookie('keywords',true);
        $sortBy = $this->input->cookie('sortBy',true);
        $numView = $this->input->cookie('numView',true);
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }

        //$totalRec = count($this->enquiry_model->getenquiry());
        if ($this->input->cookie('numView',true) !== '') {
          $this->perPage = $this->input->cookie('numView',true);
        }
        $conditions['limit'] = $this->perPage;
        
        //get the posts data
        $data['posts'] = $this->enquiry_model->getenquiry($conditions);
        $data['start'] = 0;
        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
         
        $config['full_tag_open'] = '<ul class="pagination fikar">';
        $config['full_tag_close'] = '</ul>';
         
        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<li><span class="firstlink">';
        $config['first_tag_close'] = '</span></li>';
         
        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<li><span class="lastlink">';
        $config['last_tag_close'] = '</span></li>';
         
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li><span class="nextlink">';
        $config['next_tag_close'] = '</span></li>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<li><span class="prevlink">';
        $config['prev_tag_close'] = '</span></li>';

        $config['cur_tag_open'] = '<li class="active"><span class="curlink">';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li><span class="numlink">';
        $config['num_tag_close'] = '</span></li>';
         
        $this->ajax_pagination->initialize($config);

        $this->load->library("pdf");
        $this->pdf->load_view('example_to_pdf',$data);
        $this->pdf->set_paper('A4', 'portrait');
        $this->pdf->set_base_path(base_url().'asset/admin/bootstrap/css/bootstrap.min.css');
        $this->pdf->render();
        //$this->pdf->stream("contohpdf.pdf");
        $this->pdf->stream("data.pdf", array("Attachment"=>0));
        
    }

    function import(){
      cek_session_admin();
      if (isset($_POST['submit'])){
        //$this->model_berita->list_berita_tambah();
        //redirect('data');
        echo 'submittttttt';
      }else{
        $data = array();
        $this->template->load('administrator/template','view_import',$data);
      }

    }
    function upload(){
      if ($this->input->is_ajax_request()){  
          $file = $this->input->post('file');
          $this->enquiry_model->importdata($file);
      }
      else{
          //show_404();

        echo "string";
      }
    }
    function do_upload(){
      if ($this->input->is_ajax_request()){
        $this->enquiry_model->upload_data();
      }else{
        show_404();
      }
    }
    
}