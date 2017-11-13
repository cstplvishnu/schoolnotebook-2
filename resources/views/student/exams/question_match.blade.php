<?php $answers = json_decode($question->
answers); 
$leftdata = $answers->left;
$rightdata = $answers->right;
 

?>
<div class="match-questions row clear">
    <div class="col-md-6 m-b">
        <h4 class="font-bold">{{ $leftdata->title  }}</h4>
    </div>
    <div class="col-md-6 pull-right m-b">
        <h4 class="font-bold">{{ $rightdata->title  }}</h4>
    </div>

    <div class="col-md-6">
        <ul class="option option-left list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
        <?php $i=1;?>
        @foreach($leftdata->options as $r)
            <li style="border:none;list-style:none;">
                <span class="numbers-count">
                   {{ $i++ }}
                </span>
                 {{ $r }} 
            </li>
         @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <ul class="option option-right list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
        <?php $i=1;?>
        @foreach($rightdata->options as $r)
            <li style="border:none;list-style:none;">
                <fieldset class="form-group">
                    <input class="form-control pull-right" id="ans" max="2" maxlength="2" min="1" placeholder="2" name="{{$question->id}}[]" type="text">
                        <p>
                            {{ $r }}
                        </p>
                   
                </fieldset>

            </li>
         @endforeach    
        </ul>
    </div>
</div>