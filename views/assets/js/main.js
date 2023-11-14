$(document).ready(function(){

	$('.delSim').click(function(a){

		a.preventDefault()

		$.post(controllerUrl+"/delSim", {'ID': $(this).attr('data-id')}, function(b){


			if(b==1){

				$alert('Esse simcard já está associado a uma transação!')
				return
			}
			else
			{

			  	window.location.reload()

			}


		})


	})


	$('.filtersField .selectAll').click(function(){



		if($(this).is(':checked')){

		$(this).parents('.filtersField').find('input[type=checkbox]').prop('checked', true)

		}
		else
	    {

		$(this).parents('.filtersField').find('input[type=checkbox]').prop('checked', false)

		}

	})

	$('.exportCad').click(function(a){




		a.preventDefault()


		$itens  = ''

		if($(this).data('method')!='all'){

		$sel = []

		$('#dynamic-table .item_id:checked').each(function(){

			$sel.push($(this).val())

		})


		if($sel.length){

			$itens = JSON.stringify($sel)
		}
		else
		{
			$alert('Por favor selecione algum registro para exportação!')
			return
		}

		}

		window.location=controllerUrl+'export/'+(window.location.search?window.location.search+'&':'?')+'type='+$(this).data('type')+'&data='+$itens



	})



	$('.exportSel').click(function(a){

		a.preventDefault()

		$sel = ''

		$('#dynamic-table .item_id:checked').each(function(){

			$sel += "'"+$(this).val()+"'|"

		})

		uri_ = $(this).attr('href')
		hasQuery = uri_.indexOf('?')

		if($sel){

			window.location= uri_+(hasQuery? '&' : '?' )+'IDS='+$sel.slice(0, -1)

		}else{

			$alert('Por favor selecione algum registro para exportação!')

		}


	})


	$('.showFilters').click(function(){


		if($('.fileds-select').css('display')=='block'){

			$(this).removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down')
			$('.fileds-select').slideUp()

		}else{

			$(this).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up')
			$('.fileds-select').slideDown()


		}



	})

	$('.filter-report').submit(function(a){


		a.preventDefault()

		$.removeCookie('reportSell');

		$.cookie('reportSell', $(this).serialize(), { expires: 365, path: '/' });

		window.location.reload()

		//console.log($('[name=filter]:checked').val())

		/*$.post(ajaxUrl+"/transacoes/report",$(this).serialize(), function(a){

			$('.report-ajax').html(a)

		})*/

	})


	$('.recharge').submit(function(a){

		$('.recharge-action').prop('disabled', true);


		a.preventDefault()

		$.post(ajaxUrl+'transacoes/recharge', $(this).serialize(), function(){

			$('.recharge').html('<h3 class="text-center">Recarga agendada com sucesso!</h3>')

		})

	})

	$('input[name=responsavel_cancelamento]').keydown(function(){

		$(this).css({'border-color':'rgb(213, 213, 213)'})

	})

	$('.removeSell').click(function(a){



		if(!$('input[name=responsavel_cancelamento]').val()){

			$('input[name=responsavel_cancelamento]').css({'border-color':'rgb(209, 91, 71)'})

		}
		else
		{

		$.post(ajaxUrl+"/transacoes/cancel", {'ID': $(this).attr('data-id'), responsavel: $('input[name=responsavel_cancelamento]').val()}, function(){


			window.location.reload()


		})

		}

	})


	$( ".search" ).autocomplete({

			source: function( request, response ) {
			$.ajax( {

			url: ajaxUrl+"/cadastros/getSearch",
			dataType: "json",
			data: {
			term: request.term
			},

			success: function( data ) {


			response($.map(data,function(item) {

			  return {

                label: item.result,
                value: request.term,
				abbrev: item.ID,
				categoria: item.tipo

              };

              }));


			}
			} );
			},
			minLength: 2,
			select: function( event, ui ) {



				$('#modal-search').modal('show')
				$('#modal-search .modal-body').html('<p class="text-center"><img src="'+ajaxUrl+'views/assets/images/wait.gif"></p>')

				if( ui.item.abbrev==""){

					return false

				}

				$.post(ajaxUrl+'/ajax/getDetailsSearch', {'id': ui.item.abbrev, 'tipo': ui.item.categoria}, function(a){

					$('#modal-search .modal-body').html(a);

			    })

			}

		});



	if(!$('.dataTable tbody tr').length){

		  _col = ''
		  _col = $('.dataTable thead tr th').length


			$('#dynamic-table tbody').html('<tr><td colspan='+_col+'><div class="alert alert-grey text-center" style="display:block !important;margin-bottom:0">Nenhum registro foi localizado!</div></td></tr>')

	}


	$('.gswap').click(function(){


			($(this).data('tipo')==1? $('.swapT .gswap').attr('data-tipo','1'):$('.swapT  .gswap').attr('data-tipo','2'))

			$('.makeSwap').prop('disabled', true).hide()

			$('.f-content').html('<p class="text-center"><img src="'+ajaxUrl+'views/assets/images/wait.gif"></p>')

			$('.stype').html(($(this).data('tipo')==1?'Ativação':'Desativação'))


			$('.makeSwap').attr('data-tipo', $(this).data('tipo'))
			$('[name=OnlySelected]').attr('data-tipo', $(this).data('tipo'))

		    $selecteds = []

		    $('#dynamic-table .item_id:checked').each(function(){

				$selecteds.push("'"+$(this).val()+"'")

			})

			$.post(ajaxUrl+'swap/getFornecedores', {tipo: $(this).data('tipo'), adiar: $('[name=adiar]:checked').val(), selecionados: $('[name=OnlySelected]:checked').val(), ids: JSON.stringify($selecteds)}, function(a){

				$('.f-content').html(a)
				$('.makeSwap').show()

			})

		})

		$('body').on('click', '.checkAll', function(){

			if($(this).is(':checked')){
			$('#modal-swap').find('input[type=checkbox]').prop('checked', true)
			}
			else{
			$('#modal-swap .f-content').find('input[type=checkbox]').prop('checked', false)
			}

			$('.makeSwap').prop('disabled', false)
		})

		$('#modal-swap  .f-content').on('click', 'input[type=checkbox]', function(){

			$('.makeSwap').prop('disabled', false)
		})




		$('.makeSwap').click(function(){

			$nd = $('input[name=adiar]:checked').val()
			$os = $('[name=OnlySelected]:checked').val()
			$('.swapFeed').html('Gerando Swap...')
			$(this).prop('')

			$f = new Array;

			$('.makeSwap').parents('#modal-swap').find('input[type=checkbox]:checked').each(function(){

				if($(this).val()){

					$f.push($(this).val())

				}


			})


			$.post(ajaxUrl+'swap/getSwapPendent', {tipo: $(this).data('tipo'), 'fornecedores': JSON.stringify($f), nextDay: $nd, selecionados: $os, ids: JSON.stringify($selecteds)}, function(a){

				if(a){

					$('.swapFeed').html('Swap Gerado com sucesso! Redirecionando...')

					setTimeout(function(){

						window.location=ajaxUrl+'swap/gerados'

					},1000)

				}

			})

		})





	$(".ic").click(function(){

			$('.importer select[name=tipo]').val($(this).data('type'))


			$('.field-mdn').hide();
			$('.field-simcard').hide()
		$('.field-both').hide()

			if($(this).data('type')==1){ $('.field-mdn').show()}else if($(this).data('type')==2){$('.field-simcard').show()}else{$('.field-mdn').show();$('.field-simcard').show();$('.field-both').show()

				$('select[name=status_simcard], select[name=status_mdn]').val(1)
				$("select[name=tipo] option:not(:selected)").attr('disabled', true)

			}

			if($('.importer select[name=tipo]').val()==1){

				$file = 'modelo_mdn'

			 }
			 else if($('.importer select[name=tipo]').val()==2){

				 $file = 'modelo_simcard'

			 }
			 else{

				 $file = 'modelo'

			 }


		$('.model').attr('href', ajaxUrl+'views/_files/'+$file+'.xls')

	})

	$('.importer select[name=tipo]').change(function(){

		$('.field-mdn').hide();
		$('.field-simcard').hide()
		$('.field-both').hide()

		if($(this).val()==1){ $('.field-mdn').show()}else if($(this).val()==2){$('.field-simcard').show()}else{$('.field-mdn').show();$('.field-simcard').show();$('.field-both').show()

		$('select[name=status_simcard], select[name=status_mdn]').val(1)
		$("select[name=tipo] option:not(:selected)").attr('disabled', true)

		 }


		if($('.importer select[name=tipo]').val()==1){

				$file = 'modelo_mdn'

			 }
			 else if($('.importer select[name=tipo]').val()==2){

				 $file = 'modelo_simcard'

			 }
			 else{

				 $file = 'modelo'

			 }


		$('.model').attr('href', ajaxUrl+'views/_files/'+$file+'.xls')


	})

	     $('[maxlength=50]').attr('maxlength', 200)

		// grab the initial top offset of the navigation
		   	var stickyNavTop = $('.nav').offset().top;

		   	// our function that decides weather the navigation bar should have "fixed" css position or not.
		   	var stickyNav = function(){
			    var scrollTop = $(window).scrollTop(); // our current vertical position from the top

			    // if we've scrolled more than the navigation, change its position to fixed to stick to top,
			    // otherwise change it back to relative
			    if (scrollTop > stickyNavTop) {
			        $('#sidebar').addClass('sticky');
					$('body').css({'padding-top':'25px'})

			    } else {
			        $('#sidebar').removeClass('sticky');
					$('body').css({'padding-top':'0'})
			    }
			};

			stickyNav();
			// and run it again every time you scroll
			$(window).scroll(function() {
				stickyNav();
			});





	function $alert(msg){

		$('#modal-alert .modal-body').html(msg)
		$('#modal-alert').modal('show');


	}

	$('.export').click(function(a){

		a.preventDefault()

		$ids = [];

		if($(this).data('action')=='selected'){

			if($('.table-atribuidos .item_id:checked').length){
			$('.table-atribuidos .item_id:checked').each(function(){

				$ids.push($(this).val())

			})
			}
			else
		    {
				$alert('Por favor selecione um registro para ser exportado');

			}


		}else{

			$('.table-atribuidos .item_id').each(function(){

				$ids.push($(this).val())

			})

		}


		$.post(controllerUrl+'export', {action: $(this).data('action'), ids: $ids.join(',')}, function(a){


			window.location=a;



		})

	})


	$('.importer').submit(function(a){


		$('.tableImport').html('<p class="text-center"><img src="'+ajaxUrl+'views/assets/images/wait.gif"></p>')

		a.preventDefault()

		var formData = new FormData(this);

		$.ajax({


        url: ajaxUrl+'/cadastros/importer',
        type: 'POST',
        data: formData,
        success: function (data) {

			$('.file-import').val(data)

			$.post(ajaxUrl+'/cadastros/importerData', $('.importer').serialize() , function(data) {

        		 $('.tableImport').html(data)
				 $('.saveImport').removeClass('disabled')

    		});




        },
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        return myXhr;
        }


       });



	})


	$('.changeStatus').submit(function(a){

		$('.tableImport').html('<p class="text-center"><img src="'+ajaxUrl+'views/assets/images/wait.gif"></p>')

		a.preventDefault()

		var formData = new FormData(this);

		$.ajax({


        url: ajaxUrl+'/cadastros/changeStatus',
        type: 'POST',
        data: formData,
        success: function (data) {

			$('.file-import').val(data)

			$.post(ajaxUrl+'/cadastros/changeStatusData', $('.changeStatus').serialize() , function(data) {

        		$('#modal-change-status').modal('toggle');

    		});




        },
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        return myXhr;
        }


       });



	})

	$('.importerSend').submit(function(a){

		$(this).find('.ajaxLoader').fadeIn()

		a.preventDefault()

		var formData = new FormData(this);

		$.ajax({


        url: ajaxUrl+'/cadastros/importer/reports',
        type: 'POST',
        data: formData,
        success: function (data) {

			$('.file-import').val(data)

			$.post(ajaxUrl+'/cadastros/importerSend', $('.importerSend').serialize() , function(data) {


				 $('.import-action').addClass('disabled')
				 $('.import-action').prop('disabled', true)

				window.location = controllerUrl+'/envios_simcard'

    		});




        },
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        return myXhr;
        }


       });



	})


	$('.importer_sell').submit(function(a){

		$(this).find('.ajaxLoader').removeClass('hidden').fadeIn()

		a.preventDefault()

		var formData = new FormData(this);

		$.ajax({


        url: ajaxUrl+'/cadastros/importer_sell',
        type: 'POST',
        data: formData,
        success: function (data) {

			$('#modal-export-lote .file-import').val(data)

			$.post(controllerUrl+'/importerDataSell', $('.importer_sell').serialize() , function(data) {

        		 $('.tableImport').html(data)
				 $('.saveImport').removeClass('disabled')
				 $(this).find('.ajaxLoader').addClass('hidden')

    		});




        },
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        return myXhr;
        }


       });



	})



	$('.color-container-edit').hide()

	$('.loading-page').fadeOut(500,'', function(){ $('.loading-page').remove()})


})

