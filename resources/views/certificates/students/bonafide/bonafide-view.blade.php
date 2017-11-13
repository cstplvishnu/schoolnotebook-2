@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
        <li class="active">{{isset($title) ? $title : ''}}</li>
    </ul>


@include('errors.errors')
      <div class="row" ng-controller="TabController">
         <div class="col-sm-8" >

           <section class="panel panel-default">

                <header class="panel-heading clear"><strong>{{$title}}</strong></header>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel-body">
                           
                           <div class="row">

                             <fieldset class="form-group col-md-6">

                        {{ Form::label('type', getphrase('certificate_type')) }}

                        <select name="certificate_type" id="certificate_type" class="form-control" ng-change="certificateTypeChanged(selected_certificate_type)" ng-model="selected_certificate_type">
                            <option value="bonafide">Bonafide</option>
                            <option value="tc">TC</option>
                        </select>

                        </fieldset>

                             <fieldset class="form-group  col-md-6">

                        {{ Form::label ('search', getphrase('search')) }}

                           <input type="text" class="form-control" name="search" id="enter-details" ng-model="search" placeholder="{{'search'}}" ng-change="textChanged(search)">

                        </fieldset>

                           
                           <div class="col-md-12">

                            <div class="row vertical-scroll table-responsive" >

                                <h4 ng-if="categoryItems.length>0" class="text-success"><strong>{{getPhrase('total_exams')}} </strong>: @{{ categoryItems.length}} </h4>

                                 <table class="table">
                              <thead>

                                <th></th>
                                <th>{{getPhrase('name')}}</th>
                                <th>{{getPhrase('class')}}</th>
                                <th ng-if="selected_certificate_type!='tc'">{{getPhrase('year')}}-{{getPhrase('semester')}}</th>
                               <th ng-if="selected_certificate_type=='tc'">{{getPhrase('status')}}</th>

                            </thead>
                            <tbody>
                            <tr ng-repeat="user in users" id="@{{'selected_'+user.id}}" ng-click="getUserDetails(user)">
                                <td>
                                
                                <img ng-if="user.image!=null && user.image!=''" class="thumb img-circle" src="{{IMAGE_PATH_PROFILE}}@{{user.image}}" height="60">
                                
                                <img ng-if="user.image==null || user.image==''" class="thumb img-circle" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}">
                                </td>
                                <td><p><strong>@{{user.name}}</strong></p>
                                    <p><strong>{{getPhrase('roll_no')}} : </strong> @{{user.roll_no}} </p>
                                    <p><strong>{{getPhrase('admission_no')}} : </strong> @{{user.admission_no}}</p>
                                </td>
                                <td> @{{user.academic_year_title+', '+user.course_title}} </td>
                                <td> <span ng-if = "user.course_dueration<=1">-</span>
                                    <span ng-if="user.current_year!=-1"><span ng-if="user.course_dueration>1"> @{{user.current_year}}</span></span>
                                    <span ng-if="user.current_semister!=0"><span ng-if="user.current_semister!=-1"> - @{{user.current_semister}}</span> </span> 
                                    <span ng-show="user.current_year==-1" >{{getPhrase('completed')}}</span>
                                </td>
                                
                            </tr>

                        </tbody>

                            </table>

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
                <header class="panel-heading font-bold">{{getPhrase('certificate_issue_history')}}</header>
              
               
                 <div ng-if="selected_user==null || selected_user==''" class="panel-body">
                    {{getPhrase('select_user_to_view_details')}}
                    </div>


             
    <div class="row">
            <div class="col-md-12 clearfix">
               

               <div ng-hide="selected_user==null || selected_user==''">
    
    <div ng-if="selected_user!=null" class="panel-body">
        <div class="row">
            <div class="profile-details text-center">
                <div class="profile-img">
                
                  <img ng-if="selected_user.image!=null && selected_user.image!=''" class="thumb img-circle" src="{{IMAGE_PATH_PROFILE}}@{{selected_user.image}}" height="60">
            
            <img ng-if="selected_user.image==null || selected_user.image==''" class="thumb img-circle" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}">

                </div>
                <div class="aouther-school">
                    <h3>@{{selected_user.name}}</h3>
                    <p><span>@{{selected_user.course_title+' ('+selected_user.academic_year_title+')'}}</span><span ng-if="selected_user.current_year==-1" > - {{getPhrase('completed')}}</span>
                    <span ng-if="selected_user.current_year!=-1 && selected_user.course_dueration>1 && selected_user.is_having_semister==1">@{{selected_user.current_year +' Year'}} - @{{selected_user.current_semister +' Semester'}}</span><span ng-if="selected_user.current_year!=-1 && selected_user.course_dueration>1 && selected_user.is_having_semister==0">@{{selected_user.current_year +' Year'}}</span></p>
                    <p><span><strong>Roll</strong>: @{{selected_user.roll_no}}</span></p>
                </div>

            </div>
        </div>
                </hr>
               <div ng-if="books_return>0 && certificate_type!='bonafide'" class="alert alert-warning">
                              <strong>{{getPhrase('Note:')}}</strong> @{{selected_user.name}} is need to return @{{books_return}} books in the library
               </div>
                <?php $currency  = getCurrencyCode(); ?>
               <div ng-if="fee_amount>0 && certificate_type!='bonafide'" class="alert alert-warning">
                 <strong>{{getPhrase('Note:')}}</strong> @{{selected_user.name}} is need to pay the fee {{$currency}} @{{fee_amount}} 
               </div>
 
                <div ng-hide="form_show" class="list-group vertical-scroll">
                <a ng-if="certificates_issued.length<=0" href="#" class="list-group-item">No certificates issued yet</a>


                  <a ng-if="certificates_issued.length>0" href="#" class="list-group-item" ng-repeat="certificate in certificates_issued"><strong>@{{certificate.certificate_type|uppercase}}</strong> certificate is issued on <strong>@{{certificate.created_at}}</strong> with reason <i>"@{{certificate.reason}}"</i></a>
                  
                </div>
                <hr>
                <div ng-if="books_return<=0 || certificate_type=='bonafide' || fee_amount <=0 || fee_tc=='yes'" >
                <a ng-hide="form_show" href="javascript:void(0);" class="btn  btn-info pull-right" ng-click="toggleForm()">Issue Certificate</a>
                </div>
                <a ng-show="form_show" href="javascript:void(0);" class="btn  btn-info pull-right" ng-click="toggleForm()">Hide Form</a>
                <br>

                <div ng-show="form_show">

            {!! Form::open(array('url' => URL_ISSUE_CERTIFICATE, 'method' => 'POST', 'name'=>'idCards ','target'=>'_blank', 'novalidate'=>'')) !!}
            
                    <div class="row" ng-if="selected_user!=null">
                    <div class="col-sm-12">
                <fieldset class="form-group">  
                {{ Form::label('certificate_type', getphrase('certificate_type')) }}
                <input type="hidden" name="certificate_type" value="@{{selected_certificate_type}}">
                <strong>@{{selected_certificate_type|uppercase}}</strong>
                
                </fieldset>
                <fieldset class="form-group">  
                {{ Form::label('purpose', getphrase('purpose')) }}

                <textarea rows="3" cols="10" class="form-control" name="purpose" required></textarea>
                <input type="hidden" name="user_id" value="@{{selected_user.id}}">
                </fieldset>

                    <div class="buttons text-right">
                    <button class="btn  btn-success button">{{getPhrase('issue')}}</button>

                        </div>
                {!! Form::close() !!}
                        </div>
                   </div></div>
            </div>
        </div>

    </div>
</div>


           <!-- </sec img-circletion>-->
        </div>
          
</div>

                    

                
            

@stop

@section('footer_scripts')

@include('certificates.students.scripts.js-scripts')

@stop


