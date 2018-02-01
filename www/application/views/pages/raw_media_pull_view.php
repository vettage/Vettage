<?php 
$types  	=''; if(!empty($_GET['format'])) $format = $_GET['format'] ;
$city 		=''; if($this->input->get('city')!=NULL)  $city = $this->input->get('city'); 
$state 		=''; if($this->input->get('state')!=NULL)  $state = $this->input->get('state'); 
$country 	=''; if ($this->input->get('country')!=NULL)  $country = $this->input->get('country'); 
$date 		=''; if ($this->input->get('date')!=NULL) $date =  $this->input->get('date'); 
$zipcode 	=''; if ($this->input->get('zipcode')!=NULL) $zipcode =  $this->input->get('zipcode'); 
$links 		=''; if($this->input->get('links')!=NULL)  $links =  $this->input->get('links'); 
$tags 		=''; if($this->input->get('tags')!=NULL)  $tags =  $this->input->get('tags'); 
?>
<div class="container">
	<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
    	<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('error_msg').'</div>' : ''?>

	<div class="row">
        <div class="col-lg-4">
        	<div class="btn-toolbar pad-top" role="toolbar">
            <div class="btn-group">
              <a href="#" class="btn btn-default btn-sm active">RAW MEDIA PULL</a>
              <a href="#" class="btn btn-default btn-sm">CONNECT</a>
              <a href="#" class="btn btn-default btn-sm">SUBMIT FINAL PIECE</a>
            </div>
          </div>
          <h3 class="less-mar-bottom"><?php echo $title; ?></h3>
        </div>
        <div class="col-lg-8 bg-light pad-bottom pad-top">
        	<form action="" method="get">
            	<div class="row">
                	<div class="col-lg-6">
                    	<div class="form-group">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label>Choose Type (s) :</label>
                                    <select multiple class="form-control" name="formattypes[]">
									<option value="360 Video" <?php if(strpos($types,"360 Video")!==false) echo 'selected="selected"'; ?>>360 Video</option>
									<option value="Animated image" <?php if(strpos($types,"Animated image")!==false) echo 'selected="selected"'; ?>>Animated image(s)</option>
									<option value="Infographic" <?php if(strpos($types,"Infographic")!==false) echo 'selected="selected"'; ?>>Infographic</option>
									<option value="Interactive" <?php if(strpos($types,"Interactive")!==false) echo 'selected="selected"'; ?>>Interactive</option>
									<option value="Multimedia" <?php if(strpos($types,"Multimedia")!==false) echo 'selected="selected"'; ?>>Multimedia</option>
									<option value="Sound" <?php if(strpos($types,"Sound")!==false) echo 'selected="selected"'; ?>>Sound</option>
									<option value="Still image" <?php if(strpos($types,"Still image")!==false) echo 'selected="selected"'; ?>>Still image(s)</option> 
									<option value="Video" <?php if(strpos($types,"Video")!==false) echo 'selected="selected"'; ?>>Video</option>
									<option value="Writing" <?php if(strpos($types,"Writing")!==false) echo 'selected="selected"'; ?>>Writing</option>
                                    </select>
                                    <p><small class="text-muted">Hold down 'ctrl' key to select multiple types</small></p>
                                      <?php echo ((form_error('format')!=NULL)) ? '<span class="text-error">'.form_error('format').'</span>' : '' ?>   
                                 </div>
                            </div>
                         </div>
                        <label>Tag (Separate by commans) :</label>
                        <input type="text" name="tags" class="form-control input-sm" value="<?php  echo $tags;?>">  
                          <?php echo ((form_error('tags')!=NULL)) ? '<span class="text-error">'.form_error('tags').'</span>' : '' ?>

                    </div>
                    <div class="col-lg-6">
                    	<div class="form-group">
                            <label>Location :</label>
                            <select class="form-control input-sm" name="country">
                            <option value="" selected="selected">Select Country</option>
                           <?php foreach($countries as $row):?>
						 	<option value="<?php echo $row->name;?>" <? if($row->name==$country) echo 'selected="selected"';?>><?php echo $row->name;?></option>
								<?php endforeach;?>
                            </select>
                              <?php echo ((form_error('country')!=NULL)) ? '<span class="text-error">'.form_error('country').'</span>' : '' ?>                          </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                           <input type="state" name="state" placeholder="state" value="<?php  echo $state;?>" class="form-control input-sm"  />
                          <?php echo ((form_error('state')!=NULL)) ? '<span class="text-error">'.form_error('state').'</span>' : '' ?>  
                           </div>  
                                 <div class="col-lg-6">
                               <input type="city" name="city" placeholder="city" value="<?php  echo $city;?>" class="form-control input-sm"  />
                            <?php echo ((form_error('city')!=NULL)) ? '<span class="text-error">'.form_error('city').'</span>' : '' ?>   </div>
                             </div>
                        </div>
           				<div class="form-group">
                        <input type="text" name="code" value="<?php  echo $zipcode;?>" class="form-control input-sm" placeholder="Postal Code" />
                       <?php echo ((form_error('zipcode')!=NULL)) ? '<span class="text-error">'.form_error('zipcode').'</span>' : '' ?>   

                        </div>
                         <div class="form-group">
                            <label>Radius :</label>
                            <select class="form-control input-sm">
                            <option>25 miles/40.23 km</option>
                            <option>25 miles/40.23 km</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Date (YYYYMMDD) :</label>
                            <input type="text" name="date" value="<?php  echo $date;?>" class="form-control input-sm"  />
                        </div>
                     </div>
                </div>
                <hr>
                <div class="text-center">
                	<input type="submit" id="submit" class="btn btn-danger" value="search"  /> 
                </div>
            </form>
        </div>
    </div> 
    <br/>
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-heading">
			<h3 class="panel-title">SEARCH RESULTS</h3>
			</div>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>Contributor</th>
					<th>Format</th>
					<th>Tags</th>
					<th>Location</th>
					<th>Date/Time</th>
					<th>Link</th>
				</tr>
				</thead>
				<tbody>
				<?php if(empty($raw_details)){?>
				<tr><td colspan="100%" style="text-align:center;"><strong>No Records Available</strong></td></tr>
				<?php }else{
				foreach($raw_details as $row) :
					$member='';
					if($row->contributor_id>0){
						$details = $this->member_model->get_single_record("mem_id='".$row->contributor_id."'");
						if($details!="0") $member=$details->username;
					}
					$location = $row->city.", ".$row->state.", ".$row->country;
					$date = date("Ymd/H:i",strtotime($row->date));
					?>
					<tr>
						<td><?php echo  $member;?></td>
						<td><?php echo trim($row->format,",");?></td>
						<td><?php echo $row->tags;?></td>
						<td><?php echo $location;?></td>
						<td><?php echo $date;?></td>
						<td><?php echo $row->links;?></td>
					</tr>
					<?php 
					endforeach;
				}?>
				</tbody>
			</table>
		</div>
	</div>
	
 </div>     
		

        
		
	

