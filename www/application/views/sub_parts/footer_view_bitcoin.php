		</div>
    </div>
    <footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<p class="less-mar">Copyright <?php echo date("Y");?> © Vettage. </p>
				</div>
				<div class="col-lg-6">
					<ul class="list-inline social-list">
						<li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="javascript:void(0);"><i class="fa fa-dribbble"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
    <!-- Placed at the end of the document so the pages load faster -->
    
     
	<div class="modal fade" id="error_dispaly" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
				</div>
				<div class="modal-body" id="model_body">
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<script src="<?php echo BASE_ASSETS;?>js/bootstrap.js"></script>
    <script src="<?php echo BASE_ASSETS;?>js/jquery-ui.min.js"></script>
    <script>
    	/*function centerModal() {
			$(this).css('display', '');
			var $dialog = $(this).find(".modal-dialog");
			var offset = ($(document).height() - $dialog.height()) / 5;
			// Center modal vertically in window
			$dialog.css("margin-top", offset);
		}
		
		$('.modal').on('show.bs.modal', centerModal);
		$(window).on("resize", function () {
			$('.modal').each(centerModal);
		});*/
    </script>	
</body>
<script src="//www.bitwall.io/javascripts/widget.js" id="bitwallWidgetScript" data-title="Buy with bitcoin" data-key="if4pkoc"></script>
</html>

