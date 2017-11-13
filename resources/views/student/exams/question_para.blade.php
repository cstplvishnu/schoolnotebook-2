<?php $answers = json_decode($question->
answers);
  
 ?>
<div class="row">
    <div class="col-md-12">
        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
            <?php $i=0; ?>
            @foreach($answers as $answer)
            <?php $options = (array) $answer->
            options; ?>
            <li class="list-group-item" style="border:none;list-style:none;">
                <div class="font-bold">
                    <h5 class="font-bold m-b-lg">
                        {{ $answer->question }}
                    </h5>
                </div>
                <div class="select-answer">
                    <ul class="row list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
                        @foreach($options as $suboptions)
                        <?php $index = 1; ?>
                        @foreach($suboptions as $option)
                        
                        <li class="col-md-6" style="border:none;list-style:none;">
                            <input id="{{$question->id.'_'.$i.'_'.$index}}" value="{{$index}}" name="{{$question->id}}[{{$i}}]" type="radio"/>
                            <label for="{{$question->id.'_'.$i.'_'.$index}}" >
                                <!--<span class="fa-stack radio-button">
                                    <i class="mdi mdi-check active">
                                    </i>
                                </span>-->
                                <span>   {{$option}}</span>
                            </label>
                        </li>
                         <?php $index++; ?> 
                        @endforeach 
                        
                    @endforeach
                    <?php $i++; ?>
                    </ul>
                </div>
            </li>
            <hr>

                @endforeach
            
        </ul>
    </div>
</div>
