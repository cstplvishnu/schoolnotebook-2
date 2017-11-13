


	<header class="font-bold m-l m-t-lg">{{getPhrase('select_your_child')}}</header>



<div class="panel-body">

	<ul class="list-replay list-sidebar">

	<?php $i=0; ?>

	@foreach($children as $user)

	<?php

	if(isItemPurchased($item_id, $item_type, $user->id))

		continue;

           $checked = '';

	 	if($i++==0)

	 		$checked = 'checked';

	?>

		<li>

			<a href="javascript:void(0);">

			<?php $url = getProfilePath($user->image, 'thumb'); ?>

				<img src="{{$url}}" alt="">

				<h5 class="font-bold">{{$user->name}}</h5>
				
				
				
				
				<div class="radio">
                              <label for="{{$user->id}}" class="radio-custom">
                                <input id="{{$user->id}}" onclick="changeSelectedUser('{{$user->id}}')" type="radio" name="child" value="{{$user->id}}" {{$checked}}>
                              
                               
                              </label>
                </div>
				
				
				
			

			</a>

		</li>

	@endforeach

	</ul>

</div>



<script type="text/javascript">

	function changeSelectedUser(selected_id) {

		 $('#selected_child_id').val(selected_id);

	}

</script>