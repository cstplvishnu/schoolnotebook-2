@extends($layout)
@section('header_scripts')
<link href="{{JS}}datatables/datatables.css" rel="stylesheet">
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>

<section class="panel panel-default">
                <!-- Page Heading -->
                <header class="panel-heading clear"><strong> {{$title}}</strong></header>
                   
                    <div class="panel-body">
                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg clear">
                            @foreach($notifications as $notification)
                           
                            <li class="list-group-item clear">
                                <a href="{{URL_NOTIFICATIONS_VIEW.$notification->slug}}" class="clear">
                                    <h4>{{$notification->title}}</h4>
                                    <p>{{$notification->short_description}}</p> 
                                    <span class="posted-time pull-right">{{getPhrase('posted_on')}} : <i class="fa fa-calendar"></i> {{ $notification->updated_at}}</span> </a>
                            </li>
                            @endforeach
                            
                        </ul>
                        <div class="pull-right">
                            {!! $notifications->links() !!}
                        </div>
                        
                    </div>
                </section>
                
@endsection
 
@section('footer_scripts')
  
 

@stop