<?php 
		$start_time = getSetting('start_time','time_table');
		$end_time = getSetting('end_time','time_table');
		?>

      <div>
		  <header class="panel-heading font-bold">Available Timesets</header>
	<div class="crearfix selected-questions-details">
	 <div class="table-responsive force-responsive">
	  <table class="table table-striped b-t b-light">
	    <thead>
	    	<th id="helper_step2">{{getPhrase('name')}}</th>
	    	<th id="helper_step3">{{getPhrase('start_time')}}</th>
	    	<th id="helper_step4">{{getPhrase('end_time')}}</th>
	    	<th id="helper_step5">{{getPhrase('break')}}</th>
	    	<th id="helper_step6">Action</th>
	    </thead>
	    <tbody>
	    	<tr ng-repeat="item in target_items track by $index">
	    	
	    

                <td>@{{item.name}}

	    		<input type="hidden" name="name_list[]" value="@{{item.name}}">
	    		<input type="hidden" name="id_list[]" value="@{{item.id}}">
	    		</td>
                <td>
               

                  <select 
                            name="start_time_list[]" 
                            class="form-control form-control min-width100" 
                            ng-model="selected_start_times[$index]" 
                            ng-options="option.value as option.text for option in timeset track by option.value">
                            <option value="">{{getPhrase('select')}}</option>
                            
                 </select>
 

	    		</td>
	    		<td> 
	    		 
	    		   <select 
                            name="end_time_list[]" 
                            class="form-control form-control min-width100" 
                            ng-model="selected_end_times[$index]" 
                            ng-options="option.value as option.text for option in timeset track by option.value">
                            <option value="">{{getPhrase('select')}}</option>
                            
                 </select>

	    		</td>
	    		<td>
	    		<i class="fa fa-check text-success" ng-show="item.is_break==true">
	    		<input ng-if="item.is_break==true" type="hidden" name="is_break_list[]" value="1">
	    		<input ng-if="item.is_break!=true" type="hidden" name="is_break_list[]" value="0">
	    		</td>
	    		<td>

	    			<i class="fa fa-trash text-danger" ng-click="removeItem(item,target_items,'target_items')"  aria-hidden="true">
	    			</i>
	    		</td>

	    	</tr>
	    </tbody>
	  </table>
	</div> 
	</div>	
</div>
	 

	 
	 