$(document).ready(function(){



	$('#cpf_responsavel').blur(function(){

		if($(this).val()==""  || $(this).val()=='___.___.___-__'){

			$('#cpf').addClass('required')


		}else{


			$('#cpf').removeClass('required')

		}

	})


	$('#cpf').blur(function(){

		if($(this).val()==""  || $(this).val()=='___.___.___-__'){





		}else{


			$('#cpf').removeClass('required')

		}

	})


	$('.delete').click(function(){

		$('.removeAction').attr('data-table', $(this).data('table'))

	})

	/*function getCountAlerts(){

		$.post(ajaxUrl+'ajax/getAlerTotal','', function(a){

			if(a==0){
			$('.alertCount').hide()
			$('.desc-count').html('Não existem novas notificações')

			}
		    else
			{
			$('.alertCount').html(a)
			$('.alertCount').show()
			$('.desc-count').html('Existe'+(a==1?'':'m')+' '+a+' Notifica'+(a==1?'ção':'ções'))

			}

		})

	}

	getCountAlerts()

	setInterval(function(){

			getCountAlerts()

	}, 60000)


	getCountAlerts()

	$('.getAlerts').click(function(){

		$.post(ajaxUrl+'ajax/getAlert','', function(a){


			$('.scroll-content ul').html(a)


		})


	})

	*/

	$('body').on('click', '.alertItem', function(a){

		_url = $(this).attr('href')
		a.preventDefault()

		$.post(ajaxUrl+'ajax/markAlert', {id: $(this).data('id')} , function(a){

			window.location=_url


		})


	})







	$('.markPay').click(function(){

		_container = $(this).parents('td')
		_id = $(this).data('id')


		$(this).replaceWith(' <i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>')


		$.post(controllerUrl+'confirmPayment', {id: _id}, function(){


			_container.find('span').addClass('label-success').removeClass('label-warning').html('<i class="ace-icon fa fa-check bigger-120"></i> Pago')
			_container.find('.fa-spinner').hide()

		})





	})

	al = $('.page-header').offset().top

	if(controllerUrl!=ajaxUrl+'video-aula/'){
	$(window).scroll(function(){

	console.log(al, $(window).scrollTop())

	if($(window).scrollTop()>al){

		$('.page-header').addClass('submit-float')
		$('.page-header').find('button').addClass('btn-xs')



	}
	else{


		$('.page-header').removeClass('submit-float')
		$('.page-header').find('button').removeClass('btn-xs')

	}

	})

	}

	$('.sorting input[type=text]').click(function(a){

		a.stopImmediatePropagation()


	})




	$('body').on('click', '.l-del', function(a){

		a.preventDefault()

		$target = $(this).parents('tr')

		$.post(controllerUrl+'/delSchedule', {id: $(this).attr('href')}, function(b){

			if(b=='success'){

				$target.fadeOut()
			}

		})


	})


	$('body').on('submit', '#afterLesson', function(a){

		a.preventDefault()

		$.post(controllerUrl+'/afterLesson', $(this).serialize(), function(b){

			if(b=='success'){

				$('.detail-row').removeClass('open')
			}

		})


	})

	$('.verifyRemessa').click(function(a){

		_url = $(this).attr('href')
		a.preventDefault()

		$.post(controllerUrl+'remessa', {consult : true}, function(a){

			console.log(a)

			if(a>0){

				window.location=_url

			}
			else
			{

				alert('Não existe boleto para ser registrado!')

			}

		})

	})

	$('.sendMail').click(function(){

		$('#sendMail').attr('data-id', $(this).attr('data-id'))

	})


	$('#sendMail').submit(function(a){

		$id = $(this).attr('data-id')

		$('.emailFeed').html('<i class="fa fa-clock-o blue"></i> Enviando...')
		$('.sendButton').attr('disabled', 'disabled')

		a.preventDefault()

		$.post(controllerUrl+'/sendMail', {id: $id, allStudents:  $(this).find('input[name=allStudents]:checked').val(), assunto: $(this).find('input[name=assunto]').val(), mensagem:  $('#summernote').summernote('code')}, function(b){

			if(b=='success'){




				$('.emailFeed').html('<i class="fa fa-check green"></i> E-mail enviado com sucesso!')
				$('#sendMail').find('input').val('')
				$('#summernote').summernote('reset')
				$('.sendButton').removeAttr('disabled')

			}
			if(b=='error'){

				$('.emailFeed').html('<i class="fa fa-times red"></i> Não foi possível enviar o e-mail!')

			}


		})

	})


	$('body').on('click','.cancel-schedule',function(){

	 $button = $(this)
	 $event = $(this).attr('data-eventId')
	 $type = $(this).attr('data-admin')



	 $.post(ajaxUrl+'/agendamento/cancelar-agendamento', {id: $(this).attr('data-id'), eventID: $(this).attr('data-eventid'), admin: $type}, function(b){

		  $button.attr('disabled', 'disabled')

		  if(b=='success'){

			  if($type){
			  $button.html('Desmarcado').removeClass('btn-info').addClass('btn-danger')
			  }
			  else
			  {
			  $('.schedule-feed').html('<i class="fa fa-check green"></i> Aula desmarcada com sucesso!')
			  $('#calendar1').fullCalendar('removeEvents', [$event])
			  $('#calendar2').fullCalendar('removeEvents', [$event])
			  }


		  }

		  else if(b=='hour'){

			  $('.schedule-feed').html('<i class="fa fa-times red"></i> O intervalo para cancelamento são de 4 horas!')


		  }

	 })


	})

	$('body').on('click','.edit-action',function(){

		content = $(this).parents('tr').find('span:first')
		values = $(this).parents('tr').find('.input-hide').val()
		color = $(this).parents('tr').find('.simple-colorpicker ').val()
		qtd = $(this).parents('tr').find('input[name=qtd]').val()

		if($(this).attr('data-status')=="edit"){
		$(this).removeClass('btn-info').addClass('btn-success').find('i').removeClass('fa-pencil').addClass('fa-check')
		$(this).parents('tr').find('span').hide()
		$(this).parents('tr').find('.input-hide, .btn-colorpicker').show()

		$(this).parents('tr').find('.color-content').hide()
		$(this).parents('tr').find('.color-container-edit').show()

		$(this).attr('data-status', 'update')
		}
		else
		{
		$(this).removeClass('btn-success').addClass('btn-info').find('i').removeClass('fa-check').addClass('fa-pencil')
		$(this).parents('tr').find('span').show()
		$(this).parents('tr').find('.input-hide').hide()


		$(this).parents('tr').find('.color-content').show().css({'background': $(this).parents('tr').find('.simple-colorpicker ').val()})
		$(this).parents('tr').find('.color-container-edit').hide()


		$(this).attr('data-status', 'edit')

		$(this).parents('tr').find('span.name').html($(this).parents('tr').find('.input-hide').val())
		$(this).parents('tr').find('span.qtd').html(qtd)

		  $.post(ajaxUrl+'/configuracoes/fast-edit', {action: $(this).attr('data-action'), id: $(this).attr('data-id'), nome: $(this).parents('tr').find('.input-hide').val(), cor: color, qtd: qtd}, function(b){

			  content.html(values)

			  if(qtd){



			  }

		  })

		}


	})


	$('body').on('click','.edit-action-student',function(){

		atividade = $(this).parents('tr').find('span').eq(0)
		comentarios = $(this).parents('tr').find('span').eq(1)
		nota = $(this).parents('tr').find('span').eq(2)

		color = $(this).parents('tr').find('.simple-colorpicker ').val()

		if($(this).attr('data-status')=="edit"){


		$(this).removeClass('btn-info').addClass('btn-success').find('i').removeClass('fa-pencil').addClass('fa-check')
		$(this).parents('tr').find('span').hide()
		$(this).parents('tr').find('.input-hide, .btn-colorpicker').show()

		$(this).parents('tr').find('.color-content').hide()
		$(this).parents('tr').find('.color-container-edit').show()

		$(this).attr('data-status', 'update')
		}
		else
		{


		$(this).removeClass('btn-success').addClass('btn-info').find('i').removeClass('fa-check').addClass('fa-pencil')
		$(this).parents('tr').find('span').show()
		$(this).parents('tr').find('.input-hide').hide()


		$(this).parents('tr').find('.color-content').show().css({'background': $(this).parents('tr').find('.simple-colorpicker ').val()})
		$(this).parents('tr').find('.color-container-edit').hide()


		$(this).attr('data-status', 'edit')

		//$(this).parents('tr').find('span').html($(this).parents('tr').find('.input-hide').val())

		   atividade.html($(this).parents('tr').find('.input-hide[name=atividade]').val())
		   comentarios.html($(this).parents('tr').find('.input-hide[name=comentarios]').val())
		   nota.html($(this).parents('tr').find('.input-hide[name=nota]').val())

		  $.post(ajaxUrl+'/configuracoes/fast-edit', {action: $(this).attr('data-action'), id: $(this).attr('data-id'), nome: $(this).parents('tr').find('.input-hide').val(), cor: color, atividade: $(this).parents('tr').find('.input-hide[name=atividade]').val(), comentario: $(this).parents('tr').find('.input-hide[name=comentarios]').val(), nota: $(this).parents('tr').find('.input-hide[name=nota]').val()}, function(b){

			  atividade.html($(this).parents('tr').find('.input-hide').val())
			  comentarios.html($(this).parents('tr').find('.input-hide').val())
			  nota.html($(this).parents('tr').find('.input-hide').val())

		  })

		}


	})






	$('body').on('click','.delete-action',function(){

		$obj = $(this).parents('tr')

		 $.post(ajaxUrl+'/configuracoes/fast-delete', {action: $(this).attr('data-action'), id: $(this).attr('data-id')}, function(b){

			  if(b){

				  $obj.fadeOut('500')

			  }


		  })

	})

	$('.prev-day').click(function(){

		$('.fc-prev-button').trigger('click')

	})

	$('.next-day').click(function(){

		$('.fc-next-button').trigger('click')


	})

	$('body').on('click','.datepicker-switch', function(){


		alert()

	})

	$('.filter.date-picker').blur(function(){

		setTimeout(function(){

			//$('.filterRegistry').trigger('click')

		},500)



	})


	$('.fake-form input[type=text]').keyup(function(e){

		if(e.keyCode == 13){

			$(this).parents('.fake-form').find('.action-add').trigger('click')

		}

	})

	$('.action-add').click(function(){



		$(this).parents('.fake-form').find('input[type=text], input[type=hidden]').css({'border-color':'#D5D5D5'})

		if($(this).parents('.fake-form').find('input[type=text], input[type=hidden]').val()){
		$t = $(this)


		var $data = {}


		$(this).parents('.fake-form').find('input[type=text], input[type=hidden]').each(function(){

			$data[$(this).attr('name')] = $(this).val();
			$data['cor'] = $('#simple-colorpicker-1').val();

		})

		$.post(controllerUrl+'/'+$(this).data('action'), $data, function(b){

			if(b!='error'){

				$t.parents('.fake-form').find('input[type=text]').val('')
				$t.parents('.widget-main').find('.feed-grid tbody').prepend(b)

			}

		})

		}
		else
		{

			$(this).parents('.fake-form').find('input[type=text], input[type=hidden]').css({'border-color':'#d15b47'})

		}

	})



	$('.quote').submit(function(a){


		a.preventDefault()


		if($(this).find('textarea[name=comentario]').val()){

			_form = $(this)
			$.post(ajaxUrl+'/os/quote', $(this).serialize(), function(b){

				_form.find('.pull-left.feed').html('<i class="ace-icon green fa fa-check"></i> Comentário adicionado')


			})

		}

	})


	$('#summernote').summernote({

	  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['picture', ['picture']]

    ],
	  height: 200,                 // set editor height
	  minHeight: null,             // set minimum height of editor
	  maxHeight: null,             // set maximum height of editor
	  lang: 'pt-BR',



		 callbacks: {
    onImageUpload: function(files, editor, editable) {


		var file = files[0];
         data = new FormData();
         data.append('file', file);
         $.ajax({
             data: data,
             type: 'POST',
             url: ajaxUrl+'/ajax/insertImage/?type=photo',
             cache: false,
             contentType: false,
             processData: false,
             success: function(url) {

				 console.log(editor)
                 //console.log(url, editor, editable);
                 //editor.insertImage(editable, url);
				 var imgNode = $('<img>').attr('src',url);
				 $('#summernote').summernote('insertNode',  imgNode[0]);
             }
         });

    }
  }

     /* onImageUpload: function(files, editor, editable) {

		  alert()

 	  var file = files[0];
         data = new FormData();
         data.append('file', file);
         $.ajax({
             data: data,
             type: 'POST',
             url: '/file-upload/?type=photo',
             cache: false,
             contentType: false,
             processData: false,
             success: function(url) {
                 console.log(url, editor, editable);
                 editor.insertImage(editable, url);
             }
         });

     }

	  }*/


	});



	$('.clearCondominium').click(function(a){

		a.preventDefault()
		$('.widget-condominios input').val('')


	})


	function sendFile(){


		alert()


	}


	$("#validateOS").submit(function(a){

		a.preventDefault()


		$(this).find('button[type=submit]').prop('disabled', true)
		$(this).find('button[type=submit]').find('i').removeClass('fa-check').addClass('fa-clock-o')

		_form = $(this)
		_button = $(this).find('button[type=submit]')


		$.post(ajaxUrl+'/os/validateOS', $(this).serialize(), function(b){

			_button.prop('disabled', false)
			_button.find('button[type=submit]').find('i').removeClass('fa-clock-o').addClass('fa-check')


			if(b=='success'){
			   $("#validateOS .feedback").html('<i class="fa fa-check" aria-hidden="true"></i> OS finalizada com sucesso!')


				   _form.find('input, textarea').val('')
				   //$('.close').trigger('click')



			}else{
			   $("#validateOS .feedback").html('<i class="fa fa-times" aria-hidden="true"></i> Não existe essa ordem de serviço cadastrada!')

			}

		})


	})

	$('#consultSO').submit(function(a){

		$form = $(this)
		a.preventDefault()

		$.post(ajaxUrl+'/os/fast-search', $(this).serialize(), function(b){

			if(b){

				window.location=ajaxUrl+'os/editar/'+$form.find('input[name=ID]').val()
			}
			else
			{

			$alert('Não existe essa ordem de serviço cadastrada!')

			}

		})

	})


	$(".filterRegistry").click(function(){

		$query = ''

		$('#dynamic-table thead input[type=text], #dynamic-table thead select').each(function(){

		  $query += $(this).attr('name')+'='+$(this).val()+'&'

		})

		window.location=controllerUrl+subController+'?'+$query.slice(0, -1)

	})


	$('#dynamic-table thead input[type=text]').keydown(function(e){

		if(e.keyCode == 13){

			$query = ''

		$('#dynamic-table thead input[type=text], #dynamic-table thead select').each(function(){

		  $query += $(this).attr('name')+'='+$(this).val()+'&'

		})

		window.location=controllerUrl+subController+'?'+$query.slice(0, -1)

		}

	})


	$('#dynamic-table thead select').change(function(){



			$query = ''

		$('#dynamic-table thead input[type=text], #dynamic-table thead select').each(function(){

		  $query += $(this).attr('name')+'='+$(this).val()+'&'

		})

		window.location=controllerUrl+subController+'?'+$query.slice(0, -1)



	})

	$('#getProductsCondominium').submit(function(a){

		a.preventDefault()

		$.post(ajaxUrl+'/condominios/get-products', $(this).serialize(), function(b){


			$('#produtos .content').append(b)
			$('.modal .close').trigger('click')

		})


	})


	$('body').on('click', '#modal-condominios .show-details-btn', function(a){

		a.preventDefault()

		$('#modal-condominios input[type=checkbox]').prop('checked', false);

		$('input[name=condominio_id]').val($(this).attr('href'))

		$(this).parents('tr').next().find('input[type=checkbox]').prop('checked', true);

	})

	$('.getCondominium').click(function(){


		$data = {
			  nome: $('input[name=condominum_nome]').val(),
			  endereco: $('input[name=condominum_endereco]').val(),
			  cep: $('input[name=condominum_cep]').val(),
			  data: $('input[name=condominum_data]').val()
		}



		$.ajax({

			type:'POST',
			url: ajaxUrl+'condominios/get-condominios',
			data: $data,
			//dataType: "json",
			success: function(a){


				$('#modal-condominios .modal-body').html(a)


			}

		})

	})


	$('#cpf').keyup(function(){

		if(onlyNumbers($(this).val()).length>=11){

		$cpf = TestaCPF(onlyNumbers($(this).val()))

		if($cpf){
		$('.feedCPF').html('<i class="fa fa-check green" aria-hidden="true"></i>')
		$('#cpf').attr('data-valid', true)
		}
		else{

		$('.feedCPF').html('<i class="fa fa-times red" aria-hidden="true"></i>')
		$('#cpf').attr('data-valid', false)
		}


		}


	})


	$('thead input[type=checkbox]').click(function(){

		if($(this).is(':checked')){

		$('input[type=checkbox]').prop('checked', true)

		}
		else
		{
		$('input[type=checkbox]').prop('checked', false)
		}

	})

	/* Liberar Campo */

	$('select').change(function(){


		$(this).next().find('input').val('').attr('disabled', 'disabled')

		if($(this).find('option:selected').attr('data-enable')){

			$(this).next().find('input').removeAttr('disabled').focus()

		}

	})


    $('.selectable').editableSelect();


	$('.submit-form').click(function(){

		$('#form').trigger('submit')

	})

	$('#form input[type=text]').keydown(function(e){



		if(e.keyCode == 13){
			e.preventDefault()
			$('#form').trigger('submit')

		}
	})

	function showMessage(a, b){

		if(a=='danger'){

			abm = 'Erro'
			_icon = '<i class="ace-icon fa fa-times"></i>'
		}
		else
		{
			abm = 'Sucesso'
			_icon = '<i class="ace-icon fa fa-check"></i>'
		}

		$('.alert-load img').hide()
		$('.alert').removeClass('alert-success').removeClass('alert-danger')
		$('.alert').addClass('alert-'+a).html(_icon+' '+b+'  <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>').fadeIn(300)

		$('.loader-msg').addClass('btn-'+a).html(_icon).fadeIn(300)

		setTimeout(function(){

		$('.alert.alert-danger').fadeOut(100).removeClass('alert-success').removeClass('alert-danger').html('')
		$('.loader-msg').fadeOut(100).removeClass('btn-success').removeClass('btn-danger').html('')

		},5000)


	}

	function blockForm(_form){


		$(_form+' button[type=submit]').attr('disabled', 'disabled').addClass('disable')

	}

	function unBlockForm(_form){

		$(_form+' button[type=submit]').removeAttr('disabled').removeClass('disable')

	}

	function clearForm(_form){

		$(_form+' input').val('')
		$(_form+' textarea').val('')
		$(_form+' select').val('')

	}


	$('#form input, #form select, #form textarea').focus(function(){

		$(this).css({'border-color':'#D5D5D5'})
	})

	files = '';
	path = ''

	$('input[name=file]').change(function(a){

		if($(this).val()){
		files = a.target.files;
		path = $(this).data('path')
		$(this).parents('.ace-file-input').find('.ace-file-name').attr('data-title', files[0].name)
		$(this).parents('.ace-file-input').find('.material').val(files[0].name)

		}




	})



	$('body').on('submit','#form, #formLote', function(a){



	if($('input[name=status]').val()==4 && $("[name='transacoes[adiar]']").val()!=$('input[name=adiar]').val()){

	   $('#modal-alert .modal-body').html('ESTA TRANSAÇAO ESTA DESATIVADA E NAO É POSSIVEL PRORROGAR A DATA OFF!')
			$('#modal-alert').modal('show');

		a.preventDefault();
		return

	}


	$(this).find('.dLoader .ajaxLoader').fadeIn()

	$f = $(this)

	$('.alert-load img').fadeIn()

	if(files){
	a.stopPropagation();
    a.preventDefault();

    var data = new FormData();

    $.each(files, function(key, value)
    {
        data.append(key, value);
    });



    $.ajax({
        url: ajaxUrl+'/ajax/upload/'+path+'/',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {

                submitForm(event, data);
            }
            else
            {

              console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {

            console.log('ERRORS: ' + textStatus);

        }
		});

	}



		_editor = ''


		_form = $(this).attr('id')

		//blockForm(_form)

		a.stopPropagation(); // Stop stuff happening
		a.preventDefault()

		$('#summernote').each(function(){

		//_editor += '&'+$('input[name=editor]').data('controller')+'['+$('input[name=editor]').data('real')+']='+encodeURIComponent($('#summernote').summernote('code'))

		_editor += 	'&'+$(this).data('controller')+'['+$(this).data('real')+']='+encodeURIComponent($(this).next().find('.note-editable').html())

		})



		$_i = 0

		if($('#aluno_email').length){

		if(IsEmail($('#aluno_email').val())==false){

			$('#aluno_email').css({'border-color':'#d15b47'})
			$_i = $_i+1

		}

		}

		$('.required').each(function(){

			if($(this).val()==''){

				if(ignoreRequired==false){
				$(this).css({'border-color':'#d15b47'})
				$_i = $_i+1
				}

			}


			if($('#cpf').length){



				if($('#cpf').attr('data-valid')=='false'){


					$('#cpf').css({'border-color':'#d15b47'})
					$_i = $_i+1



				}

			}

		})


		if($_i==0){


		$.post($(this).attr('action'), $(this).serialize()+_editor, function(a){

			console.log(a)

			if(a=='success'){



			showMessage('success', 'Registro adicionado com sucesso!')

			setTimeout(function(){

				window.location=controllerUrl+subController
				//javascript:history.back()

			},500)

			}

			else if(a=='success_update'){





			if($f.find('input[name=lote]').val()){


			$('#modal-import-lote .modal-body row').hide()


			}else{

			showMessage('success', 'Registro editado com sucesso!')

			setTimeout(function(){

				javascript:history.back()

			},500)

			}
			//unBlockForm(_form)



			}

			else if(a=='duplicate'){
			showMessage('danger', 'Esse código já está sendo utilizado!')
			unBlockForm(_form)

			}



			else if(a=='exists'){
			showMessage('danger', 'Já existe um registro com esse nome!')
			unBlockForm(_form)

			}

			else if(isJson(a)){

				a = JSON.parse(a)

				$('#modal-alert .modal-body').html(

					'<p>Algum SIMCARD OU MDN já existe em nosso cadastro!</p>'+a.registry


				)


				$('#modal-alert').modal('show');
				$('#modal-import-lote').modal('hide')
				 $("html, body").animate({scrollTop: 0}, 1000);

			}

			else
			{
			showMessage('danger', 'Houve um erro ao adicionar o registro')
			unBlockForm(_form)
			}


		})

		}
		else
		{
		showMessage('danger', 'Verifique os campos obrigatórios!')
		unBlockForm(_form)
		return false;
		}

	})

	/* Duplicate Field */

	$('body').on('click', '.add-more', function(){

		$(this).parents('.phone-area').clone().insertBefore($(this).parents('.phone-area'))
		$(this).parents('.phone-area:last').find('input, select').val('')
		$(this).parents('.phone-area').find('input[type=hidden]').remove()

	})

	$('body').on('click', '.remove-field', function(){



		if($(this).parents('.phone-area').children('.remove_field').length){

			$(this).parents('.phone-area').hide()
			$(this).parents('.phone-area').find('.remove_field').val($(this).parents('.phone-area').find('.field_id').val())

		}
		else
		{
		$(this).parents('.phone-area').remove()
		}


	})

	function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

	$('.search-by').click(function(){



		$.ajax({

			type:'POST',
			url: ajaxUrl+'clientes/getInfo',
			data: 'type='+$(this).prev().data('type')+'&value='+$(this).prev().val(),
			dataType: "json",
			success: function(a){


				if(a){
				$('#nome').val(a[0].nome)
				$('#cpf').val(a[0].cpf)
				$('#email').val(a[0].email)
				$('#cep').val(a[0].cep)
				$('#endereco').val(a[0].endereco)
				$('#numero').val(a[0].numero)
				$('#ap').val(a[0].ap)
				$('#bloco').val(a[0].bloco)
				$('#complemento').val(a[0].complemento)
				$('#bairro').val(a[0].bairro)
				$('#cidade').val(a[0].cidade)
				$('#estado').val(a[0].estado)
				$('#condominio').val(a[0].condominio)


				$('.client_id').val(a[0].ID)
				}

			}

		})




	})


	$('#estado').change(function(){


		$.ajax({

			type:'POST',
			url: ajaxUrl+'ajax/getCity',
			data: 'city='+$(this).val(),
			success: function(a){

				$('#cidade').html(a)

			}


		})







	})



	$('.zipConsult').click(function(){



		$.ajax({

			type:'POST',
			url: ajaxUrl+'ajax/zipConsult',
			data: 'zip='+$(this).prev().val().replace('-', ''),
			dataType:"json",
			success: function(a){


				$('#endereco').val(a.logradouro)
				$('#bairro').val(a.bairro)
				$('#estado').val(a.uf)
				$('#cidade').val(a.localidade)






			}


		})




	})

	$('.action-button').click(function(a){


		$self = $(this)
		$action = $(this).data('action')
		$refresh = $(this).data('refresh')
		$id = $(this).data('id')
		$(this).attr('disabled', 'disabled')
		$(this).html('<i class="ace-icon fa fa-clock-o bigger-110" aria-hidden="true"></i>')



		$.post(ajaxUrl+$(this).data('url'), {id: $(this).data('id')}, function(a){


			switch($action){

				case"sendEmailBuget":

				   $self.html('<i class="ace-icon fa fa-check bigger-110" aria-hidden="true"></i>')

				break;

				case"changeType":

				  window.location=ajaxUrl+'os/editar/'+$id

				break;

				case"changeStatus":

				 console.log(a)

				  /*if($refresh){

					  $('.'+$refresh).html('<span class="label label-sm label-success">Finalizada</span>')

				  }*/

				break;

				case"repairOrder":
					alert()
				break;

			}


		})


	})

	/*  Delete  */

	$('.removeAction').click(function(){

		$ids =''

		$($('.item_id:checked')).each(function(){

			$ids += $(this).val()+','


		})


		$.post(ajaxUrl+controller+'/delRegistry', {ids: $ids.slice(0, -1), 'table': $(this).data('table')}, function(a){




			if(a=='alert1'){

				$('#modal-alert .modal-body').html('Esse registro não pode ser excluído pois está relacionada com outro item')
				$('#modal-alert').modal('show');

			}
			else{

				window.location.reload()

			}


		})


	})

	/* Remove Filters */



	$('.clear-filters').click(function(){

		$('#dynamic-table thead').find('input, select').val('')


	})



	$('#new-attribute').submit(function(a){

				a.preventDefault();

				_ids = $(this).serialize()

				$.post(ajaxUrl+'/orcamentos/product-widget', _ids, function(b){

					$('#produtos .content').append(b)
					$('.close').trigger('click')
					$('#new-attribute input').removeAttr('checked')
					$('.money').maskMoney({thousands:'.', decimal:','})



				})

			})


			$('.multiselect').multiselect({
				 enableFiltering: false,
				 enableHTML: false,
				 buttonClass: 'btn btn-white btn-primary col-lg-12',
				 templates: {
					button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
					ul: '<ul class="multiselect-container dropdown-menu"></ul>',
					filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
					filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
					li: '<li><a tabindex="0"><label></label></a></li>',
			        divider: '<li class="multiselect-item divider"></li>',
			        liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
				 }
				});


			$('body').on('click', '.widget-toolbar a[data-action=duplicate]', function(){


				$(this).parents('.widget-box-internal').clone().appendTo($(this).parents('.widget-root .widget-main'))
				$('.widget-root .widget-main .widget-box-internal:last').find('input[class!="default_value"]').val('')
				$('.widget-root .widget-main .widget-box-internal:last input:first').focus()
				$('.widget-root .widget-main .widget-box-internal:last input').val('')
				$('.widget-root .widget-main .widget-box-internal:last input').each(function(){

				$(this).val($(this).data('default'))

				})

				$('.money').maskMoney({thousands:'.', decimal:','})
			})



			$('.desconto').blur(function(){


				if($(this).val()){

				_valor = ($('.valor_total').val().replace(',','').replace('.','')/100)*onlyNumbers($(this).val())
				$('.valor_desconto').val(formatReal(Math.round10(_valor)))


				$total = parseInt('0.00');
				$total2 = parseInt('0.00');
				$total3 = parseInt('0.00');

				$('.valor').each(function(){

					if($(this).val()){
					$total +=  (parseInt($(this).val().replace(',','').replace('.','')))-_valor
					$total2 += (parseInt($(this).val().replace(',','').replace('.',''))/2)-_valor
					$total3 += (parseInt($(this).val().replace(',','').replace('.',''))/3)-_valor
					}
				})



				$('.valor_total').val(formatReal($total))
				$('.valor_2').val(formatReal(Math.round10($total2)))
				$('.valor_3').val(formatReal(Math.round10($total3)))
				$('.valor_1').val(formatReal($total))

				}


			})





			function formatReal( int )
{
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
}

(function(){

	/**
	 * Decimal adjustment of a number.
	 *
	 * @param	{String}	type	The type of adjustment.
	 * @param	{Number}	value	The number.
	 * @param	{Integer}	exp		The exponent (the 10 logarithm of the adjustment base).
	 * @returns	{Number}			The adjusted value.
	 */
	function decimalAdjust(type, value, exp) {
		// If the exp is undefined or zero...
		if (typeof exp === 'undefined' || +exp === 0) {
			return Math[type](value);
		}
		value = +value;
		exp = +exp;
		// If the value is not a number or the exp is not an integer...
		if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
			return NaN;
		}
		// Shift
		value = value.toString().split('e');
		value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
		// Shift back
		value = value.toString().split('e');
		return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
	}

	// Decimal round
	if (!Math.round10) {
		Math.round10 = function(value, exp) {
			return decimalAdjust('round', value, exp);
		};
	}
	// Decimal floor
	if (!Math.floor10) {
		Math.floor10 = function(value, exp) {
			return decimalAdjust('floor', value, exp);
		};
	}
	// Decimal ceil
	if (!Math.ceil10) {
		Math.ceil10 = function(value, exp) {
			return decimalAdjust('ceil', value, exp);
		};
	}

})();


function TestaCPF(strCPF) {

    var Soma;
    var Resto;

    Soma = 0;
	if (strCPF == "00000000000") return false;

	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;

}


function onlyNumbers(string)
{
    var numsStr = string.replace(/[^0-9]/g,'');
    return numsStr;
}


function formatReal( int )
{
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
}






})


function formatDate($date){

	$date = $date.split('-');
	return $date[2]+''+$date[1]+''+$date[0]


}




function IsEmail(email){


    var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    var check=/@[\w\-]+\./;
    var checkend=/\.[a-zA-Z]{2,3}$/;
    if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
    else {return true;}
}


function checkSession(){


	setInterval(function(){

		$.post(ajaxUrl+'/ajax/CheckSession','', function(a){

		if(a!=1){

			window.location=ajaxUrl+"login/?expired=true"

         }




		})


	},36000)

}
