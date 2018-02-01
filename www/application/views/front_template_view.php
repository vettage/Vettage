<?php
$this->load->view('sub_parts/header_view');
$this->load->view($view,$view_data);
//echo $error_msg = ($this->session->flashdata('error_msg'))!= NULL ? $this->session->flashdata('error_msg') : '';exit;
$bitwall = !empty($bitwall) ? $bitwall : '';


if($bitwall == 'bitwall' || $view == 'pages/subscribers/subscription_view_bitcoin') 
$this->load->view('sub_parts/footer_view_bitcoin');
else
$this->load->view('sub_parts/footer_view');


/*if($view == 'pages/subscribers/subscription_view_bitcoin')
{
$this->load->view('sub_parts/footer_view_bitcoin');}
else
$this->load->view('sub_parts/footer_view');*/
?>

