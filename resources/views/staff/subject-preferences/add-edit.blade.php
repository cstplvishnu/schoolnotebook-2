@extends($layout)

@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet">
@stop


@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
       <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
        <li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>
    

        
          @include('errors.errors')

    <div class="row" ng-controller="academicCourses" ng-init="ingAngData({{$items}})">


       <?php $button_name = getPhrase('create'); ?>
          
           <?php $button_name = getPhrase('update'); ?>
             {{ Form::model($record, 
            array('url' => URL_STAFF_SUBJECT_PREFERENCES.$record->slug, 
            'method'=>'post')) }}
          

        <div class="col-sm-8">
          <section class="panel panel-default">
                <header class="panel-heading clear"><strong>{{getPhrase('preferred_subjects')}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           
               <section class="panel panel-default col-md-8">
              
               
            <section class='containerVertical' id="target"  ng-drop="true" ng-drop-success="onDropComplete($data,$event)" data-height="500px">

                    
           <div ng-if="!target_items.length" class="subject-placeholder">{{getPhrase('drag_and_drop_here')}}</div>
              <div ng-repeat="item in target_items" class="items-sub" id="target_items-@{{item.id}}">@{{item.subject_title}}
              <input type="hidden" name="selected_list[]" data-myname="@{{item.subject_title}}" value="@{{item.id}}">
              <div class="buttons-right">
                
              <i class="fa fa-trash text-danger pull-right" ng-click="removeItem(item, target_items, 'target_items')"></i>

              <i ng-if="item.is_lab==1" class="fa fa-flask pull-right text-primary" title="{{getPhrase('lab')}}" aria-hidden="true"></i> 
           
             <i ng-if="item.is_elective_type==1" class="fa fa-hand-o-up pull-right text-info" title="{{getPhrase('elective')}}" aria-hidden="true"></i>
             
              </div>


              </div>

          
            </section>

             
                    
                  </section>

                  <div class="col-md-4 instruction">
                    <h4 class="font-bold m-b-n-lg">{{ getPhrase('summary') }}</h4>
                        <ul class="guide">
                            <li class="m-b-n-md">
                                <span class="answer">
                                    <i class="fa fa-book">
                                    </i>
                                </span>
                                {{getPhrase('subjects')}} &nbsp; @{{target_items_subjects}}
                            </li>
                            <li class="m-b-n-md">
                                <span class="notanswer">
                                    <i class="fa fa-flask">
                                    </i>
                                </span>
                                {{getPhrase('labs')}} &nbsp; @{{target_items_labs}}
                            </li>
                            <li class="m-b-n-md">
                                <span class="marked">
                                    <i class="fa fa-hand-o-up"></i>
                                </span>
                                {{getPhrase('electives')}} &nbsp; @{{target_items_electives}}
                            </li>
                        </ul>
                    </div>
                       </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <div class="doc-buttons pull-right"> 
                                        
                                       <a class="btn btn-default" href="{{PREFIX}}">{{getPhrase('cancel')}}</a>
                                       <button class="btn btn-success">{{getPhrase('save')}}</button>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-sm-4">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('subjects')}}</header>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                       <div class="m-t-xs m-b-xs">
                                          <div class="input-group search datagrid-search">

                                            <input type="text" class="input-sm form-control" name="search" ng-model="search" placeholder="{{getPhrase('search')}}" />

                                            <div class="input-group-btn">
                                              <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                                            </div>
                                          </div>
                                        </div>
                                        
        <section class="scrollable" style="overflow: scroll;height: 450px">

          <div class="m-t m-b-xs" id="source">

       <div class="draggable-item-list" id="source">
          <div ng-repeat="item in source_items | filter:search track by $index" class="items-sub"
          ng-drag="true" ng-drag-data="item" ng-drag-success="onDragComplete($data,$event)"   
          >@{{item.subject_title}}
          
          
          <i ng-if="item.is_lab==1" class="fa fa-flask pull-right text-primary" title="{{getPhrase('lab')}}" aria-hidden="true"></i> 
          
          <i ng-if="item.is_elective_type==1" class="fa fa-hand-pointer-o pull-right text-info" title="{{getPhrase('elective')}}" aria-hidden="true"></i>
          
          <input type="hidden" data-myname="@{{item.subject_title}}"  value="@{{item.id}}">
          
          </div>
        </div>
        <p>&nbsp;&nbsp;</p>
        <i class="fa fa-flask text-primary" title="{{getPhrase('lab')}}" aria-hidden="true"></i> &nbsp;&nbsp;{{getPhrase('lab')}}
        &nbsp;&nbsp;
        <i class="fa fa-hand-pointer-o text-info" title="{{getPhrase('elective')}}" aria-hidden="true"></i>&nbsp;&nbsp;
        {{getPhrase('elective')}}

        </div>
                                         
                                          
                                          
                                        </section>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        {!! Form::close() !!}
    </div>        
        <!-- /.row -->
        
      

  
@stop



@section('footer_scripts')
@include('staff.subject-preferences.scripts.js-scripts')
@include('common.alertify')
 @stop