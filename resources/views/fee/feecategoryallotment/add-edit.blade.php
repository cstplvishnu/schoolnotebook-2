@extends($layout)

@section('header_scripts')
<link href="{{CSS}}animate.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{CSS}}select2.css">

@stop


@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
       <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
     <li> <a href="{{URL_FEE_CATEGORIES}}"> {{getPhrase('fee_categories')}}</a></li>
    <li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>
    

        
          @include('errors.errors')

    <div class="row" ng-controller="academicCourses" ng-init="ingAngData({{$items}})">


       <?php $button_name = getPhrase('create'); ?>
          
           <?php $button_name = getPhrase('update'); ?>

           {{ Form::model($record, 
            array('url' => URL_ADD_FEE_PARTICULARS_TO_CATEGORY.$record->slug, 
            'method'=>'post')) }}

          <input type="hidden" name="feecategories[]" value="{{$record->id}}">
          <input type="hidden" name="feecategory" value="{{$record->id}}">

        <div class="col-sm-9">
          <section class="panel panel-default">
                <header class="panel-heading clear"><strong>{{$title}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           
              
                    <section class='containerVertical' id="target"  ng-drop="true" ng-drop-success="onDropComplete($data,$event)" data-height="500px">

                    
              <div ng-if="!target_items.length" class="subject-placeholder"> {{getPhrase('drag_and_drop_here')}}</div>
             
              <div ng-repeat="item in target_items"  id="target_items-@{{item.id}}">
              
                  
                  
                  
                  <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th width="250px"></th>
                        <th width="200px"></th>
                        <th></th>
                        <th width="20px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <lable class="items-sub no-pad-right">
                         <span class="font-normal ss-fontf"> @{{item.title}}</span>
                    </lable>  
                        </td>
                        <td>
                           <input type="hidden" name="selected_list[]" data-myname="@{{item.title}}" value="@{{item.id}}">
                          <input type="number" name="amount[]" data-myname="@{{item.title}}"   value="@{{item.amount}}" min="0">
                         </td>
                        <td>
                          <input ng-if="item.is_term_applicable != 1 && item.is_term_applicable != 0" type="checkbox" name="is_term[]" id="is_term_@{{item.id}}" checked value="@{{item.id}}">
        
        
                  <input ng-if="item.is_term_applicable==1" type="checkbox" name="is_term[]" id="is_term_@{{item.id}}" checked value="@{{item.id}}">
          
                  <input ng-if="item.is_term_applicable==0" type="checkbox" name="is_term[]" id="is_term_@{{item.id}}" value="@{{item.id}}" >
                           <label for="is_term_@{{item.id}}" class="ss-fontf m-l-n"> <span class="fa-stack checkbox-button"> <i class="mdi mdi-check active"></i> </span> Is Term </label>
                        </td>
                        <td>
                             <i class="fa fa-trash text-danger" ng-click="removeItem(item, target_items, 'target_items')"></i>  
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
           </div>
     </section>
                    

   @if(count($fee_categories))  
   <fieldset class="form-group">
   <div class="row m-t">
     <div class="col-md-12">
     {!! Form::label('Add FeeCategories', 'Add FeeCategories', ['class' => 'control-label']) !!}
       </div>
       <div class="col-md-3">
     {{Form::select('feecategories[]', $fee_categories, null, ['class'=>'form-control select2', 'name'=>'feecategories[]', 'multiple'=>'true'])}}
       </div>
   </div>        
    </fieldset>
    @endif

            </div>

              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <div class="col-md-12 clear">
                              <div class="doc-buttons pull-right"> 
                              
                           <a href="{{URL_FEE_CATEGORIES}}" class="btn btn-default">{{getPhrase('cancel')}}</a> 
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

        <div class="col-sm-3">
            <section class="panel panel-default clear">
                <header class="panel-heading font-bold">{{getPhrase('fee_particulars')}}</header>

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
                                        
        <section class="scrollable">

          <div class="m-t m-b-xs" id="source">
          
          <div ng-repeat="item in source_items | filter:search track by $index" class="btn ss-left-text"
          ng-drag="true" ng-drag-data="item" ng-drag-success="onDragComplete($data,$event)"   
          ><span> <i class="fa fa-bars pull-left"></i> </span>@{{item.title}}
        
          
          <input type="hidden" data-myname="@{{item.title}}"  value="@{{item.id}}">
          
          </div>
       
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
@include('fee.feecategoryallotment.scripts.js-scripts')
@include('common.alertify')
<script src="{{JS}}select2.js"></script>
    
    <script>
      $('.select2').select2({
       placeholder: "Add Fee Category",
    });
    </script>
 @stop