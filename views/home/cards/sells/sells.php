<div id="monthly-budget-content" style="min-height: 300px"></div>

<script src="<?=HOME_URI?>views/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?=HOME_URI?>views/assets/js/jquery.flot.js"></script>

<script src="<?=HOME_URI?>views/assets/js/jquery.flot.tooltip.min.js"></script>
<script src="<?=HOME_URI?>views/assets/js/jquery.flot.resize.js"></script>
<script src="<?=HOME_URI?>views/assets/js/jquery.flot.time.js"></script>
<script src="<?=HOME_URI?>views/assets/js/curvedLines.js"></script>
<script>
	$(function() {
		
		
		
		
		var hours = [
		<?
		$a=0;
		foreach($model->reportSells('', $_POST[range]) as $sell):
			
			$data .= '['.$a.', "'.$sell[hora].'"],';
			
			
		$a++;	
			
		endforeach;
			
		echo $data;
		?>
		
		]
		
		var hour_2 = [
		<?
		$a=0;
			
		$query_sells = $model->reportSells('', $_POST[range]);
			
		foreach($query_sells as $sell):
			
			$data2 .= '['.$a.', "'.$sell[qty].'"],';
			
			
		$a++;	
			
		endforeach;
			
		echo $data2;
		?>
		
		]
		
		var canceled = [
		<?
		$a=0;
			
		$query_canceled = $model->reportSells('canceled', $_POST[range]);	
		foreach($query_canceled as $sell):
			
			$data3 .= '['.$a.', "'.$sell[qty].'"],';
			
			
		$a++;	
			
		endforeach;
			
		echo $data3;
		?>
		
		]
		
		var extended = [
		<?
		$a=0;
			
		$query_extended = $model->reportSells('extended', $_POST[range]);
			
		foreach($query_extended as $sell):
			
			$data4 .= '['.$a.', "'.$sell[qty].'"],';
			
			
		$a++;	
			
		endforeach;
			
		echo $data4;
		?>
		
		]
		
		

		$.plot($("#monthly-budget-content"), [
			
			<?
			if($_POST[tipo]=='todas' || $_POST[tipo]=='transacoes'):
			?>
			{
			data: hour_2,
			label: "Transações: <strong><?=($query_sells[0][total]?$query_sells[0][total]:'0')?></strong>",
			points: {
				show: false
			},
			curvedLines: {
				apply: true
			},
			lines: {
				fill: true,
				color: '#000000'
			}
		    },
			
			<? endif; ?>
		    
			<?
			if($_POST[tipo]=='todas' || $_POST[tipo]=='canceladas'):
			?>
			{
			data: canceled,
			label: "Canceladas: <strong><?=($query_canceled[0][total]?$query_canceled[0][total]:'0')?></strong>",
			points: {
				show: false
			},
			curvedLines: {
				apply: true
			},
			lines: {
				fill: true
			}
		    },
			<? endif; ?>
			
			
			<?
			if($_POST[tipo]=='todas' || $_POST[tipo]=='prorrogadas'):
			?>
		    {
			data: extended,
			label: "Prorrogadas: <strong><?=($query_extended[0][total]?$query_extended[0][total]:'0')?></strong>",
			points: {
				show: false
			},
			curvedLines: {
				apply: true
			},
			lines: {
				fill: true
			}
		    }
			<? endif; ?>
			
		]
			   
			   , {
			series: {
				bars: {
					show: true,
					barWidth: 0.6,
					align: "center"
				},
				/*curvedLines: {
					apply: true,
					monotonicFit: true,
					active: true
				},
				points: {
					show: true,
					lineWidth: 2,
					fill: true,
					fillColor: "#ffffff",
					symbol: "circle",
					radius: 5
				},*/
				shadowSize: 0
			},
			grid: {
				hoverable: true,
				clickable: true,
				tickColor: "#e5ebf8",
				borderWidth: 1,
				borderColor: "#e5ebf8"
			},
			//tooltip: true,
			tooltipOpts: {
				defaultTheme: false
			},
			xaxis: {
				
				ticks: hours
			},
			yaxes: [{}, {
				
				position: "right" /* left or right */
			}]
		});
	});
</script>