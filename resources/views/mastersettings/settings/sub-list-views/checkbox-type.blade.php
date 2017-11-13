<?php $tool_tip = '';
				if(isset($value->tool_tip))
					$tool_tip = $value->tool_tip;
$checked = '';
if($value->value)
$checked = 'checked';
				?>
<div class="col-md-6 form-group">
                      <label class="control-label" data-toggle="tooltip" data-placement="top" title="{{$tool_tip}}">{{getPhrase($key)}}</label>
                      <div>
                        <label class="switch">
                          <input 
                          type="checkbox" 
                          name="{{$key}}[value]" 
					 	  required="true" 
					 	  value = "1" 
						  title ="{{$tool_tip}}"
						  data-placement="right"
						  {{$checked}}
						  >
                          <span></span>
                        </label>

                        <input
					 		type="hidden"
					 		name="{{$key}}[type]"
							value = "{{$value->type}}" >
				
							<input
					 		type="hidden"
					 		name="{{$key}}[tool_tip]"
							value = "{{$tool_tip}}" >
                      </div>
                    </div>