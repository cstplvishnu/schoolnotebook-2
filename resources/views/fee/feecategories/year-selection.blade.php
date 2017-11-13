<?php 
    
    $user_record = null;
    $academic_id = null;
    $course_parent_id = null;
    $course_id = null;
    $current_year = 1;
    $current_semister  = 0;
    $custom_class = ''    ;
    if(isset($class))
    {
        $custom_class = $class;
    }

    if(isset($record) && $record)
    {

         $academic_id        = $record->academic_id;       
         $course_parent_id   = $record->course_parent_id;
         $course_id          = $record->course_id;
         $year               = $record->year;
         $semister           = $record->semister; 
    }
    else {
         $academic_id        = getDefaultAcademicId();       
         $course_parent_id   = getDefaultParentCourseId();       
         $course_id          = '';       
         $year               = '';       
         $semister           = ''; 
    }


?>

            <div class="row">
                <div>
                    @if(!$record)
                    <fieldset class="form-group col-md-8 col-md-offset-2" 
                    ng-init="setPreSelectedData('{{$academic_id}}','{{$course_parent_id}}','{{$course_id}}', '{{$year}}','{{$semister}}')">

                        {{ Form::label ('academic_year', getphrase('academic_year')) }}
                        <span class="text-danger">*</span>
                        {{ Form::select('academic_id', $academic_years, null, 
                        [   'class'     => 'form-control', 
                            "id"        => "select_academic_year",
                            "ng-model"  => "academic_year",
                            "ng-change" => "getParentCourses(academic_year)"
                        ])}}
                    </fieldset>
                    @else
                    
                    <fieldset class="form-group col-md-8 col-md-offset-2" ng-init="setPreSelectedData('{{$academic_id}}','{{$course_parent_id}}','{{$course_id}}', '{{$year}}','{{$semister}}')">
                        {{ Form::label ('academic_year', getphrase('academic_year')) }}
                        {{ Form::select('academic_id', $academic_years, $academic_id, 
                        [   'class'     => 'form-control', 
                            "id"        => "select_academic_year",
                            "ng-model"  => "academic_year",
                            'disabled'  => 'true',
                            "ng-change" => "getParentCourses(academic_year)",
                            
                        ])}}
                    </fieldset>
                    <!-- <input type="hidden" name="extra_academic_id" value="{{$academic_id}}"> -->
                    @endif
                    
                    @if(!$record)
                    <fieldset ng-if = "selected_academic_id" class="form-group col-md-8 col-md-offset-2">
                         <label for = "course_parent_id">{{getPhrase('branch')}}</label>
                          <span class="text-danger">*</span>
                        <select 
                        name      = "course_parent_id" 
                        id        = "course_parent_id" 
                        class     = "form-control" 
                        ng-model  = "course_parent_id" 
                        ng-change = "getChildCourses(academic_year, course_parent_id)"
                        ng-options= "option.id as option.course_title for option in parent_courses track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                        </select>
                    </fieldset>
                    @else
                    <fieldset ng-if = "selected_academic_id" class="form-group col-md-8 col-md-offset-2">
                         <label for = "course_parent_id">{{getPhrase('branch')}}</label>
                        <select 

                        name      = "course_parent_id" 
                        id        = "course_parent_id" 
                        class     = "form-control" 
                        ng-model  = "course_parent_id" 
                        disabled  = "true" 
                        ng-change = "getChildCourses(academic_year, course_parent_id)"
                        ng-options= "option.id as option.course_title for option in parent_courses track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                    
                        </select>
                    </fieldset>
                    @endif
                   
                   @if(!$record)
                    <fieldset ng-if="selected_course_parent_id" class="form-group col-md-8 col-md-offset-2">
                       <label for="course_id">{{getPhrase('course')}}</label>
                        <span class="text-danger">*</span>
                        <select 
                        name="course_id" 
                        id="course_id" 
                        class="form-control" 
                        ng-model="course_id" 
                        ng-change="prepareYears(course_id)" 
                        ng-options="option.id as option.course_title for option in courses track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                        </select>
                    </fieldset>
                    @else

                     <fieldset ng-if="selected_course_parent_id" class="form-group col-md-8 col-md-offset-2">
                       <label for="course_id">{{getPhrase('course')}}</label>
                        <span class="text-danger">*</span>
                        <select 
                        name="course_id" 
                        id="course_id" 
                        class="form-control" 
                        ng-model="course_id" 
                        ng-change="prepareYears(course_id)" 
                        disabled  = "true" 
                        ng-options="option.id as option.course_title for option in courses track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                        </select>
                    </fieldset>
                    @endif
                        
                        @if(!$record)
                        <fieldset ng-if="years.current_year" class="form-group col-md-3" >
                   
                            <label for="year">{{getPhrase('year')}}</label>
                             <span class="text-danger">*</span>
                            
                            <select 
                            name="current_year" 
                             class="form-control" 
                            ng-model="years.current_year" 
                            ng-options="v for v in years.values track by v"
                            ng-change="yearChanged(years.current_year)"
                            >
                            </select>
                        </fieldset>
                       @else

                       <fieldset ng-if="years.current_year" class="form-group col-md-3" >
                   
                            <label for="year">{{getPhrase('year')}}</label>
                            <input type="text" name="year" value="{{$record->year}}" disabled="true" class="form-control">
                        </fieldset>
                        @endif
                        
                        @if(!$record)
                        <fieldset ng-if="have_semisters" class="form-group col-md-3">
                   
                            <label for="semister">{{getPhrase('semester')}}</label>
                             <span class="text-danger">*</span>

                             <select 
                            name="current_semister" 
                            class="form-control" 
                            ng-model="semisters.current_semister" 
                            ng-options="v for v in semisters.values track by v"
                            ng-change="semisterChanged(semisters.current_semister)"
                            >
                            </select>

                        </fieldset>
                        @else
                           
                           @if($record->semister!=0)
                        <fieldset class="form-group col-md-3">
                   
                            <label for="semister">{{getPhrase('semester')}}</label>
                             <span class="text-danger">*</span>

                             <input type="text" name="semister" value="{{$record->semister}}" disabled="true" class="form-control" >

                        </fieldset>
                        @endif

                        @endif
                         
            </div>
            
                </div>