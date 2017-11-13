@extends($layout)
@section('content')
 
 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
     <li><a href="{{URL_MESSAGES}}">{{getPhrase('messages')}}</a> </li>
    </ul>



          <div class="row">
                <div class="col-sm-9 col-sm-offset-1">
                  <section class="panel panel-default">
                     <header class="panel-heading font-bold clear"> {{getPhrase('inbox')}} 
                     
                      <label class="pull-right">

                        <a class="btn btn-info" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a>
                            <a class="btn btn-info" href="{{URL_MESSAGES_CREATE}}"> 
                            {{getPhrase('compose')}}</a>

                      </label>
                     </header>

                  <?php $currentUserId = Auth::user()->id;?>
                    <div class="panel-body">
                      @if(count($threads)>0)
                        <?php $cnt = 0; ?>
                        @foreach($threads as $thread)
                        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?> 

                      <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            
                            <?php $sender = getUserRecord($thread->latestMessage->user_id); ?>

                            <li class="list-group-item unread-message {!!$class!!}">
                           
                                <?php $image_path = getProfilePath($sender->image);?>

                              <a href="{{URL_MESSAGES_SHOW.$thread->id}}" class="thumb-sm pull-left m-r-sm">
                                <img src="{{$image_path}}" class="img-circle">
                              </a>

                              
                              <a href="{{URL_MESSAGES_SHOW.$thread->id}}" class="clear">
                                <small class="pull-right"><i class="fa fa-clock-o"></i> {{$thread->latestMessage->updated_at->diffForHumans()}}
                                </small>

                                <strong class="block">{{ucfirst($thread->subject)}}</strong>
                                <small>{!! $thread->latestMessage->body !!}</small>
                              </a>
                            </li>
                            @endforeach
                          </ul>

                           @else

                            <p>{{getPhrase('sorry_no_messages_available')}}.</p>

                        @endif

                              <div class="custom-pagination pull-right">

                           {!! $threads->links() !!}

                        </div> 
                      
                    </div>

                  </section>

                </div>

              </div>

 
            
        
@stop
