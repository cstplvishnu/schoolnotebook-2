@extends($layout)
@section('header_scripts')
<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li><a href="{{URL_NOTIFICATIONS}}">{{getPhrase('notifications')}}</a></li>
      <li>{{$notification->title}}</li>
    </ul>

<div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
                           
                            <div class="notification-content text-center">
                                {!!$notification->description!!}
                            </div>
                            @if($notification->url)
                            <div class="notification-footer text-center">
                                <a type="button" href="{{$notification->url}}" target="_blank" class="btn btn-lg btn-dark button">{{getPhrase('read_more')}}</a>
                            </div>
                            @endif

                         </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
        
@endsection
 
@section('footer_scripts')
 
@stop