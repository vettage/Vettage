<?php
$this->load->view('sub_parts/header_view');
$this->load->view($view,$view_data);

if($view == 'pages/subscribers/subscription_view_bitcoin')
{
$this->load->view('sub_parts/footer_view_bitcoin');}
else
$this->load->view('sub_parts/footer_view');
?>

