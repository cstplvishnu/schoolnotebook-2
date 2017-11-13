@extends($layout)
@section('header_scripts')
<link rel="stylesheet" type="text/css" href="{{CSS}}select2.css">
@stop
@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">

  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
  <li><a href="{{URL_MESSAGES}}">{{getPhrase('messages')}}</a> </li>
  <li>{{$title}}</li>

</ul>


    <div class="row">
                  <div class="col-sm-9 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                             <div class="panel-heading">
                        
                            <div class="pull-right messages-buttons">
                                    <a class="btn btn-info" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a>

                                </div>
                      
                              </div>

                               <div class="panel-body">

                     <div class="row library-items">

                        {!! Form::open(['route' => 'messages.store']) !!}
                        <div class="col-md-8 col-md-offset-2">
                        <?php $tosentUsers = array(); ?>
                         @if($users->count() > 0)
                            
                                <?php foreach($users as $user) {
                                        $tosentUsers[$user->id] = $user->name; 
                                    }
                                ?>
                             {!! Form::label('Select User', 'Select User', ['class' => 'control-label']) !!}
                            {{Form::select('recipients[]', $tosentUsers, null, ['class'=>'form-control select2', 'name'=>'recipients[]', 'multiple'=>'true'])}}

                         @endif
                         
                            
                            <!-- Subject Form Input -->
                            <div class="form-group">
                                {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                                {!! Form::text('subject', null, ['class' => 'form-control','placeholder'=>'Eg : Fee Status']) !!}
                            </div>

                            <!-- Message Form Input -->
                            <div class="form-group">
                                {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                            </div>

                           
                            
                            <!-- Submit Form Input -->
                            <div class="text-right">
                                <a href="{{URL_MESSAGES}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                          </div>
                               
                               </div>
                          </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
            
@stop
 
@section('footer_scripts')
    
    <script src="{{JS}}select2.js"></script>
    
    <script>
      $('.select2').select2({
       placeholder: "Add User",
    });
    </script>
@stop