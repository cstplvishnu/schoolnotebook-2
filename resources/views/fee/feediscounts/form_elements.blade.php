 					
 					<fieldset class="form-group">
						{{ Form::label('feecategory_id', getphrase('fee_category')) }}
						
						{{Form::select('feecategory_id', $fee_categories, null, ['class'=>'form-control','id'=>'fine_category'])}}

					</fieldset>
 


					 <fieldset class="form-group">
						
						{{ Form::label('discount_name', getphrase('discount_name')) }}
						
						{{ Form::text('discount_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Introduction')) }}
					</fieldset>

					<fieldset class="form-group">
						{{ Form::label('discount_for', getphrase('discount_for')) }}
						<?php $discount_for = array('all' => 'All', 'batch'=>'Batch', 'category' => 'Category','student'=> 'Student') ?>
						{{Form::select('discount_for', $discount_for, null, ['class'=>'form-control','id'=>'discount_for', 'ng-model' => 'discount', 
						'ng-change' => 'discountOptionChanged()'])}}
					</fieldset>

					<div ng-if="discount=='batch'">
						
					<fieldset class="form-group">
						{{ Form::label('academic_id', getphrase('academic_year')) }}
						
						{{Form::select('academic_id', $academics, null, ['class'=>'form-control','id'=>'academic_id', 'ng-model' => 'academic_id'])}}

					</fieldset>

					
					<fieldset class="form-group">
						{{ Form::label('course_parent_id', getphrase('branch')) }}
						
						{{Form::select('course_parent_id', $course_parent_list, null, ['class'=>'form-control','id'=>'course_parent_id', 'ng-change'=>'fillCourses(this.value)', 'ng-model' => 'course_parent_id' ])}}

					</fieldset>

					<fieldset class="form-group">
						{{ Form::label('course_id', getphrase('course')) }}
						
						{{Form::select('course_id', $course, null, ['class'=>'form-control','id'=>'course_id', 'ng-model' => 'course_id'])}}

					</fieldset>

					</div>

					<input ng-if="discount=='all'" type="hidden" name="discount_for_details" value="all">
					<input ng-if="discount=='batch'" type="hidden" name="discount_for_details" value="batch">

					<fieldset class="form-group" ng-if="discount=='category'">
						{{ Form::label('discount_for_details', getphrase('select_category')) }}
						
						{{Form::select('discount_for_details', $categories, null, ['class'=>'form-control','id'=>'discount_for_details'])}}

					</fieldset>

					<fieldset class="form-group" ng-if="discount=='student'">
						{{ Form::label('discount_for_details', getphrase('select_student')) }}
						
						{{Form::select('discount_for_details', array(), null, ['class'=>'form-control','id'=>'discount_for_details', 'ng-model' => 'discount_for_details'])}}
					</fieldset>


					<fieldset class="form-group">
						
						{{ Form::label('description', getphrase('description')) }}
						
						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => 'Fine description')) }}
					</fieldset>
					
					 
 					
 				 
		

				 

				 
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button">{{ $button_name }}</button>
						</div>
		 