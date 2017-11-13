@extends('layouts.admin.adminlayout')
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			                <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
							<li><a href="{{URL_QUIZ_QUESTIONBANK}}">{{ getPhrase('question_subjects') }}</a></li>
							<li><a href="{{URL_QUESTIONBANK_VIEW.$subject->slug}}">{{ $subject->subject_title }}</a></li>
							<li>{{ $title }}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<?php $settings = ($record) ? $settings : ''; ?>

				<div class="row" ng-init="initAngData('{{ $settings }}');"
				 ng-controller="questionsController">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
				<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_QUESTIONBANK_EDIT.'/'.$record->slug, 
						'method'=>'patch', 'files' => TRUE, 'name'=>'formQuestionBank ', 'novalidate'=>'')) }}
					@else
						{!! Form::open(array('url' => URL_QUESTIONBANK_ADD, 'method' => 'POST', 'files' => TRUE, 'name'=>'formQuestionBank ', 'novalidate'=>'')) !!}
					@endif

					 @include('exams.questionbank.form_elements', 
					 array('button_name'=> $button_name),
					 array('topics' => $topics, 'subject' => $subject, 'record'=>$record))
					 
					{!! Form::close() !!}
					 

                    </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">{{getPhrase('edit_question')}}</h4>
      </div>
	  
	   {!!Form::open(array('url'=> URL_QUESTIONBANK_DELETE_QUESTIONFILE,'method'=>'POST','name'=>'userstatus'))!!} 
	   
      <div class="modal-body">
      <span id="message"></span>
         
          <h4 style="color:#44a1ef;text-align: center;">{{getPhrase('are_you_sure_to_make_clear_image')}}</h4 >

        <input type="hidden" name="question_file" id="qfile" >
        <input type="hidden" name="question_id" id="qid" >

      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" >Yes</button>
      </div>
	  
      {!!Form::close()!!}
    </div>

  </div>
</div>
    </div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
	@include('exams.questionbank.scripts.js-scripts')
	@include('common.validations', array('isLoaded'=>TRUE))
	@include('common.editor')
	@if($record)
		@if($record->question_type=='video')
			@include('common.video-scripts')
	 	@endif
	@endif

	 <script >
 	 
 		function deleteQuestionImage(question_file, question_id)
 		{    
			var qf = question_file;
			var qi = question_id;
			$('#qfile').val(qf);
 			$('#qid').val(qi);
 			$('#myModal').modal('show');
 		}
</script>
@stop