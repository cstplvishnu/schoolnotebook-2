 <?php  $contents = $series->itemsList();   ?>
 
 <div class="row">
  <div class="col-sm-6 col-sm-offset-3">
 <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg clear">
        @foreach($contents as $content)                    
        <?php 
            $url = URL_STUDENT_TAKE_EXAM.$content->slug;
            $paid = ($item->is_paid && !isItemPurchased($item->id, 'combo')) ? TRUE : FALSE;
        ?>
             <?php $role = getRoleData(Auth::user()->role_id); ?>
         <?php if($paid) $url = '#'; ?>
        <li class="list-group-item clear">
        <a 

        href="javascript:void(0);" 
        @if($paid)
            onclick="showMessage('Please buy this package to continue');" 
        @else
           @if($role=='student')
            onclick="showInstructions('{{$url}}');" 
           @endif
        @endif
        >
        {{$content->title}}   
        </a>  
            <span class="buttons-right pull-right">
       
                @if($role!='parent')
            
               <a  class="btn btn-success"
                href="javascript:void(0);" 
                 @if($paid)
                    onclick="showMessage('Please buy this package to continue');" 
                @else

                    onclick="showInstructions('{{$url}}');" 
                @endif
                > 
                {{getPhrase('take_exam')}}
                </a>
               
                @else
                <a 
                @if($role!='parent')
                href="{{$url}}"
                @endif
                > {{$content->dueration}} {{getPhrase('minutes')}}</a>
                @endif

             

            </span>

             </li>

        @endforeach

    </ul>
   </div>
  </div>