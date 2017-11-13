@extends($layout)
@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
                  <li>{{$title}}</li>
                </ul>

                
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
         		
                        <div class="notification-details">
                            <div class="notification-title text-center">
                                <h3>{{$record->title}}</h3></div>

                                <div class="notification-title text-center">
                                <h4>{{$record->subject}}</h4></div>
                            <div class="notification-content text-center">
                               <font size="5px"><b> {!!$record->description!!}</b></font>
                            </div>
                            <div class="notification-footer pull-right">
                                <a type="button" href="{{URL_FEEDBACKS}}" class="btn btn-info">{{getPhrase('back')}}</a>
                            </div>
                        </div>
                
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
        
@endsection
 
