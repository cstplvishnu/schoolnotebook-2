<?php
 
    $answers = json_decode($question->answers);

    $i=1;
   
 ?>

<div class="select-answer m-t-lg">
    <ul class="row m-t-lg ss-exam">
    
     @foreach($answers as $answer)
     @if(isset($answer->option_value))
       <li class="col-md-6">
       <?php $rand_no = mt_rand(1,1000000); ?>
           
            <div class="checkbox">
                <label for="{{$answer->option_value}}_{{$rand_no}}" class="checkbox-custom" style="padding-left:0px;">
                    <input id="{{$answer->option_value}}_{{$rand_no}}" value="{{$i++}}" name="{{$question->id}}[]" type="checkbox" style="margin-left:0px;left:-10px;">
                    <span class="fa-stack checkbox-button">
                        <i class="mdi mdi-check active"> </i>
                    </span>
                   {{$answer->option_value}}
                </label>
           </div>
             @if($answer->has_file)
            <img src="{{$image_path.$answer->file_name}}" >
            @endif
        </li>  
        @endif
     @endforeach    

      

    </ul>
     
     
     
     
     
    
      
</div>
