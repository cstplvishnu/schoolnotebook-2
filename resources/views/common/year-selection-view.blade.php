<?php 
    
    $student = null;
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

    if(isset($user_slug))
    {
        
             
             $user   = App\User::where('slug','=',$user_slug)->first();
             $student  = App\Student::where('user_id','=',$user->id)->first();

        if($student)
        {
            $academic_id        = $student->academic_id;       
            $course_parent_id   = $student->course_parent_id;       
            $course_id          = $student->course_id;       
            $year               = $student->current_year;       
            $semister           = $student->current_semister;       
        }
    }
    else {
         $academic_id        = getDefaultAcademicId();       
         $course_parent_id   = getDefaultParentCourseId();       
         $course_id          = '';       
         $year               = '';       
         $semister           = ''; 
    }


?>

            <div class="row {{$custom_class}}">
                <div class="col-md-6">
                    @if(!$student)
                    
                    <fieldset class="form-group" 
                    ng-init="setPreSelectedData('{{$academic_id}}','{{$course_parent_id}}','{{$course_id}}', '{{$year}}','{{$semister}}')">

                        {{ Form::label ('academic_year', getphrase('academic_year')) }}
                        {{ Form::select('academic_id', $academic_years, null, 
                        [   'class'     => 'form-control', 
                            "id"        => "select_academic_year",
                            "ng-model"  => "academic_year",
                            "ng-change" => "getParentCourses(academic_year)"
                        ])}}
                    </fieldset>
                    @else
                    
                    <fieldset class="form-group" ng-init="setPreSelectedData('{{$academic_id}}','{{$course_parent_id}}','{{$course_id}}', '{{$year}}','{{$semister}}')">
                        {{ Form::label ('academic_year', getphrase('academic_year')) }}
                        {{ Form::select('academic_id', $academic_years, $academic_id, 
                        [   'class'     => 'form-control', 
                            "id"        => "select_academic_year",
                            "ng-model"  => "academic_year",
                            "ng-change" => "getParentCourses(academic_year)",
                            'disabled'  => true
                        ])}}
                    </fieldset>
                    <input type="hidden" name="extra_academic_id" value="{{$academic_id}}">
                    @endif
                    
                    @if(!$student)
                    <fieldset ng-if = "selected_academic_id" class="form-group">
                         <label for = "course_parent_id">{{getPhrase('programs')}}</label>
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
                    <fieldset ng-if = "selected_academic_id" class="form-group">
                         <label for = "course_parent_id">{{getPhrase('programs')}}</label>
                        <select 

                        name      = "course_parent_id" 
                        id        = "course_parent_id" 
                        class     = "form-control" 
                        ng-model  = "course_parent_id" 
                        ng-change = "getChildCourses(academic_year, course_parent_id)"
                        disabled  = true
                        ng-options= "option.id as option.course_title for option in parent_courses track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                    
                        </select>
                    </fieldset>
                    @endif

                    <fieldset ng-if="selected_course_parent_id" class="form-group">
                       <label for="course_id">{{getPhrase('course')}}</label>
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
    
                        <fieldset ng-if="years.current_year" class="form-group">
                   
                            <label for="year">{{getPhrase('year')}}</label>
                            
                            <select 
                            name="current_year" 
                             class="form-control" 
                            ng-model="years.current_year" 
                            ng-options="v for v in years.values track by v"
                            ng-change="yearChanged(years.current_year)"
                            >
                            </select>
                        </fieldset>
                  

                        <fieldset ng-if="have_semisters" class="form-group">
                   
                            <label for="semister">{{getPhrase('semester')}}</label>

                             <select 
                            name="current_semister" 
                            class="form-control" 
                            ng-model="semisters.current_semister" 
                            ng-options="v for v in semisters.values track by v"
                            ng-change="semisterChanged(semisters.current_semister)"
                            >
                            </select>

                          

                        </fieldset>
                         
            </div>
            
                </div>