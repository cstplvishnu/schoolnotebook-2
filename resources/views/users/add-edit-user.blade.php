@extends($layout)
@section('content')
      <?php $present_user  =  session()->get('present_user'); ?>
        <!-- Page Heading -->
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}} </a></li>
            @if(checkRole(getUserGrade(2)))
            <li><a href="{{URL_USERS_DASHBOARD}}"> {{getPhrase('users_dahboard')}} </a></li>
            <!-- @if($present_user!=null || $present_user!=refresh-csrf )
            <li><a href="{{URL_USERS.$present_user}}"> <?php echo ucfirst($present_user);?> </a></li>
            @endif -->
            @endif
            <li>{{$title}}</li>
          </ul>
          @include('errors.errors')
        <!-- /.row -->
        
        <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>
                         <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
         <?php $button_name = getPhrase('create'); ?>
               @if ($record)
             <?php $button_name = getPhrase('update'); ?>
            {{ Form::model($record, 
            array('url' => URL_USERS_EDIT.$record->slug, 
            'method'=>'patch','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' ,'class'=>'bs-example form-horizontal')) }}
            @else
            {!! Form::open(array('url' => URL_USERS_ADD, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true','class'=>'bs-example form-horizontal')) !!}
              @endif

           @include('users.form_elements', array('button_name'=> $button_name, 'record' => $record,'present_user'=>$present_user))

           {!! Form::close() !!}
             </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('footer_scripts')
@include('common.validations')
@include('common.alertify')
 <script>
  var file = document.getElementById('image_input');

file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'png':

     
            break;
        default:
               alertify.error("{{getPhrase('file_type_not_allowed')}}");
            this.value='';
    }
};
 </script>
@stop
 
 