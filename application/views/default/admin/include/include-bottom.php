	
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="<?=base_url('assets/backend/')?>libs/jquery/jquery.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/sweet-alert-script.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/sweetalert.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/bootstrap.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script src="<?=base_url('assets/backend/')?>libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>libs/simplebar/simplebar.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>libs/node-waves/waves.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="<?=base_url('assets/backend/')?>libs/pace-js/pace.min.js"></script>

        <!-- apexcharts -->
        <!--<script src="<?=base_url('assets/backend/')?>libs/apexcharts/apexcharts.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/pages/apexcharts.init.js"></script>-->
        
        <script src="<?=base_url('assets/backend/')?>js/chart/chart.min.js"></script>

        <!-- Plugins js-->
        <script src="<?=base_url('assets/backend/')?>libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="<?=base_url('assets/backend/')?>js/pages/dashboard.init.js"></script>
      <script src="<?=base_url('assets/backend/')?>libs/dropzone/min/dropzone.min.js"></script>
      <script src="<?=base_url('assets/backend/')?>js/table-edits.min.js"></script>
      <script src="<?=base_url('assets/backend/')?>js/table-editable.int.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/app.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/choices.min.js"></script>
        <script src="<?=base_url('assets/backend/')?>js/ckeditor.js"></script>
          <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		
		
		 <?php echo alertify_render( '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build', 'top-right' ); ?>
		 
		 <script type="text/javascript">
		 function confirm_redirect(url, message = 'Do you want to continue?'){
			if( typeof alertify !== 'undefined' ){
				alertify.confirm(message, function(){
					window.location.href = url;
				});
			} else if( confirm( message ) ) {
				window.location.href = url;
			}
		}


		function confirm_ajax(url, message = 'Do you want to continue?'){
			function _ajax(){
				var xhr = new XMLHttpRequest();
				xhr.onload = function() {
					var response = JSON.parse(this.responseText);

					if( response.status == '1' ){
						(typeof alertify !== 'undefined') ? alertify.success(response.message) : alert(response.message);
					} else {
						(typeof alertify !== 'undefined') ? alertify.error(response.message) : alert(response.message);
					}
				}
				xhr.open("GET", url, true);
				xhr.send();
			}

			if( typeof alertify !== 'undefined' ){
				alertify.confirm(message, function(){
					_ajax();
				});
			} else if( confirm( message ) ) {
				_ajax();
			}
		}
		
	var i = 0;
	function add_content_list(data = {}){
		for(var item of [ 'title', 'desc']){
			if( ! (item in data) ){
				data[ item ] = '';
			}
		}
		jQuery('#content_list').after('<div class="row" id="content_list" style="background: #fbfaffa3; margin: 10px 0px; padding-top: 10px;">  <div class="col-xl-12 col-md-12">	<div class="form-group mb-3"> <label>Content List Title</label>	<input type="text" required name="list_title[]" class="form-control" placeholder="Content Item Title" /></div>	</div><div class="col-xl-12 col-md-12">	<div class="form-group mb-3"><label>Content List Description</label><textarea type="text" required name="list_desc[]" class="form-control" placeholder="Content List Description"></textarea><button type="button" class="btn btn-danger" title="Remove" onclick="remove_content_section_row(this)"><i class="fa fa-trash"></i></button></div></div></div>');
		i++;
		icon_picker_init()
	}
	
	function remove_content_section_row(btn)
	{
	    jQuery(btn).parents('#content_list').remove();
	}
	
	function remove_content_sction_list(btn,url,message = 'Do you want to continue?'){
	    function _ajax(){
				var xhr = new XMLHttpRequest();
				xhr.onload = function() {
					var response = JSON.parse(this.responseText);

					if( response.status == '1' ){
						(typeof alertify !== 'undefined') ? alertify.success(response.message) : alert(response.message);
					} else {
						(typeof alertify !== 'undefined') ? alertify.error(response.message) : alert(response.message);
					}
				}
				xhr.open("GET", url, true);
				xhr.send();
			}

			if( typeof alertify !== 'undefined' ){
				alertify.confirm(message, function(){
					_ajax();
					jQuery(btn).parents('#content_list').remove();
				});
			} else if( confirm( message ) ) {
				_ajax();
			}
	
	}
	
		

		
		 </script>
<script>
ClassicEditor.create(document.querySelector("#product_desc")).then(function(e){e.ui.view.editable.element.style.height="200px"}).catch(function(e){console.error(e)});	
ClassicEditor.create(document.querySelector("#offer_desc")).then(function(e){e.ui.view.editable.element.style.height="200px"}).catch(function(e){console.error(e)});	
ClassicEditor.create(document.querySelector("#specification")).then(function(e){e.ui.view.editable.element.style.height="200px"}).catch(function(e){console.error(e)});	
ClassicEditor.create(document.querySelector("#page_long_descr")).then(function(e){e.ui.view.editable.element.style.height="200px"}).catch(function(e){console.error(e)});	
ClassicEditor.create(document.querySelector("#event_desc")).then(function(e){e.ui.view.editable.element.style.height="200px"}).catch(function(e){console.error(e)});
</script>

    </body>

</html>