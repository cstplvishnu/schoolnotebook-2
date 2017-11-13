                        
                  <div class="media m-t">
                    <div class="profile-details text-center m-t">
                      <div class="profile-img m-t"><img src="{{ getProfilePath($user->image,'profile')}}" height="100px" width="100px" class="ss-img-cover img-circle"></div>
                        <div class="aouther-school">
                            <h5 class="font-bold">{{ $staff->first_name.' '.$staff->middle_name.' '.$staff->last_name}}</h5>
                            <h4 class="font-bold"><span><strong>{{$staff->job_title}}</strong></span> - <span>{{$staff->staff_id}}</span></h4>
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
                            <td>{{getPhrase('staff_id')}}</td>
                            <td>{{$staff->staff_id}}</td>
                            <td>{{getPhrase('date_of_join')}}</td>
                            <td>{{ $staff->date_of_join}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                        </section></section>		
						
						
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
                                    <td>{{$staff->first_name}}</td>
                                    <td>{{getPhrase('middle_name')}}</td>
                                    <td>{{$staff->middle_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('last_name')}}</td>
                                    <td>{{$staff->last_name}}</td>
                                    <td>{{getPhrase('blood_group')}}</td>
                                    <td>{{$staff->blood_group}}</td>
                                   
                                </tr>
                                <tr>
                                    <td>{{getPhrase('gender')}}</td>
                                    <td>{{$staff->gender}}</td>
                                    <td>{{getPhrase('date_of_birth')}}</td>
                                     <td>{{$staff->date_of_birth}}</td>
                                    
                                </tr>
                                <tr>
                                    <td>{{getPhrase('fathers_name')}}</td>
                                    <td>{{$staff->fathers_name}}</td>
                                    <td>{{getPhrase('mothers_name')}}</td>
                                    <td>{{ $staff->mothers_name }}</td>
                                </tr>
                                <?php $cat = App\Category::where('id','=',$staff->category_id)->get()->first(); ?>

                                <tr>
                                    <td>{{getPhrase('mother_tongue')}}</td>
                                    <td>{{ $staff->mother_tongue}}</td>
                                    <td>{{getPhrase('category')}}</td>
                                    <td>{{($cat) ? $cat->category_name : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                            </div></section></section>

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
                                    <td>{{ $staff->address_lane1}}</td>
                                    <td>{{getPhrase('address_lane2')}}</td>
                                    <td>{{$staff->address_lane2 }}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('city')}}</td>
                                    <td>{{$staff->city}}</td>
                                    <td>{{getPhrase('state')}}</td>
                                    <td>{{$staff->state}}</td>
                                </tr>
                                	<?php $country = DB::Table('countries')
							               ->where('country_code','=',$staff->country)
							               ->first();
							                ?>
                                <tr>
                                    <td>{{getPhrase('zipcode')}}</td>
                                    <td>{{$staff->zipcode}}</td>
                                    <td>{{getPhrase('country')}}</td>
                                    <td>{{($country) ? $country->country_name : ''}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('mobile')}}</td>
                                    <td>{{$staff->mobile}}</td>
                                    <td>{{getPhrase('home_phone')}}</td>
                                    <td>{{$staff->home_phone}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('email')}}</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                             </section></section>

                     <section class="scrollable wrapper w-f">
						<section class="panel panel-default">            
                            
                            
						 <div class="table-responsive">
                         <table class="table table-striped m-b-none table-responsive ss-fonts">
                            <thead>
                                <tr>
                                    <th class="th-sortable" data-toggle="class" colspan="4">{{getPhrase('qualification_details')}}s</th>
                                </tr>
                              
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{getPhrase('qualification')}}</td>
                                    <td>{{ $staff->qualification }}</td>
                                    <td>{{getPhrase('experience')}}</td>
                                    <td>{{$staff->total_experience_years.' '. getPhrase('years').' '.$staff->total_experience_month.' '.getPhrase('months')}}</td>
                                </tr>
                                <tr>
                                    <td>{{ getPhrase('experience_information')}}</td>
                                    <td>{{$staff->experience_information}}</td>
                                    <td>{{getPhrase('other_information')}}</td>
                                    <td>{{$staff->other_information}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                         </section>
                         </section>
 
				
			