<div class="col-lg-12">	

                	<div class="textcontent"><p>
						<?php 

						$local = trim($embed_code_link);
						$content_key = $content_key;
						
						$file_name = getcwd()."/media/uploads/contents/$content_key.html";
						//$rfile= fopen($file_name,"w") or die("unable to write");
						
						// Output one line until end-of-file
						if (file_exists($file_name)) {
							
							$local = "/media/uploads/contents/$content_key.html";
						}
						
						?>
						<iframe src="<?php echo $local;?>" style="width:100%; height:400px;border:1px solid #CCCCCC" sandbox="allow-same-origin allow-scripts"></iframe>
					</p></div>
				
</div>