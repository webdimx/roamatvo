<?php if ( ! defined('ABSPATH')) exit; ?>

<?
include('modal.php');
?>





	<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Sistema de gerenciamento - <?=SITE_NAME?> - v1.0</span>

						</span>


					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

        <script src="<?php echo HOME_URI;?>views/assets/js/main.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo HOME_URI;?>views/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

        <script src="<?php echo HOME_URI;?>views/assets/js/chosen.jquery.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/spinbox.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/moment.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/daterangepicker.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/jquery.knob.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/autosize.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-tag.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/jquery.maskMoney.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/summernote.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/fullcalendar.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/locale-all.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/moment.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/gcal.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/scheduler.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/jquery-fileupload.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/jquery-ui.min.js"></script>


		<!-- ace scripts -->

		<script src="<?php echo HOME_URI;?>views/assets/js/ace-elements.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/ace.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/jquery.nestable.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-multiselect.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/jquery-editable-select.js"></script>

        <script src="<?php echo HOME_URI;?>views/assets/js/markdown.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/bootstrap-markdown.min.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/jquery.hotkeys.index.min.js"></script>
        <script src="<?php echo HOME_URI;?>views/assets/js/cookie.js"></script>
		<script src="<?php echo HOME_URI;?>views/assets/js/scroll.js"></script>



		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {

				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('.date-range').daterangepicker({

					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					"autoUpdateInput": false,
					 "opens": "center",
					ranges: {
					'Hoje': [moment(), moment()],
					'Amanhã': [moment(), moment().add(1, 'days')],
					'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
					'Próximos 7 dias': [moment(), moment().add(7, 'days')],
					'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
					'Próximos 30 dias': [moment(), moment()],
					'Este mês': [moment().startOf('month'), moment().endOf('month')],
					'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					locale: {
						applyLabel: 'Filtrar',
						cancelLabel: 'Cancelar',
						format: 'DD/MM/YYYY',
						"customRangeLabel": "Escolher período",
					}

				 }, function(start, end, label) {


					  $('.sel').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY')).removeClass('sel');
					  $('.filterRegistry').click()

					})

					$('.date-range').click(function(){

						$(this).addClass('sel') ;

					})

				//var tempValues = JSON.parse($('.date-range').val());
//alert(tempValues.start);
//alert(tempValues.end);


				//if($('.date-range').val('')

				$('.sortings').click(function(){

					if($(this).find('input[name=order]').val()==''){

						$order = 'asc'

					}
					else if($(this).find('input[name=order]').val()=='asc')
					{
						$order = 'desc'

					}
					else if($(this).find('input[name=order]').val()=='desc')
					{

						$order = ''

					}



					$(this).find('input[name=order]').val($order)
					$('.filterRegistry').trigger('click')

				})


				$('body').on('click', 'input[name=presenca]', function(){


					if($(this).val()==2){

						$(this).parents('.table-detail').find('.dsp').hide()
						$(this).parents('.table-detail').find('.dsp').find('input[name=desempenho]').eq(0).prop('checked', true);
					}
					else
					{
						$(this).parents('.table-detail').find('.dsp').show()
						$(this).parents('.table-detail').find('.dsp').find('input[name=desempenho]').eq(3).prop('checked', true);

					}

				})





				$('.money').maskMoney({thousands:'.', decimal:',', allowZero: true, allowEmpty: true})
				$('.moneyUSD').maskMoney({thousands:'.', decimal:'.', allowZero: true, allowEmpty: true})

				$('.hour').mask('99:99');
				$('.cpf').mask('999.999.999-99');
				$('.cnpj').mask('99.999.999/9999-99');
				$('.telefone').mask("(99) 9999-9999")
				$('.celular').mask("(99) 9999?9-9999").ready(function(event) {
    var target, phone, element;
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;
    phone = target.value.replace(/\D/g, '');
    element = $(target);
    element.unmask();
    if(phone.length > 10) {
        element.mask("(99) 99999-999?9");
    } else {
        element.mask("(99) 9999-9999?9");
    }
});
				$('.cep').mask('99999-999');

			   $('#sidebar2').insertBefore('.page-content');
			   $('#navbar').addClass('h-navbar');
			   $('.footer').insertAfter('.page-content');

			   $('.page-content').addClass('main-content');

			   $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');


			  $('#sidebar2').insertBefore('.page-content');

			   $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


			   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
				 if(event_name == 'sidebar_fixed') {
					 if( $('#sidebar').hasClass('sidebar-fixed') ) {
						$('#sidebar2').addClass('sidebar-fixed');
						$('#navbar').addClass('h-navbar');
					 }
					 else {
						$('#sidebar2').removeClass('sidebar-fixed')
						$('#navbar').removeClass('h-navbar');
					 }
				 }
			   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);

			   $('#sidebar2[data-sidebar-hover=true]').ace_sidebar_hover('reset');
			   $('#sidebar2[data-sidebar-scroll=true]').ace_sidebar_scroll('reset', true);
			})


			$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});


				jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});


				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true});
					//resize the chosen on window resize

					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});


					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}


				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});

				autosize($('textarea[class*=autosize]'));

				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});

				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'Selecione ...',
					btn_choose:'Buscar',
					btn_change:'Trocar',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])


				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Arraste e solte ou clique para procurar, formato da planilha em CSV',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}

				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});

				$('#id-input-file-4').ace_file_input({
					style: 'well',
					btn_choose: 'Arraste e solte ou clique para procurar, formato da planilha em CSV',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}

				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});


				$('#id-input-file-5').ace_file_input({
					style: 'well',
					btn_choose: 'Arraste e solte ou clique para procurar, formato da planilha em CSV',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}

				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});


				$('#id-input-file-7').ace_file_input({
					style: 'well',
					btn_choose: 'Arraste e solte ou clique para procurar, formato da planilha em CSV',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}

				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});


				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);




				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";

						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";

						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');

					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format

						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']

						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]


						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/


						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});


					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/

				});

				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				});
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});

				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0


				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})

				$('.date-picker-2').datepicker({
					autoclose: true,
					todayHighlight: true
				})


				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});


				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('.date-range-picker').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});


				$('.timepicker1').timepicker({
					minuteStep: 1,
					defaultTime: false,
					showSeconds: false,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$(this).timepicker('showWidget');

				}).on('focusout', function() {
					$(this).timepicker('hideWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});




				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});


				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe

				$('#simple-colorpicker-1').ace_colorpicker();
				$('.simple-colorpicker').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist


				$(".knob").knob();


				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)

					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');

					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}


				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})

				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/

				$('body').on('click', '.show-details-btn', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});



				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')

					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});

				$('#editor1').ace_wysiwyg({
		toolbar:
		[
			null,
			null,

			null,
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,

			null,
			{name:'justifyleft', className:'btn-primary'},
			{name:'justifycenter', className:'btn-primary'},
			{name:'justifyright', className:'btn-primary'},
			{name:'justifyfull', className:'btn-inverse'},
			null,
			{name:'createLink', className:'btn-pink'},
			{name:'unlink', className:'btn-pink'},
			null,
			{name:'insertImage', className:'btn-success'},
			null,
			'foreColor',
			null,
			{name:'undo', className:'btn-grey'},
			{name:'redo', className:'btn-grey'}
		],

	}).prev().addClass('wysiwyg-style2');

			});




</script>
