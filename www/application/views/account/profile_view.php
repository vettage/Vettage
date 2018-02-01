<?php echo ($this->session->flashdata('success_msg')) ? '<div class="alert alert-success">'.$this->session->flashdata('success_msg').'</div>' : ''?>
<?php echo ($this->session->flashdata('error_msg')) ? '<div class="alert alert-error">'.$this->session->flashdata('error_msg').'</div>' : ''?>

<?php
	$roles = array();
	if (substr($member_details->type,-1)=='1') $roles[] = 'Subscriber';
	if (substr($member_details->type,0,1)=='1')  $roles[] = 'Editor';
	if (substr($member_details->type,1,1)=='1')  $roles[] = 'Content Contributor';
	$role_string = implode (' | ',$roles);
?>
<div class="container">
	<div class="row" >
	
			<div class="col-lg-5">
			
			<?php if (empty($this->user_id)){?>
				
			<div class="pad-top col-lg-8">
				<h3>Login or Join to Rate!</h3>
 				<form action="<?php echo $_SERVER['PHP_SELF']?>" class="signin" method="post" id="frmsignin" role="form">
				<div class="form-group">
					<input type="text" id="signin_email" name="signin_email" value="" placeholder="Username or email" 
                    class="form-control input-sm" > 
				</div>
				<div class="form-group">
					<input type="password" id="signin_password" name="signin_password" placeholder="Password" 
                     class="form-control input-sm" autocomplete="off" value="">
 				</div>
				<div class="form-group">
					<small class="pull-right"><a href="javascript:void(0);" id="hreforgot">Forgot password?</a></small>
					<div class="checkbox less-mar-top">
                    <label  class="text-muted">
                    <input type="checkbox" value="1" name="remember" checked="checked">Remember me</label>
                    </div>
				</div>
				<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']?>"/>
								<div class="form-group"><button class="btn btn-danger btn-sm" type="button" name="doLogin" id="btnsignin">Sign in</button>
                </div>
			  </form>
 				<form action="" class="signin" method="post" id="frmforgot" role="form">
				<div class="form-group">
					<input type="text" id="forgot_email" name="forgot_email" placeholder="Username or email" class="form-control input-sm">
				</div>
				<div class="form-group">
					<button class="btn btn-danger btn-sm" type="button" id="btnforgot">Reset password</button>
					<button class="btn btn-sm" type="button" id="btnforgotcancel">Cancel</button>
				</div>
			  	</form>
 				<h3>New to Vettage? <small>Sign up</small></h3>
				<form role="form" id="frmregister" action="">
				<div class="form-group">
					<input type="text" name="username" id="username" placeholder="Username" class="form-control input-sm">
				</div>
				<div class="form-group">
					<input type="text" name="email" id="email" placeholder="Email" class="form-control input-sm">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" 
                    class="form-control input-sm">
				</div>
				<div class="form-group">
					<button class="btn btn-danger btn-sm"  type="button" id="btnregister">Sign up for Vettage </button>
 				</div>
				<input type="hidden" name="redirect" value="<?php echo $_SERVER['REQUEST_URI']?>"/>

			  </form>
 			</div>
				
				
			<?php  } ?>




			</div>
 			  <div class="col-lg-7 bg-light pad-bottom">
				<div class="row">
				<h3 class="less-mar-bottom">PROFILE</h3>

  				<?php
 				$member_file_path = getcwd().'/media/uploads/members/';
				$member_path = BASE_URL.'media/uploads/members/';
				
				$img_src = $member_path.'randombig.gif';
				if($member_details->picture!='' && file_exists($member_file_path.$member_details->picture))
					$img_src = $member_path.$member_details->picture;
				
				$connections = sizeof($this->connect_model->combox("*","(to_id='".$member_details->id."' OR from_id='".$member_details->id."') AND                    status=1")); 			
				$story_details = $this->content_model->combox("*","editor='".$member_details->id."'"); 
				
				$contents_ids = '';
					$allotments = $this->allotment_model->combox("distinct(content_id) as content_id","contributor_id='".$member_details->id."'");
					foreach($allotments as $row_allotments) $contents_ids.=$row_allotments->content_id.",";		
					if($contents_ids!='') $contents_ids = trim($contents_ids,","); else $contents_ids = "''";
					$contribution_details = $this->content_model->combox("*","content_id IN ($contents_ids) and editor<>".$member_details->id); 
				?>
				
				<br/>
				<div class="media">
					<div class="pull-left">
						<img src="<?php echo $img_src?>" style="width: 65px; height: 65px;" class="media-object" alt="65x65">
					</div>
					<div class="pull-right">
						<?php echo 'Total Earnings: $'.number_format($total_earnings,2)?><br />

					</div>

					<div class="media-body">
						<h4 class="media-heading"><?php echo $member_details->username; ?></h4>
						<h5><?php echo $connections?> <small>Connections</small></h5>
						<?php echo $role_string;?>
					</div>
					
				</div>
				<hr>
				 <div style="float: left;">
        		<h5>Final Stories</h5>
                <h6>
					<?php foreach($story_details as $details) :
					
					
		$story_rating = $this->content_model->custom_query("SELECT AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance)
				as percent  FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE contents.content_id=".$details->content_id);
		
		$story_rating = ($story_rating[0]->percent * 100) / 40;
		if (empty($story_rating)) $story_rating = 'Not yet rated.';
			else $story_rating = round($story_rating,2).'%';
	
		$ratings_count = $this->content_ratings_model->count_records("where content_id=".$details->content_id,"*");
		if ($ratings_count>0) $story_rating .= ' / '.$ratings_count.' ratings';
			
					?>
					
						<a href="<?php  echo BASE_URL?>story/<?php echo $details->alias?>"><?php  echo $details->title; ?> (<?php echo $story_rating?>)</a><br>
					<?php  endforeach;?>
				</h6>

        		<h5>Story Contributions</h5>
                <h6>
					<?php foreach($contribution_details as $row_contribution_details) : ?>
						<a href="<?php  echo BASE_URL?>story/<?php echo $row_contribution_details->alias?>"><?php  echo $row_contribution_details->title; ?></a><br>
					<?php  endforeach;?>
				</h6>
                 </div>
 				     <div style="float: right;">
 				<dl class="dl-horizontal">
					<dt>Experience:</dt>
					<dd><?php echo $member_details->experience;?></dd>
					<dt>Expertise:</dt>
					<dd>
						<?php					 
						$exp = explode(',',$member_details->expertise);
						if(!empty($exp))
						{
							foreach($exp as $val) echo $val."<br />";
						}
						?>
					</dd>
				</dl>
   				</div>
				</div>
   			</div>
  		</div>
 	</div>
</div>
