
	<?php $ids=[];?>
	@for($i=0; $i<count($chart_data); $i++)
	<?php 
	$newid = 'myChart'.$i;
	$ids[] = $newid; ?>
	
	<div class="panel-body ss-pie-chart">
		<div class="row">
			<div>
				<canvas id="{{$newid}}" width="100" height="160"></canvas>
			</div>
		</div>
	</div>

	@endfor
	 
