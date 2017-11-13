@extends($layout)
@section('content')


<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
                   <li> <a href="{{URL_STUDENT_LMS_SERIES}}"> LMS {{getPhrase('series')}} </a> </li>
               <li>{{$title}}</li>
                </ul>

         <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                     <section class="panel panel-default">
                     
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body"> 
 
                        @if(!$content_record)

                        <div class="row">
                        <?php 
                             $image = IMAGE_PATH_UPLOAD_LMS_DEFAULT;
                             if($item->image)
                             $image = IMAGE_PATH_UPLOAD_LMS_SERIES.$item->image;
                         ?>

                            <div class="col-md-3"> <img src="{{$image}}" class="img-responsive center-block img-circle" alt=""> </div>
                            <div class="col-md-8 col-md-offset-1">
                                <div class="series-details">
                                    <h2>{{$item->title}} </h2>

                                    	{!! $item->description!!}
                                    @if($item->is_paid && !isItemPurchased($item->id, 'lms'))
                                    <div class="buttons text-left">
                                        <a href="{{URL_PAYMENTS_CHECKOUT.'lms/'.$item->slug}}" class="btn btn-dark text-uppercase">{{ getPhrase('buy_now')}}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @elseif($content_record->content_type == 'video' || $content_record->content_type == 'iframe' || $content_record->content_type == 'video_url')

                            @include('student.lms.series-video-player', array('series'=>$item, 'content' => $content_record))

                        @elseif($content_record->content_type == 'audio' || $content_record->content_type == 'audio_url')
 
                            @include('student.lms.series-audio-player', array('series'=>$item, 'content' => $content_record))
                        @endif

                        <hr>

                       @include('student.lms.series-items', array('series'=>$item, 'content'=>$content_record))

                            
                         </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@stop
@section('footer_scripts')

@if($content_record)
    @if($content_record->content_type == 'video' || $content_record->content_type == 'video_url')
        @include('common.video-scripts')
    @endif

@endif
@include('common.custom-message-alert')
@stop