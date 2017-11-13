@extends($layout)
@section('content')

 <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
     <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a> </li>
    <li><a href="{{URL_MESSAGES}}">{{getPhrase('messages')}}</a> </li>
    <li class="active"> {{ $title }} </li>
    </ul>

     <div class="row">
                <div class="col-sm-9 col-sm-offset-1">
                  <section class="panel panel-default" id="historybox">
                     <header class="panel-heading font-bold clear">{{getPhrase('messages')}} </header>
                    <div class="panel-body">
                      
                      <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">

                             <div class="col-md-12">

                                    <h3><strong>{{ ucfirst($thread->subject) }}</strong></h3>

                                    <?php $current_user = Auth::user()->id; ?>

                                    @foreach($thread->messages as $message)

                                    <?php $class='message-sender';

                                    if($message->user_id == $current_user)
                                    {
                                        $class = 'message-receiver';
                                    }


                                    ?>
                                        <div class="{{$class}}">
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img src="{{getProfilePath($message->user->image)}}" alt="{!! $message->user->name !!}" class="img-circle">
                                            </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">{!! $message->user->name !!}</h5>
                                                <p>{!! $message->body !!}</p>
                                                <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                                            </div>
                                        </div>
                                        </div>
                                    @endforeach
 
                            </div>

                          </ul>
                      
                        <div class="form-group">
                            <label class="col-lg-12 m-t-md">Reply</label>
                             {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}

                            <div class="col-lg-12">
                                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 clear">
                              <div class="doc-buttons pull-right">

                                {!! Form::submit('Submit', ['class' => 'btn btn-success m-t-sm']) !!}

                            </div>
                        </div>

                    </div>
                   
                    {!! Form::close() !!}
                     </div>
                  </section>

                  </div>

              </div>




@stop

@section('footer_scripts')
<script>
 $('#historybox').scrollTop($('#historybox')[0].scrollHeight);
</script>
@stop