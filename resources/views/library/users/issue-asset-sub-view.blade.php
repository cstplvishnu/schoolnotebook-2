{!! Form::open(array('url' => 'library/issues/issue-asset', 'method' => 'POST', 'files' => TRUE)) !!}

	<div class="tab-pane" id="messages">
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel panel-default">
                                <header class="panel-heading font-bold clear"> {{getPhrase('library_issues')}} </header>
                                <div class="panel-body">

                                    <div class="panel panel-custom">
											
                                             <div class="row">
												 <fieldset class="form-group col-md-6">
												{{ Form::label('library_asset_no', getphrase('reference_no')) }}
												
												{{ Form::text('library_asset_no', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Type to search', 'id'=>'auto')) }}
												</fieldset>
												 </div>

											<div class="panel-body packages">
											
												<div class="row">
												 	<div class="col-md-4">
                                                        <div>
                                                            <div id="asset_image"> </div>
                                                        </div>
                                                    </div>
                                                    
													<div class="col-md-4">
														<ul class="hostel-details list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border" id="master_details">
														 {{getPhrase('please_enter_asset_reference_number')}}
														</ul>
													</div>
													<div class="col-md-4">
														<ul class="hostel-details list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border" id="asset_details">
														
														</ul>
													</div>
												</div>
												
												<div class="buttons text-right" id="button">
													
												</div>
											</div>

                                      </div>


                                </div>
                            </section>
                        </div>
                    </div>
                </div>

	 
			

{!! Form::close() !!}