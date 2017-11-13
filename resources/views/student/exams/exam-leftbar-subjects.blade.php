<div class="row" id="subjectSidebar">

    <div class="col-sm-12 col-xs-12">
       <div class="panel panel-default wizard">
            <div class="wizard-steps clearfix" id="form-wizard">
              <ul class="steps">
              	@foreach($subjects as $r)
              
                <li onclick="showSubjectQuestion('subject_{{$r->id}}');">
                	<a href="javascript:void(0);"><i class="fa fa-book"></i>{{ $r->subject_title }}
                	</a></li>

               @endforeach
                </ul>
            </div>
          </div>
    </div>

</div>