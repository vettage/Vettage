							<input type="text" id="datepicker" name="date" value="<?php  echo $date;?>" class="form-control input-sm datepicker"  />
                            <?php echo ((form_error('date')!=NULL)) ? '<span class="text-error">'.form_error('date').'</span>' : '' ?>  
							<script type="text/javascript">
							$( function() {
							  $( "#datepicker" ).datepicker({ dateFormat: 'yymmdd',
							
								  beforeShow : function(){
							          if(!$('.datepicker_wrapper').length){
							               $('#ui-datepicker-div').wrap('<span class="ll-skin-latoja"></span>');
							          }
							      }
							
							
								   });
							} );
							</script>
