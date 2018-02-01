<div class="container">
	<div class="inner-spacer-right-lrg">
		<div class="post-title">
			<h3>FAQ</h3>
		</div>
		<div class="post-body">
			<?php 
			if(!empty($help_data))
			{
				foreach($help_data as $help_row)
				{
					echo '<h4>'.$help_row->question.'</h4>';
					echo $help_row->answer.'<br/>';
				}
			}
			else
				echo 'Questions Not Found';
			?>	
		</div>
	</div>
</div>