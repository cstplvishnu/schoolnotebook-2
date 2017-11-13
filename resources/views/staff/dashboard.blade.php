@extends($layout)


@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
    <li><strong>{{getPhrase('dashboard')}}</strong></li>
</ul>

<section class="panel panel-default ss-panel-bg">
    <div class="row m-l-none m-r-none bg-light lter">

        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
          <i class="fa fa-circle fa-stack-2x text-info"></i>
          <i class="fa fa-users fa-stack-1x text-white"></i>
        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_LESSION_PLANS_STUDENTLIST_DASHBOARD.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('students')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-success"></i>
                      <i class="fa fa-paper-plane-o fa-stack-1x text-white"></i>
                     <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_LESSION_PLANS_DASHBOARD.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('lesson_plans')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span></span>
            <a class="clear" href="{{URL_STUDENT_ATTENDENCE.Auth::user()->slug}}"> <span class="h4 block m-t-xs"><strong id="firers">{{ getPhrase('attendance') }}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-primary"></i>
                      <i class="fa fa-calendar fa-stack-1x text-white"></i>
                   <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update=""></span> </span>
            <a class="clear" href="{{URL_TIMETABLE_STAFF_STUDENT_PRINT.Auth::user()->slug}}" target="_blank"> <span class="h4 block m-t-xs"><strong>{{ getPhrase('timetable')}}</strong></span> <small class="text-muted text-uc"></small> </a>
        </div>
    </div>
    
</section>


			    
		 
			<!-- /.container-fluid -->
       <div class="row">
				<div class="col-md-12">
  				 <section class="panel panel-default">
				    <div class="panel-heading font-bold"><i class="fa fa-book"></i> {{getPhrase('library_history')}}</div>
				    <div class="panel-body table-responsive" style="overflow-x:initial;" >
				    	<?php 
				    	$records = App\LibraryIssue::issueHistory('',5);
				    	?>

				    	<table class="table table-striped datatable ">
				    		<thead>
				    			<tr>
				    				<th>
				    				<strong>{{getPhrase('sno')}}</strong></th>
				    				<th><strong>{{getPhrase('title')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('number')}}</th>
				    				<th><strong>{{getPhrase('issued')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('status')}}
				    				</strong></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    		<?php $sno=1;?>
				    		@if(count($records))
				    		@foreach($records as $record)
				    		<?php $class = 'label label-success';
				    		if($record->issue_type=='issue' || $record->issue_type=='renewal')
				    			$class = 'label label-default';
				    		if($record->issue_type=='lost')
				    			$class = 'label label-warning';
				    		?>
				    			<tr>
				    				<td>{{$sno++}}</td>
				    				<td><strong>{{$record->title}}</strong></td>
				    				<td>{{$record->library_asset_no}}</td>
				    				<td>{{date('Y-m-d',strtotime($record->issued_on))}}</td>
				    				<td><span class='{{$class}}' >{{ ucfirst($record->issue_type)}}ed</span></td>
				    			</tr>
				    		@endforeach
				    		@else
				    		<tr>
				    				<td>{{getPhrase('no_data_available')}}</td>
				    		</tr>
				    		@endif
				    		</tbody>
				    	</table>
				    </div>
				  </section>
				</div>

				<div class="col-md-12">
  				 <section class="panel panel-default">
				    <div class="panel-heading font-bold"><i class="fa  fa-bell"></i> {{getPhrase("today's_classes")}}</div>
				     <div class="panel-body table-responsive" style="overflow-x:initial;" >
				    	<?php 
				    	$records = App\Timetable::getDayClasses();
				    	 ?>
				    	<table class="table table-striped datatable ">
				    		<thead>
				    			<tr>
				    				<th>
				    				<strong>{{getPhrase('sno')}}</strong></th>
				    				<th><strong>{{getPhrase('subject')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('class')}}</th>
				    				<th><strong>{{getPhrase('from')}}
				    				</strong></th>
				    				<th><strong>{{getPhrase('to')}}
				    				</strong></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    		<?php $sno=1;?>
				    		@if(count($records))
				    		@foreach($records as $record)
		 
				    			<tr>
				    				<td>{{$sno++}}</td>
				    				<td><strong>{{$record->subject_title}}</strong></td>
				    				<td>{{$record->course_title}}</td>
				    				<td>{{$record->start_time}}</td>
				    				<td>{{ $record->end_time}}</td>
				    			</tr>
				    		@endforeach
				    		@else
				    		<tr>
				    				<td>{{getPhrase('no_data_available')}}</td>
				    		</tr>
				    		@endif
				    		</tbody>
				    	</table>

				    </div>
				  </section>
				</div>
			 
	</section>

@stop

