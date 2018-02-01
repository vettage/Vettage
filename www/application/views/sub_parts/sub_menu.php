					<?php 
					
					if (!empty($section)) {
											
	                    $links = $this->navigation->getMenuArray('sub',$section);
	                    
	                    foreach ($links as $name=>$link) {
	                    	
	                    	echo '<a class="btn btn-default btn-sm" href="'.BASE_URL.$link['uri'].'">'.$name.'</a>';
	                    }
	                    
					}
                    
                    ?>
