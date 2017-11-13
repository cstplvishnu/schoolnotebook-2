@extends($layout)

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
  <li><a href="{{URL_FEE_CATEGORIES}}">{{getPhrase('fee_categories')}} </a></li>
  <li>{{$title}}</li>
			    </ul>
          <div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default" ng-controller="schedule_controller">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="panel panel-custom">
					
					<div class="panel-body">
					<?php $button_name = getPhrase('create'); ?>
					
						{!! Form::open(array('url' => URL_FEE_CATEGORIES_SHEDULES_ADD, 'method' => 'POST','name'=>'formSchedule', 'novalidate'=>'')) !!}

					 @include('fee.schedules.schedule-form-elements', array('button_name'=> $button_name,'feecategory'=>$feeCategory,'records'=>$records))
					 
					{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>


	  	<div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header modal-header ss-border-no" style="background:#f8fafb">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="font-bold modal-title text-center">{{getPhrase('delete_schedules')}}</h4>
                                  </div>

                                   {!!Form::open(array('url'=> URL_FEE_DELETE_FEESCHEDULES,'method'=>'POST','name'=>'deleteschedules'))!!} 

                                  <div class="modal-body">
                                  <span id="message"></span>

                                      <h4 class="font-normal text-center text-info ss-fonts">{{getPhrase('are_you_sure_to_delete_schedules')}}</h4>

                                    <input type="hidden" name="feecategory_id" id="feecategory_id" >

                                  </div>

                                  <div class="modal-footer modal-header ss-border-no">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary" >Yes</button>
                                  </div>

                                  {!!Form::close()!!}
                                </div>

                              </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')

@include('fee.schedules.scripts.schedule-scripts')

 <script >
 	 
 		function deleteSchedule(feecat_id)
 		{    
			var ci = feecat_id;
			$('#feecategory_id').val(ci);
			
 			$('#myModal').modal('show');
 		}
</script>
 @stop