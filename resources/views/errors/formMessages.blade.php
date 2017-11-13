<script type="text/javascript" src="{{JS}}pnotify.custom.js"></script>

@if (Session::has('flash_message'))
    <script type="text/javascript">
  

        $(function(){
            PNotify.removeAll();
            new PNotify({
                title: "{{{ Session::get('flash_message.title') }}}",
                text: "{{{ Session::get('flash_message.text') }}}",
                type: "{{{ Session::get('flash_message.type') }}}",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
        });
        
    </script>
@endif

@if (Session::has('flash_overlay'))
    <script type="text/javascript">
        swal({
            title: "{{{ Session::get('flash_overlay.title') }}}",
            text: "{{{ Session::get('flash_overlay.text') }}}",
            type: "{{{ Session::get('flash_overlay.type') }}}",
            confirmButtonText: "Ok"
        });
    </script>
@endif


<script>
function showMessage(type, title, text, animation) {
    PNotify.removeAll();
    var opts = {
        title: title,
        text: text,
        type: type,
        delay: 1500,
        shadow: true,
        addclass: "stack-topright",
        animate: {
        animate: animation,
        in_class: 'fadeInLeft',
        out_class: 'fadeOutRight'
    }

    };
    new PNotify(opts);
}
</script>