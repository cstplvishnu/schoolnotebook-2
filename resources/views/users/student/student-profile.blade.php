                    
                  <div class="media m-t">
                    <div class="profile-details text-center m-t">
                      <div class="profile-img m-t"><img src="{{ getProfilePath($user->image,'profile')}}" height="100px" width="100px" class="ss-img-cover img-circle"></div>
                        <div class="aouther-school">
                            <h5 class="font-bold">{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name}}</h5>
                            <h4 class="font-bold m-b-lg"><span><strong>{{$student->roll_no}}</strong></span></h4>
                        </div>
                     </div>
                   </div>
 
                <section class="scrollable wrapper w-f">
						<section class="panel panel-default">
					<div class="table-responsive">
                         <table class="table table-striped m-b-none table-responsive ss-fonts">
                          <thead>
                            <tr>
                              <th class="th-sortable" data-toggle="class" colspan="4">{{ getPhrase('general_info')}}</th>
                            </tr>
                          </thead>
                         <tbody>
                         <tr>
                            <td>{{getPhrase('admission_no')}}</td>
                            <td>{{$student->admission_no}}</td>
                            <td>{{getPhrase('academic_year')}}</td>
                            <td>{{ App\Academic::find($student->academic_id)->academic_year_title}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    </section>
                </section>
                    		
						<section class="scrollable wrapper w-f">
						<section class="panel panel-default">
						<div class="table-responsive">
                        <table class="table table-striped m-b-none table-responsive ss-fonts">
                            <thead>
                                <tr>
                                    <th class="th-sortable" data-toggle="class" colspan="4">{{getPhrase('personal_details')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{getPhrase('first_name')}}</td>
                                    <td>{{$student->first_name}}</td>
                                    <td>{{getPhrase('middle_name')}}</td>
                                    <td>{{$student->middle_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('last_name')}}</td>
                                    <td>{{$student->last_name}}</td>
                                    <td>{{getPhrase('blood_group')}}</td>
                                    <td>{{$student->blood_group}}</td>
                                   
                                </tr>
                                <tr>
                                    <td>{{getPhrase('gender')}}</td>
                                    <td>{{$student->gender}}</td>
                                    <td>{{getPhrase('date_of_birth')}}</td>
                                     <td>{{$student->date_of_birth}}</td>
                                    
                                </tr>
                                <tr>
                                    <td>{{getPhrase('fathers_name')}}</td>
                                    <td>{{$student->fathers_name}}</td>
                                    <td>{{getPhrase('mothers_name')}}</td>
                                    <td>{{ $student->mothers_name }}</td>
                                </tr>
                                <?php $cat = App\Category::where('id','=',$student->category_id)->get()->first(); ?>

                                <tr>
                                    <td>{{getPhrase('mother_tongue')}}</td>
                                    <td>{{ $student->mother_tongue}}</td>
                                    <td>{{getPhrase('category')}}</td>
                                    <td>{{($cat) ? $cat->category_name : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
				</section>
              </section>
                
                            <section class="scrollable wrapper w-f">
						<section class="panel panel-default">            
                            
                            
						 <div class="table-responsive">
                         <table class="table table-striped m-b-none table-responsive ss-fonts">
                            <thead>
                                <tr>
                                    <th class="th-sortable" data-toggle="class" colspan="4">{{getPhrase('contact_details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{getPhrase('address_lane1')}}</td>
                                    <td>{{ $student->address_lane1}}</td>
                                    <td>{{getPhrase('address_lane2')}}</td>
                                    <td>{{$student->address_lane2 }}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('city')}}</td>
                                    <td>{{$student->city}}</td>
                                    <td>{{getPhrase('state')}}</td>
                                    <td>{{$student->state}}</td>
                                </tr>
                                	<?php $country = DB::Table('countries')
							               ->where('country_code','=',$student->country)
							               ->first();
							                ?>
                                <tr>
                                    <td>{{getPhrase('zipcode')}}</td>
                                    <td>{{$student->zipcode}}</td>
                                    <td>{{getPhrase('country')}}</td>
                                    <td>{{($country) ? $country->country_name : ''}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('mobile')}}</td>
                                    <td>{{$student->mobile}}</td>
                                    <td>{{getPhrase('home_phone')}}</td>
                                    <td>{{$student->home_phone}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('email')}}</td>
                                    <td colspan="3">{{$user->email}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
           </section>

                    <section class="scrollable wrapper w-f">
						<section class="panel panel-default">
                     <div class="table-responsive">
                       <table class="table table-striped m-b-none table-responsive ss-fonts">
                            <thead>
                                <tr>
                                    <th class="th-sortable" data-toggle="class" colspan="4">Class & Batch Details</th>
                                </tr>
                                <?php $course = new App\Course(); ?>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{getPhrase('branch')}}</td>
                                    <td>{{ $course->getCourseRecord($student->course_parent_id)->course_title }}</td>
                                    <td>{{getPhrase('course')}}</td>
                                    <td>{{$course->getCourseRecord($student->course_id)->course_title}}</td>
                                </tr>
                                <tr>
                                    <td>{{ getPhrase('roll_no')}}</td>
                                    <td>{{$student->roll_no}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
              </section>
            </section>
					
 

			