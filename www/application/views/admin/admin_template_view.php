<?php if($folder=='') $folder ='';
$this->load->view('admin/sub_parts/header_view');
$this->load->view('admin/'.$folder.'/'.$view,$view_data);
$this->load->view('admin/sub_parts/footer_view');
?>