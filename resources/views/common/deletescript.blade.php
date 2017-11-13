

<script>

	function deleteRecord(slug) {
       
       (new PNotify({
    title: '{{getPhrase('confirmation_needed')}}',
    text: '{{getPhrase('are_you_sure_delete_this_record')}}?',
    hide: false,
    confirm: {
        confirm: true
    },
    buttons: {
        closer: false,
        sticker: false
    },
    history: {
        history: false
    }
})).get().on('pnotify.confirm', function() {

     var token = '{{ csrf_token()}}';

		  	route = '{{$route}}'+slug;  

		    $.ajax({

		        url:route,

		        type: 'post',

		        data: {_method: 'delete', _token :token},

		        success:function(msg){



		        	result = $.parseJSON(msg);

		        	if(typeof result == 'object')

		        	{

		        		if(!result.status) {

		        			 new PNotify({
			                title: "{{getPhrase('sorry')}}",
			                text: "{{getPhrase('this_record_used_in_another_module')}}",
			                type: "info",
			                delay: 2000,
			                shadow: true,
			                
			                animate: {
			                            animate: true,
			                            in_class: 'fadeInLeft',
			                            out_class: 'fadeOutRight'
			                        }
			                });

		        		}
                        
                        else{ 
                        
		        		 new PNotify({
			                title: "{{getPhrase('success')}}",
			                text: "{{getPhrase('record_deleted_successfully')}}",
			                type: "success",
			                delay: 1500,
			                shadow: true,
			                
			                animate: {
			                            animate: true,
			                            in_class: 'fadeInLeft',
			                            out_class: 'fadeOutRight'
			                        }
			                });
                       
                       }
                    }
                    

		        	tableObj.ajax.reload();

		        }

		    });


})
.on('pnotify.cancel', function() {
     new PNotify({
                title: "{{getPhrase('ok')}}",
                text: "{{getPhrase('your_record_is_safe')}}",
                type: "info",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
});

	}

</script>