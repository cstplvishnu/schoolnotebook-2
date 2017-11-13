@extends($layout)
@section('content')
      
				<!-- Page Heading -->
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
			      <li><a href="{{URL_FEE_CATEGORIES}}">{{getPhrase('fee_categories')}} </a></li>
			      <li>{{$title}}</li>
			    </ul>
					@include('errors.errors')
				<!-- /.row -->
				
				<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default" ng-controller="academic_controller">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
					<?php $button_name = getPhrase('save'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('save'); ?>
						{{ Form::model($record, 
						array('url' => URL_FEE_CATEGORIES_EDIT.$record->slug, 
						'method'=>'patch','name'=>'FromFeeCategories')) }}
					@else
						{!! Form::open(array('url' => URL_FEE_CATEGORIES_ADD, 'method' => 'POST','name'=>'FromFeeCategories')) !!}
					@endif

					 @include('fee.feecategories.form_elements', array('button_name'=> $button_name,'record'=>$record))
					 
					{!! Form::close() !!}

                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
		<!-- /#page-wrapper -->
@stop

@section('footer_scripts')
 @include('fee.feecategories.scripts.category-scripts')


@stop
 
 