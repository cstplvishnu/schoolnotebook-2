<?php


namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fine;
use Yajra\Datatables\Datatables;
use DB;

class FinesController extends Controller
{
         
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $data['active_class']       = 'settings';
        $data['title']              = getPhrase('fines');
        $data['layout']              = getLayout();
    	return view('fee.fines.list', $data);
    }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {


         $records = Fine::select([   
         	'feecategory_id', 'fine_name','description', 'id','slug']);
        
        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         

            return '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_FEE_FINES.$records->slug.'"><i class="icon-packages"></i>'.getPhrase("edit").'</a></li>
                            
                            <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="icon-packages"></i>'. getPhrase("delete").'</a></li>
                        </ul>
                    </div>';
            })
        ->removeColumn('id')
        ->removeColumn('slug')
        ->editColumn('feecategory_id', function($records){
        	return 
        	App\FeeCategory::find($records->feecategory_id)->fee_category;
        })
   
   
        ->make();
    }

    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
    	$data['record']         	= FALSE;
    	$data['active_class']       = 'settings';
    	$data['fee_categories']    = array_pluck(App\FeeCategory::all(),'fee_category', 'id');
    	$data['title']              = getPhrase('add_fine');
        $data['layout']              = getLayout();
    	return view('fee.fines.add-edit', $data);
    }

    /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {
    	$record = Fine::where('slug', $slug)->get()->first();
    	$data['record']       		= $record;
    	$data['active_class']       = 'settings';
       	$data['fee_categories']    = array_pluck(App\FeeCategory::all(),'fee_category', 'id');
    	$data['title']              = getPhrase('edit_fine');
       $data['layout']              = getLayout();
    	return view('fee.fines.add-edit', $data);
    }

    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {

        $record                 = Fine::where('slug', $slug)->get()->first();
        
          $this->validate($request, [
       	  'feecategory_id'          => 'bail|required|integer',
         'fine_name'          	   => 'bail|required|max:30',
         ]);

        $name 					        = $request->fine_name;
       
       /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
        if($name != $record->fine_name)
            $record->slug = $record->makeSlug($name);
    	
      	 $record->fine_name 		= $name;
        $record->slug 			    = $record->makeSlug($name);
        $record->feecategory_id		= $request->feecategory_id;
        $record->description		= $request->description;
        $record->save();


    	flash('success','record_updated_successfully', 'success');
    	return redirect('fee/fines');
    }

    /**
     * This method adds record to DB
     * @param  Request $request [Request Object]
     * @return void
     */
    public function store(Request $request)
    {
    	// dd($request);
       $this->validate($request, [
         'feecategory_id'          => 'bail|required|integer',
         'fine_name'          	   => 'bail|required|max:30',
            ]);
    	$record = new Fine();
        $name 					    = $request->fine_name;
        $record->fine_name 			= $name;
        $record->slug 			    = $record->makeSlug($name);
        $record->feecategory_id		= $request->feecategory_id;
        $record->description		= $request->description;
        $record->save();
 

        flash('success','record_added_successfully', 'success');
    	return redirect('fee/fines');
    }
 
    
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        Fine::where('slug', $slug)->delete();
        return 1;
    }
}
