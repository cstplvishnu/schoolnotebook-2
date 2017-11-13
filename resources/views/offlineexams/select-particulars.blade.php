@extends($layout)

@section('content')

    <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
                  <li><a href="{{URL_OFFLINE_EXAMS}}">{{getPhrase('offline_exmas')}} </a></li>
                  <li>{{getPhrase('select_class')}}</li>
                </ul>

            <div class="row" ng-controller="academicAttendance">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$examtitle}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">



                <div class="row">
                
                     {!! Form::open(array('url' => URL_OFFLINE_EXAMS_ADD, 'method' => 'POST')) !!}
                     
                   
                  <div class ="col-md-6 col-sm-offset-3">

                        <fieldset class="form-group col-md-12">
                        {{ Form::label('select_subject', getphrase('select_class')) }}
                        
                        <span class="text-danger">*</span>

                        {{Form::select('quiz_applicability_id',$quizzes,  null, 
                        [   'class'     => 'form-control',
                            
                            'id'        =>'select_academic_year'
                           
                        ])}}
                        </fieldset>
                </div>

                </div>
                
                               <div class="text-center">
                                    <button type="submit" class="btn btn-info">
                                        {{getPhrase('add_marks')}}
                                    </button>
                                </div>
                            
                        
                        {!! Form::close() !!}
                    
                </hr>

                       </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
 
 

