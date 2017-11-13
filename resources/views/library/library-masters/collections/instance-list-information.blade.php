<br>

 <section class="panel panel-default ss-panel-bg">
         <div class="row m-l-none m-r-none bg-light lter">
         	 <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins" > <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-book fa-stack-1x text-white"></i>
                    </span>
          <span class="h3 block m-t-xs"><strong>{{ $master_record->total_assets_count }}</strong></span> <small class="text-muted text-uc">{{getPhrase('total')}}</small>
        </div>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-primary"></i>
                      <i class="fa fa-list-alt fa-stack-1x text-white"></i>
                    </span>
          <span class="h3 block m-t-xs"><strong>{{ $master_record->total_assets_available }}</strong></span> <small class="text-muted text-uc">{{ getPhrase('available')}}</small>
        </div>
     
          
          <?php $damaged= App\LibraryInstance::where('library_master_id','=',$master_record->id)
								->where('status','=','damaged')->get()->count();
								?>

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    </span>
          <span class="h3 block m-t-xs"><strong>{{ $damaged }}</strong></span> <small class="text-muted text-uc">{{ getPhrase('damaged')}}</small>
        </div>
        
        <?php $lost= App\LibraryInstance::where('library_master_id','=',$master_record->id)
								->where('status','=','lost')->get()->count();
								?>   

        <div class="col-sm-6 col-md-3 padder-v b-r b-light ss-super-admins"> <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-default"></i>
                      <i class="fa fa-exchange fa-stack-1x text-white"></i>
                    </span>
          <span class="h3 block m-t-xs"><strong>{{ $lost }}</strong></span> <small class="text-muted text-uc">{{ getPhrase('lost')}}</small>
        </div>
         </div>
    </section>