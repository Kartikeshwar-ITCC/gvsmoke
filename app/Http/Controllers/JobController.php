<?php

namespace App\Http\Controllers;
use App\AgencyJobChanges;
use App\AgencyJobs;
use App\Invoice;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request){
        if(Auth::user()->role == 'admin'){
            return view('job.adminhome');
        }
        if(Auth::user()->role == 'agency'){
            $ids = AgencyJobChanges::where('agency_id',Auth::Id())->pluck('job_id');
            $jobs = AgencyJobs::where('agency_id',Auth::Id())->WhereNotIn('id',$ids)->latest()->get();
            $clonedJobs = AgencyJobChanges::where('agency_id',Auth::Id())->latest()->get();
            // dd($jobs[0]);
            // dd($clonedJobs);
            return view('job.userhome')->with('jobs', $jobs)->with('clonedJobs', $clonedJobs);
        }
    }

    public function postIndex(Request $request){

        $columns = $request->get('columns');
        $start = $request->get('start', 0);
        $length = $request->get('length', 50);

        if(Auth::user()->role == 'admin'){
            $ids = AgencyJobChanges::pluck('job_id');
            $jobs = AgencyJobs::WhereNotIn('agency_jobs.id',$ids)->with('agency');
            $jobs->join('users', 'users.id', '=', 'agency_jobs.agency_id')->select('users.name','agency_jobs.*');
            $_total = $jobs->count();

            $value1 = $columns[23]['search']['value'] ?? '';
            $value2 = $columns[41]['search']['value'] ?? '';
            $value3 = $columns[46]['search']['value'] ?? '';
            $value4 = $columns[59]['search']['value'] ?? '';

            if($value1 && $value2 && $value3 && $value4 && $value1 == $value2 && $value2 == $value3 && $value3 == $value4){
                $jobs = $jobs->where(function ($query) use($value1) {
                            $query->where('status','like','%'.$value1.'%')->orWhere('status_1','like','%'.$value1.'%')->orWhere('status_2','like','%'.$value1.'%')->orWhere('status_3','like','%'.$value1.'%');
                        });
            }

            $value1 = $columns[24]['search']['value'] ?? '';
            $value2 = $columns[42]['search']['value'] ?? '';
            $value3 = $columns[47]['search']['value'] ?? '';
            $value4 = $columns[60]['search']['value'] ?? '';

            if($value1 && $value2 && $value3 && $value4 && $value1 == $value2 && $value2 == $value3 && $value3 == $value4){
                $jobs = $jobs->where(function ($query) use($value1) {
                            $query->whereDate('booked_date',Carbon::parse($value1))->orWhereDate('booked_date_1',Carbon::parse($value1))->orWhereDate('booked_date_2',Carbon::parse($value1))->orWhereDate('booked_date_3',Carbon::parse($value1));
                        });
            }

            // sorting
            if( $request->has('order') ) {
                $_sort_field_data = $request->get('order')[0];
                $_filed_name = $_sort_field_data['column'];
                $_sort_type = $_sort_field_data['dir'];
                $_filed_name_val = $columns[$_filed_name]['data'];
                if($_filed_name_val == 'service_month'){
                    $jobs->orderBy('service_month_int', $_sort_type);
                }
                if($_filed_name_val == 'service_month_1'){
                    $jobs->orderBy('service_month_int_1', $_sort_type);
                }
                if($_filed_name_val == 'service_month_2'){
                    $jobs->orderBy('service_month_int_2', $_sort_type);
                }
                if($_filed_name_val == 'agency.name'){
                    $jobs->orderBy('users.name', $_sort_type);
                }else{
                    $jobs->orderBy($_filed_name_val, $_sort_type);
                }
            }else{
                $jobs->latest();
            }
            $globalSearch = array();
            $columnSearch = array();

            $bindings = array();
             // Main Search
            if ( $request->has('search') && $request->get('search')['value'] != '' ) {
                $str = $request->get('search')['value'];
                $str = addslashes($str);

                for ( $i=0, $ien=count($columns); $i<$ien; $i++ ) {
                    if( $columns[$i]['data'] != 'id' && $columns[$i]['data'] != 'agency.name') {
                        $requestColumn = $columns[$i];
                        if ( $requestColumn['searchable'] == 'true' ) {
                            $binding = "'%".$str."%'";
                            $globalSearch[] = "`agency_jobs`.`".$columns[$i]['data']."` LIKE ".$binding;
                        }
                    }
                    if($columns[$i]['data'] == 'agency.name'){
                        $binding = "'%".$str."%'";
                        $globalSearch[] = "`users`.`name` LIKE ".$binding;
                    }
                }
            }
            // Individual column filtering
            if ( isset( $request['columns'] ) ) {
                for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                    $requestColumn = $request['columns'][$i];
                    $str = $requestColumn['search']['value'];
                    $str = addslashes($str);

                    if ( $requestColumn['searchable'] == 'true' && $str != '' ) {
                        if($columns[$i]['data'] == 'agency.name'){
                            $binding = "'%".$str."%'";
                            $columnSearch[] = "`users`.`name` LIKE ".$binding;
                        }else if($columns[$i]['data'] == 'property_manager_name'){
                            $binding = "'%".$str."%'";
                            $columnSearch[] = "`agency_jobs`.`property_manager_name` LIKE ".$binding;
                        }else if($request['columns'][23]['search']['value'] != '' && $request['columns'][23]['search']['value'] == $request['columns'][41]['search']['value'] && $request['columns'][41]['search']['value'] == $request['columns'][46]['search']['value'] && $request['columns'][46]['search']['value'] == $request['columns'][59]['search']['value'] && ($i == 23 || $i == 41 || $i == 46 || $i == 59)){

                        }else if($request['columns'][24]['search']['value'] != '' && $request['columns'][24]['search']['value'] == $request['columns'][42]['search']['value'] && $request['columns'][42]['search']['value'] == $request['columns'][47]['search']['value'] && $request['columns'][47]['search']['value'] == $request['columns'][60]['search']['value'] && ($i == 24 || $i == 42 || $i == 47 || $i == 60)){

                        }else if($columns[$i]['data'] == 'booked_date'){
                            $binding = "'".Carbon::parse($str)."'";
                            $columnSearch[] = "date(`booked_date`) = ".$binding;
                        }else if($columns[$i]['data'] == 'booked_date_1'){
                            $binding = "'".Carbon::parse($str)."'";
                            $columnSearch[] = "date(`booked_date_1`) = ".$binding;
                        }else if($columns[$i]['data'] == 'booked_date_2'){
                            $binding = "'".Carbon::parse($str)."'";
                            $columnSearch[] = "date(`booked_date_2`) = ".$binding;
                        }else if($columns[$i]['data'] == 'booked_date_3'){
                            $binding = "'".Carbon::parse($str)."'";
                            $columnSearch[] = "date(`booked_date_3`) = ".$binding;
                        }else{
                            $binding = "'%".$str."%'";
                            $columnSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                        }
                    }
                }
            }
            // Combine the filters into a single string
            $where = '';

            // dd($columnSearch);
            if ( count( $globalSearch ) ) {
                $where = '('.implode(' OR ', $globalSearch).')';
            }

            if ( count( $columnSearch ) ) {
                $where = $where === '' ?
                    implode(' AND ', $columnSearch) :
                    $where .' AND '. implode(' AND ', $columnSearch);
            }

            if ( $where !== '' ) {
                $jobs->whereRaw($where);
            }
            $data = array();
            $data['iTotalDisplayRecords']  = $jobs->count();
            $jobs = $jobs->skip($start)->take($length)->get();

            $data['code'] = 200;
            $data['jobs'] = $jobs;
            $data['iTotalRecords']  = $_total;

            return response()->json($data);

        }
        if(Auth::user()->role == 'agency'){
            $ids = AgencyJobChanges::where('agency_id',Auth::Id())->pluck('job_id');
            $jobs = AgencyJobs::where('agency_id',Auth::Id())->WhereNotIn('id',$ids)->get();
            $clonedJobs = AgencyJobChanges::where('agency_id',Auth::Id())->get();
            return view('job.userhome')->with('jobs', $jobs)->with('clonedJobs', $clonedJobs);
        }
    }

    public function getPending(Request $request){

        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }else{
            return view('job.pendinghome');
        }
    }
    public function postPendingIndex(Request $request){
        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }

        $columns = $request->get('columns');
        $start = $request->get('start', 0);
        $length = $request->get('length', 50);


        $jobs = AgencyJobChanges::with('agency','originalJob');

        $jobs->join('users', 'users.id', '=', 'agency_job_changes.agency_id')->select('users.name','agency_job_changes.*');
        $_total = $jobs->count();
        $value = $columns[17]['search']['value'] ?? '';
        if($value){
            $jobs = $jobs->where('status','like','%'.$value.'%');
        }
        // sorting
            if( $request->has('order') ) {
                $_sort_field_data = $request->get('order')[0];
                $_filed_name = $_sort_field_data['column'];
                $_sort_type = $_sort_field_data['dir'];
                $_filed_name_val = $columns[$_filed_name]['data'];
                if($_filed_name_val == 'service_month'){
                    $jobs->orderBy('service_month_int', $_sort_type);
                }
                if($_filed_name_val == 'service_month_1'){
                    $jobs->orderBy('service_month_int_1', $_sort_type);
                }
                if($_filed_name_val == 'service_month_2'){
                    $jobs->orderBy('service_month_int_2', $_sort_type);
                }
                if($_filed_name_val == 'agency.name'){
                    $jobs->orderBy('users.name', $_sort_type);
                }else{
                    $jobs->orderBy($_filed_name_val, $_sort_type);
                }
            }else{
                $jobs->latest();
            }
        $globalSearch = array();
        $columnSearch = array();

        $bindings = array();

        if ( $request->has('search') && $request->get('search')['value'] != '' ) {
            $str = $request->get('search')['value'];
            $str = addslashes($str);

            for ( $i=0, $ien=count($columns); $i<$ien; $i++ ) {
                if( $columns[$i]['data'] != 'id' && $columns[$i]['data'] != 'agency.name') {
                    $requestColumn = $columns[$i];
                    // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                    // $column = $columns[ $columnIdx ];

                    if ( $requestColumn['searchable'] == 'true' ) {
                        // $binding = self::bind( $bindings, '%'.$str.'%', \PDO::PARAM_STR );
                        $binding = "'%".$str."%'";
                        $globalSearch[] = "`agency_job_changes`.`".$columns[$i]['data']."` LIKE ".$binding;
                    }
                }
                if($columns[$i]['data'] == 'agency.name'){
                    $binding = "'%".$str."%'";
                    $globalSearch[] = "`users`.`name` LIKE ".$binding;
                }
            }
        }

        // Individual column filtering
        if ( isset( $request['columns'] ) ) {
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                // $column = $columns[ $columnIdx ];

                $str = $requestColumn['search']['value'];
                $str = addslashes($str);

                if ( $requestColumn['searchable'] == 'true' &&
                 $str != '' ) {
                    // $binding = self::bind( $bindings, "%".$str."%", \PDO::PARAM_STR );
                    $binding = "'%".$str."%'";
                    $columnSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                }
            }
        }

        // Combine the filters into a single string
        $where = '';

        if ( count( $globalSearch ) ) {
            $where = '('.implode(' OR ', $globalSearch).')';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }

        if ( $where !== '' ) {
            // $where = 'WHERE '.$where;
            $jobs->whereRaw($where);
        }

        // dd($where);

        // if($request->has('search') && $request->get('search')['value'] != '') {
        //     $term = $request->get('search')['value'];
        //     foreach ($columns as $key => $value) {
        //         if( $value['data'] != 'id' && $value['data'] != 'agency.name') {
        //             $jobs->orWhere($value['data'], 'LIKE', "%".$term."%");
        //         }
        //     }
        //     // dd($columns);
        // }
        $data = array();
        $data['iTotalDisplayRecords']  = $jobs->count();
        $jobs = $jobs->skip($start)->take($length)->get();
        // $jobs = $jobs->skip($start)->take($length)->toSql();

        $data['code'] = 200;
        $data['jobs'] = $jobs;
        $data['iTotalRecords']  = $_total;
        // $data['sEcho']  = 10;
        return response()->json($data);
    }

    public function getDeleted(Request $request){

        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }else{
            return view('job.deletedhome');
        }
    }
    public function postDeletedIndex(Request $request){
        if(Auth::user()->role == 'agency'){
            return redirect('job');
        }

        $columns = $request->get('columns');
        $start = $request->get('start', 0);
        $length = $request->get('length', 50);


        $jobs = AgencyJobs::onlyTrashed()->with('agency')->latest();
        $_total = $jobs->count();
        $value = $columns[17]['search']['value'] ?? '';
        if($value){
            $jobs = $jobs->where('status','like','%'.$value.'%');
        }
        // sorting
        if( $request->has('order') ) {
            $_sort_field_data = $request->get('order')[0];
            $_filed_name = $_sort_field_data['column'];
            $_sort_type = $_sort_field_data['dir'];
            $_filed_name_val = $columns[$_filed_name]['data'];
            $jobs->orderBy($_filed_name_val, $_sort_type);
        }
        $globalSearch = array();
        $columnSearch = array();

        $bindings = array();

        if ( $request->has('search') && $request->get('search')['value'] != '' ) {
            $str = $request->get('search')['value'];
            $str = addslashes($str);

            for ( $i=0, $ien=count($columns); $i<$ien; $i++ ) {
                if( $columns[$i]['data'] != 'id' && $columns[$i]['data'] != 'agency.name') {
                    $requestColumn = $columns[$i];
                    // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                    // $column = $columns[ $columnIdx ];

                    if ( $requestColumn['searchable'] == 'true' ) {
                        // $binding = self::bind( $bindings, '%'.$str.'%', \PDO::PARAM_STR );
                        $binding = "'%".$str."%'";
                        $globalSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                    }
                }
            }
        }

        // Individual column filtering
        if ( isset( $request['columns'] ) ) {
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                // $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                // $column = $columns[ $columnIdx ];

                $str = $requestColumn['search']['value'];
                $str = addslashes($str);

                if ( $requestColumn['searchable'] == 'true' &&
                 $str != '' ) {
                    // $binding = self::bind( $bindings, "%".$str."%", \PDO::PARAM_STR );
                    $binding = "'%".$str."%'";
                    $columnSearch[] = "`".$columns[$i]['data']."` LIKE ".$binding;
                }
            }
        }

        // Combine the filters into a single string
        $where = '';

        if ( count( $globalSearch ) ) {
            $where = '('.implode(' OR ', $globalSearch).')';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }

        if ( $where !== '' ) {
            // $where = 'WHERE '.$where;
            $jobs->whereRaw($where);
        }

        // dd($where);

        // if($request->has('search') && $request->get('search')['value'] != '') {
        //     $term = $request->get('search')['value'];
        //     foreach ($columns as $key => $value) {
        //         if( $value['data'] != 'id' && $value['data'] != 'agency.name') {
        //             $jobs->orWhere($value['data'], 'LIKE', "%".$term."%");
        //         }
        //     }
        //     // dd($columns);
        // }
        $data = array();
        $data['iTotalDisplayRecords']  = $jobs->count();
        $jobs = $jobs->skip($start)->take($length)->get();
        // $jobs = $jobs->skip($start)->take($length)->toSql();

        $data['code'] = 200;
        $data['jobs'] = $jobs;
        $data['iTotalRecords']  = $_total;
        // $data['sEcho']  = 10;

        return response()->json($data);
    }

    public function add(Request $request){

        return view('job.add');
    }

    public function edit($id){

        if(Auth::user()->role == 'admin'){
            $job = AgencyJobs::find($id);
        }
        if(Auth::user()->role == 'agency'){
            $job = AgencyJobChanges::where('job_id',$id)->first();
            if(!$job){
                $job = AgencyJobs::find($id);
            }
        }
        if(!$job){
            request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return back();
        }

        return view('job.edit')->with('job', $job);
    }

    public function preview($id){
        $job = AgencyJobs::find($id);
        $clonedJob = AgencyJobChanges::where('job_id',$id)->first();
        if(!$job || !$clonedJob){
            // request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return redirect('job');
        }
        if(Auth::user()->role == 'agency'){
            request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return redirect('job');
        }
        return view('job.preview')->with('job', $job)->with('clonedJob', $clonedJob);
    }

    public function postUpdate(Request $request){
        // dd($request->all());
        $request->validate([
            'agency_id' => 'required',
            'property_manager_name' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
        ],[
            'agency_id.required' => 'Agency is Required',
            'property_manager_name.required' => 'Property Manager Name is Required',
            'address_line_1.required' => 'No. is Required',
            'address_line_2.required' => 'Street is Required',
            'city.required' => 'Suburb is Required',
            'state.required' => 'State is Required',
            'postal_code.required' => 'Postal Code is Required',
            'country.required' => 'Country is Required',
        ]);


        if(Auth::user()->role == 'admin'){
            if($request->has('id')){
                $id = $request->has('id') ? $request->get('id') : null;
                $job = AgencyJobs::find($id);
            }else{
                $job = new AgencyJobs();
                $job->agency_id = $request->has('agency_id') ? $request->get('agency_id') : null;
            }
        }
        if(Auth::user()->role == 'agency'){
            if($request->has('id')){
                $id = $request->has('id') ? $request->get('id') : null;
                $job = AgencyJobs::find($id);
            }else{
                $job = new AgencyJobs();
                $job->agency_id = Auth::Id();
            }
        }
        $job->agency_id = $request->has('agency_id') ? $request->get('agency_id') : null;
        $job->property_manager_name = $request->has('property_manager_name') ? $request->get('property_manager_name') : null;
        $job->landlord = $request->has('landlord') ? $request->get('landlord') : null;
        $job->landlord_email = $request->has('landlord_email') ? $request->get('landlord_email') : null;
        $job->landlord_contact = $request->has('landlord_contact') ? $request->get('landlord_contact') : null;
        $job->address_line_1 = $request->has('address_line_1') ? $request->get('address_line_1') : null;
        $job->address_line_2 = $request->has('address_line_2') ? $request->get('address_line_2') : null;
        $job->city = $request->has('city') ? $request->get('city') : null;
        $job->state = $request->has('state') ? $request->get('state') : null;
        $job->postal_code = $request->has('postal_code') ? $request->get('postal_code') : null;
        $job->key = $request->has('key') ? $request->get('key') : null;
        $job->country = $request->has('country') ? $request->get('country') : null;
        $job->location_area = $request->has('location_area') ? $request->get('location_area') : null;
        $job->tenant = $request->has('tenant') ? $request->get('tenant') : null;
        $job->tenant_1 = $request->has('tenant_1') ? $request->get('tenant_1') : null;
        $job->contact_details = $request->has('contact_details') ? $request->get('contact_details') : null;
        $job->contact_details_1 = $request->has('contact_details_1') ? $request->get('contact_details_1') : null;
        $job->tenant_email = $request->has('tenant_email') ? $request->get('tenant_email') : null;
        $job->tenant_email_1 = $request->has('tenant_email_1') ? $request->get('tenant_email_1') : null;
        $job->comments = $request->has('comments') ? $request->get('comments') : null;

// if(Auth::user()->role != 'agency'){
        $job->service_month = $request->has('service_month') ? $request->get('service_month') : null;
        $job->service_month_1 = $request->has('service_month_1') ? $request->get('service_month_1') : null;
        $job->service_month_2 = $request->has('service_month_2') ? $request->get('service_month_2') : null;
        $job->service_year_1 = $request->has('service_year_1') ? $request->get('service_year_1') : null;
        $job->service_year_2 = $request->has('service_year_2') ? $request->get('service_year_2') : null;
        $job->status = $request->has('status') ? $request->get('status') : null;
        $job->status_1 = $request->has('status_1') ? $request->get('status_1') : null;
        $job->status_2 = $request->has('status_2') ? $request->get('status_2') : null;
        $job->status_3 = $request->has('status_3') ? $request->get('status_3') : null;
        $job->technician = $request->has('technician') ? $request->get('technician') : null;
        $job->technician_1 = $request->has('technician_1') ? $request->get('technician_1') : null;
        $job->technician_2 = $request->has('technician_2') ? $request->get('technician_2') : null;
        $job->technician_3 = $request->has('technician_3') ? $request->get('technician_3') : null;
        $job->booked_date = $request->has('booked_date') && $request->get('booked_date') != null ? Carbon::parse($request->get('booked_date')) : null;
        $job->booked_date_1 = $request->has('booked_date_1') && $request->get('booked_date_1') != null ? Carbon::parse($request->get('booked_date_1')) : null;
        $job->booked_date_2 = $request->has('booked_date_2') && $request->get('booked_date_2') != null ? Carbon::parse($request->get('booked_date_2')) : null;
        $job->booked_date_3 = $request->has('booked_date_3') && $request->get('booked_date_3') != null ? Carbon::parse($request->get('booked_date_3')) : null;
        $job->t_custom_field_1 = $request->get('t_custom_field_1', null);
        $job->loc_custom_field_1 = $request->get('loc_custom_field_1', null);
        $job->exp_custom_field_1 = $request->get('exp_custom_field_1', null);
        $job->t_custom_field_2 = $request->get('t_custom_field_2', null);
        $job->loc_custom_field_2 = $request->get('loc_custom_field_2', null);
        $job->exp_custom_field_2 = $request->get('exp_custom_field_2', null);
        $job->t_custom_field_3 = $request->get('t_custom_field_3', null);
        $job->loc_custom_field_3 = $request->get('loc_custom_field_3', null);
        $job->exp_custom_field_3 = $request->get('exp_custom_field_3', null);
        $job->t_custom_field_4 = $request->get('t_custom_field_4', null);
        $job->loc_custom_field_4 = $request->get('loc_custom_field_4', null);
        $job->exp_custom_field_4 = $request->get('exp_custom_field_4', null);
        $job->has_gas_appliances = $request->has('has_gas_appliances') ? $request->get('has_gas_appliances') : null;
        $job->loc_has_gas_appliances = $request->has('loc_has_gas_appliances') ? $request->get('loc_has_gas_appliances') : null;
        $job->loc_has_gas_appliances_1 = $request->has('loc_has_gas_appliances_1') ? $request->get('loc_has_gas_appliances_1') : null;
        $job->loc_has_gas_appliances_2 = $request->has('loc_has_gas_appliances_2') ? $request->get('loc_has_gas_appliances_2') : null;
        $job->loc_has_gas_appliances_3 = $request->has('loc_has_gas_appliances_3') ? $request->get('loc_has_gas_appliances_3') : null;
        $job->t_has_gas_appliances = $request->has('t_has_gas_appliances') ? $request->get('t_has_gas_appliances') : null;
        $job->t_has_gas_appliances_1 = $request->has('t_has_gas_appliances_1') ? $request->get('t_has_gas_appliances_1') : null;
        $job->t_has_gas_appliances_2 = $request->has('t_has_gas_appliances_2') ? $request->get('t_has_gas_appliances_2') : null;
        $job->t_has_gas_appliances_3 = $request->has('t_has_gas_appliances_3') ? $request->get('t_has_gas_appliances_3') : null;
        $job->exp_has_gas_appliances = $request->get('exp_has_gas_appliances', null);
        $job->service_plan = $request->has('service_plan') ? $request->get('service_plan') : null;
        // $job->referral = $request->has('referral') ? $request->get('referral') : null;
        // $job->services = $request->has('services') ? implode(',',$request->get('services')) : $job->services;
        $job->alarm_service = $request->has('alarm_service') ? $request->get('alarm_service') : 'No';
        $job->elec_service = $request->has('elec_service') ? $request->get('elec_service') : 'No';
        $job->gas_service = $request->has('gas_service') ? $request->get('gas_service') : 'No';

        $job->last_alarm_service = $request->has('last_alarm_service') && $request->get('last_alarm_service') != null ? Carbon::parse($request->get('last_alarm_service')) : $job->last_alarm_service;
        $job->last_gas_service = $request->has('last_gas_service') && $request->get('last_gas_service') != null ? Carbon::parse($request->get('last_gas_service')) : $job->last_gas_service;
        $job->last_elec_service = $request->has('last_elec_service') && $request->get('last_elec_service') != null ? Carbon::parse($request->get('last_elec_service')) : $job->last_elec_service;
        $job->has_carbon_monoxide = $request->has('has_carbon_monoxide') ? $request->get('has_carbon_monoxide') : null;
        $job->loc_has_carbon_monoxide_1 = $request->get('loc_has_carbon_monoxide_1', null);
        $job->t_has_carbon_monoxide_1 = $request->get('t_has_carbon_monoxide_1', null);
        $job->exp_has_carbon_monoxide_1 = $request->get('exp_has_carbon_monoxide_1', null);
        $job->loc_has_carbon_monoxide_2 = $request->get('loc_has_carbon_monoxide_2', null);
        $job->t_has_carbon_monoxide_2 = $request->get('t_has_carbon_monoxide_2', null);
        $job->exp_has_carbon_monoxide_2 = $request->get('exp_has_carbon_monoxide_2', null);
// }
        if(Auth::user()->role == 'agency'){

            if($request->has('id')){

                if($job->getDirty()){
                    $clonedJob = AgencyJobChanges::where('job_id', $job->id)->first();
                    if(!$clonedJob){
                        $clonedJob = new AgencyJobChanges();
                        $clonedJob->job_id = $job->id;
                    }
                    $clonedJob->agency_id = Auth::Id();
                    $clonedJob->property_manager_name = $job->property_manager_name;
                    $clonedJob->landlord = $job->landlord;
                    $clonedJob->landlord_email = $job->landlord_email;
                    $clonedJob->landlord_contact = $job->landlord_contact;
                    $clonedJob->address_line_1 = $job->address_line_1;
                    $clonedJob->address_line_2 = $job->address_line_2;
                    $clonedJob->city = $job->city;
                    $clonedJob->state = $job->state;
                    $clonedJob->postal_code = $job->postal_code;
                    $clonedJob->key = $job->key;
                    $clonedJob->country = $job->country;
                    $clonedJob->location_area = $job->location_area;
                    $clonedJob->service_month = $job->service_month;
                    $clonedJob->service_month_1 = $job->service_month_1;
                    $clonedJob->service_month_2 = $job->service_month_2;
                    $clonedJob->service_year_1 = $job->service_year_1;
                    $clonedJob->service_year_2 = $job->service_year_2;
                    $clonedJob->tenant = $job->tenant;
                    $clonedJob->tenant_1 = $job->tenant_1;
                    $clonedJob->contact_details = $job->contact_details;
                    $clonedJob->contact_details_1 = $job->contact_details_1;
                    $clonedJob->tenant_email = $job->tenant_email;
                    $clonedJob->tenant_email_1 = $job->tenant_email_1;
                    $clonedJob->status = $job->status;
                    $clonedJob->status_1 = $job->status_1;
                    $clonedJob->status_2 = $job->status_2;
                    $clonedJob->status_3 = $job->status_3;
                    $clonedJob->technician = $job->technician;
                    $clonedJob->technician_1 = $job->technician_1;
                    $clonedJob->technician_2 = $job->technician_2;
                    $clonedJob->technician_3 = $job->technician_3;
                    $clonedJob->booked_date = $job->booked_date;
                    $clonedJob->booked_date_1 = $job->booked_date_1;
                    $clonedJob->booked_date_2 = $job->booked_date_2;
                    $clonedJob->booked_date_3 = $job->booked_date_3;
                    $clonedJob->t_custom_field_1 = $job->t_custom_field_1;
                    $clonedJob->loc_custom_field_1 = $job->loc_custom_field_1;
                    $clonedJob->exp_custom_field_1 = $job->exp_custom_field_1;
                    $clonedJob->t_custom_field_2 = $job->t_custom_field_2;
                    $clonedJob->loc_custom_field_2 = $job->loc_custom_field_2;
                    $clonedJob->exp_custom_field_2 = $job->exp_custom_field_2;
                    $clonedJob->t_custom_field_3 = $job->t_custom_field_3;
                    $clonedJob->loc_custom_field_3 = $job->loc_custom_field_3;
                    $clonedJob->exp_custom_field_3 = $job->exp_custom_field_3;
                    $clonedJob->t_custom_field_4 = $job->t_custom_field_4;
                    $clonedJob->loc_custom_field_4 = $job->loc_custom_field_4;
                    $clonedJob->exp_custom_field_4 = $job->exp_custom_field_4;
                    $clonedJob->has_gas_appliances = $job->has_gas_appliances;
                    $clonedJob->loc_has_gas_appliances = $job->loc_has_gas_appliances;
                    $clonedJob->loc_has_gas_appliances_1 = $job->loc_has_gas_appliances_1;
                    $clonedJob->loc_has_gas_appliances_2 = $job->loc_has_gas_appliances_2;
                    $clonedJob->loc_has_gas_appliances_3 = $job->loc_has_gas_appliances_3;
                    $clonedJob->t_has_gas_appliances = $job->t_has_gas_appliances;
                    $clonedJob->t_has_gas_appliances_1 = $job->t_has_gas_appliances_1;
                    $clonedJob->t_has_gas_appliances_2 = $job->t_has_gas_appliances_2;
                    $clonedJob->t_has_gas_appliances_3 = $job->t_has_gas_appliances_3;
                    $clonedJob->exp_has_gas_appliances = $job->exp_has_gas_appliances;
                    $clonedJob->comments = $job->comments;
                    $clonedJob->service_plan = $job->service_plan;
                    // $clonedJob->services = $job->services;
                    $clonedJob->alarm_service = $job->alarm_service;
                    $clonedJob->elec_service = $job->elec_service;
                    $clonedJob->gas_service = $job->gas_service;
                    $clonedJob->last_alarm_service = $job->last_alarm_service;
                    $clonedJob->last_gas_service = $job->last_gas_service;
                    $clonedJob->last_elec_service = $job->last_elec_service;
                    $clonedJob->has_carbon_monoxide = $job->has_carbon_monoxide;
                    $clonedJob->loc_has_carbon_monoxide_1 = $job->loc_has_carbon_monoxide_1;
                    $clonedJob->t_has_carbon_monoxide_1 = $job->t_has_carbon_monoxide_1;
                    $clonedJob->exp_has_carbon_monoxide_1 = $job->exp_has_carbon_monoxide_1;
                    $clonedJob->loc_has_carbon_monoxide_2 = $job->loc_has_carbon_monoxide_2;
                    $clonedJob->t_has_carbon_monoxide_2 = $job->t_has_carbon_monoxide_2;
                    $clonedJob->exp_has_carbon_monoxide_2 = $job->exp_has_carbon_monoxide_2;
                    $clonedJob->save();
                }
                request()->session()->flash('notify-success', 'Job Updated Successfully..!');
            }else{
                $job->save();
                request()->session()->flash('notify-success', 'Job Added Successfully..!');
            }
        }

        if(Auth::user()->role == 'admin'){
            $job->save();
            if($request->has('id')){
                request()->session()->flash('notify-success', 'Job Updated Successfully..!');
            }else{
                request()->session()->flash('notify-success', 'Job Added Successfully..!');
            }
        }

        if( $request->file('invoice_name') ) {
            foreach ($request->file('invoice_name') as $key => $_file) {
                // $filename = "INV".time().$_file->getClientOriginalName();
                $filename = "INV".time()."_".rand(1000, 9999).'.'.$_file->getClientOriginalExtension();
                $_file->move(base_path().'/public/invoices', $filename);
                $inv = new Invoice;
                $inv->job_id = $job->id;
                $inv->invoice_name = $filename;
                $inv->service_name = $request->get('service_name')[$key];
                $inv->save();
            }
        }

        return redirect('job');
    }

    public function postApprove(Request $request, $id){

        $job = AgencyJobs::find($id);
        $clonedJob = AgencyJobChanges::where('job_id', $id)->first();

        $job->property_manager_name = $request->get('property_manager_name', $clonedJob->property_manager_name);
        $job->landlord = $request->get('landlord', $clonedJob->landlord);
        $job->landlord_email = $request->get('landlord_email', $clonedJob->landlord_email);
        $job->landlord_contact = $request->get('landlord_contact', $clonedJob->landlord_contact);
        $job->address_line_1 = $request->get('address_line_1', $clonedJob->address_line_1);
        $job->address_line_2 = $request->get('address_line_2', $clonedJob->address_line_2);
        $job->city = $request->get('city', $clonedJob->city);
        $job->state = $request->get('state', $clonedJob->state);
        $job->postal_code = $request->get('postal_code', $clonedJob->postal_code);
        $job->key = $request->get('key', $clonedJob->key);
        $job->country = $request->get('country', $clonedJob->country);
        $job->location_area = $request->get('location_area', $clonedJob->location_area);
        $job->service_month = $request->get('service_month', $clonedJob->service_month);
        $job->tenant = $request->get('tenant', $clonedJob->tenant);
        $job->contact_details = $request->get('contact_details', $clonedJob->contact_details);
        $job->status = $request->get('status', $clonedJob->status);
        $job->t_custom_field_1 = $request->get('t_custom_field_1', $clonedJob->t_custom_field_1);
        $job->loc_custom_field_1 = $request->get('loc_custom_field_1', $clonedJob->loc_custom_field_1);
        $job->exp_custom_field_1 = $request->get('exp_custom_field_1', $clonedJob->exp_custom_field_1);
        $job->t_custom_field_2 = $request->get('t_custom_field_2', $clonedJob->t_custom_field_2);
        $job->loc_custom_field_2 = $request->get('loc_custom_field_2', $clonedJob->loc_custom_field_2);
        $job->exp_custom_field_2 = $request->get('exp_custom_field_2', $clonedJob->exp_custom_field_2);
        $job->t_custom_field_3 = $request->get('t_custom_field_3', $clonedJob->t_custom_field_3);
        $job->loc_custom_field_3 = $request->get('loc_custom_field_3', $clonedJob->loc_custom_field_3);
        $job->exp_custom_field_3 = $request->get('exp_custom_field_3', $clonedJob->exp_custom_field_3);
        $job->t_custom_field_4 = $request->get('t_custom_field_4', $clonedJob->t_custom_field_4);
        $job->loc_custom_field_4 = $request->get('loc_custom_field_4', $clonedJob->loc_custom_field_4);
        $job->exp_custom_field_4 = $request->get('exp_custom_field_4', $clonedJob->exp_custom_field_4);
        $job->has_gas_appliances = $request->get('has_gas_appliances', $clonedJob->has_gas_appliances);
        $job->loc_has_gas_appliances = $request->get('loc_has_gas_appliances', $clonedJob->loc_has_gas_appliances);
        $job->t_has_gas_appliances = $request->get('t_has_gas_appliances', $clonedJob->t_has_gas_appliances);
        // $job->exp_has_gas_appliances = $request->get('exp_has_gas_appliances', $clonedJob->exp_has_gas_appliances);
        $job->comments = $request->get('comments', $clonedJob->comments);
        $job->service_plan = $request->get('service_plan', $clonedJob->service_plan);
        // $job->services = $request->get('services', $clonedJob->services);
        $job->alarm_service = $request->get('alarm_service', $clonedJob->alarm_service);
        $job->elec_service = $request->get('elec_service', $clonedJob->elec_service);
        $job->gas_service = $request->get('gas_service', $clonedJob->gas_service);
        $job->last_alarm_service = $request->has('last_alarm_service') && $request->get('last_alarm_service') != null ? Carbon::parse($request->get('last_alarm_service')) : $clonedJob->last_alarm_service;
        $job->last_gas_service = $request->has('last_gas_service') && $request->get('last_gas_service') != null ? Carbon::parse($request->get('last_gas_service')) : $clonedJob->last_gas_service;
        $job->last_elec_service = $request->has('last_elec_service') && $request->get('last_elec_service') != null ? Carbon::parse($request->get('last_elec_service')) : $clonedJob->last_elec_service;
        $job->tenant_1 = $request->get('tenant_1', $clonedJob->tenant_1);
        $job->contact_details_1 = $request->get('contact_details_1', $clonedJob->contact_details_1);
        $job->tenant_email = $request->get('tenant_email', $clonedJob->tenant_email);
        $job->tenant_email_1 = $request->get('tenant_email_1', $clonedJob->tenant_email_1);
        // $job->service_month_1 = $request->get('service_month_1', $clonedJob->service_month_1);
        // $job->service_month_2 = $request->get('service_month_2', $clonedJob->service_month_2);
        $job->service_year_1 = $request->get('service_year_1', $clonedJob->service_year_1);
        $job->service_year_2 = $request->get('service_year_2', $clonedJob->service_year_2);
        $job->status_1 = $request->get('status_1', $clonedJob->status_1);
        $job->status_2 = $request->get('status_2', $clonedJob->status_2);
        $job->status_3 = $request->get('status_3', $clonedJob->status_3);
        $job->technician = $request->get('technician', $clonedJob->technician);
        $job->technician_1 = $request->get('technician_1', $clonedJob->technician_1);
        $job->technician_2 = $request->get('technician_2', $clonedJob->technician_2);
        $job->technician_3 = $request->get('technician_3', $clonedJob->technician_3);
        $job->booked_date = $request->has('booked_date') && $request->get('booked_date') != null ? Carbon::parse($request->get('booked_date')) : $clonedJob->booked_date;
        $job->booked_date_1 = $request->has('booked_date_1') && $request->get('booked_date_1') != null ? Carbon::parse($request->get('booked_date_1')) : $clonedJob->booked_date_1;
        $job->booked_date_2 = $request->has('booked_date_2') && $request->get('booked_date_2') != null ? Carbon::parse($request->get('booked_date_2')) : $clonedJob->booked_date_2;
        $job->booked_date_3 = $request->has('booked_date_3') && $request->get('booked_date_3') != null ? Carbon::parse($request->get('booked_date_3')) : $clonedJob->booked_date_3;
        $job->loc_has_gas_appliances_1 = $request->get('loc_has_gas_appliances_1', $clonedJob->loc_has_gas_appliances_1);
        $job->loc_has_gas_appliances_2 = $request->get('loc_has_gas_appliances_2', $clonedJob->loc_has_gas_appliances_2);
        $job->loc_has_gas_appliances_3 = $request->get('loc_has_gas_appliances_3', $clonedJob->loc_has_gas_appliances_3);
        $job->t_has_gas_appliances_1 = $request->get('t_has_gas_appliances_1', $clonedJob->t_has_gas_appliances_1);
        $job->t_has_gas_appliances_2 = $request->get('t_has_gas_appliances_2', $clonedJob->t_has_gas_appliances_2);
        $job->t_has_gas_appliances_3 = $request->get('t_has_gas_appliances_3', $clonedJob->t_has_gas_appliances_3);
        $job->has_carbon_monoxide = $request->get('has_carbon_monoxide', $clonedJob->has_carbon_monoxide);
        $job->loc_has_carbon_monoxide_1 = $request->get('loc_has_carbon_monoxide_1', $clonedJob->loc_has_carbon_monoxide_1);
        $job->t_has_carbon_monoxide_1 = $request->get('t_has_carbon_monoxide_1', $clonedJob->t_has_carbon_monoxide_1);
        $job->exp_has_carbon_monoxide_1 = $request->get('exp_has_carbon_monoxide_1', $clonedJob->exp_has_carbon_monoxide_1);
        $job->loc_has_carbon_monoxide_2 = $request->get('loc_has_carbon_monoxide_2', $clonedJob->loc_has_carbon_monoxide_2);
        $job->t_has_carbon_monoxide_2 = $request->get('t_has_carbon_monoxide_2', $clonedJob->t_has_carbon_monoxide_2);
        $job->exp_has_carbon_monoxide_2 = $request->get('exp_has_carbon_monoxide_2', $clonedJob->exp_has_carbon_monoxide_2);
        $job->save();
        $clonedJob->delete();
        request()->session()->flash('notify-success', 'Job Approved Successfully..!');
        return redirect('job');
    }

    public function postDecline($id){
        $clonedJob = AgencyJobChanges::where('job_id', $id)->first();
        $clonedJob->delete();
        request()->session()->flash('notify-success', 'Job Declined Successfully..!');
        return redirect('job');
    }
    public function previewEdit($id){

        if(Auth::user()->role == 'admin'){
            $job = AgencyJobChanges::where('job_id',$id)->first();
            if(!$job){
                $job = AgencyJobs::find($id);
            }
        }
        if(!$job){
            request()->session()->flash('notify-error', 'Something Went Wrong..!');
            return back();
        }

        return view('job.edit')->with('job', $job);
    }
    public function postRestore($id){

        $response = array();
        $response['code'] = 400;
        $response['title'] = 'Job Not Found..!';
        $response['message'] = '';

        $job = AgencyJobs::withTrashed()->find($id);

        if($job){
            $agency = User::find($job->agency_id);
            if($agency){
                $job->restore();
                $response['code'] = 200;
                $response['title'] = 'Job Restored Successfully..!';
                $response['message'] = '';

            }else{
                $response['code'] = 400;
                $response['title'] = 'Job Restoring failed..!';
                $response['message'] = 'Job\'s Agency Does not exists, Unable to restore Job..!!';
            }
        }
        return response()->json($response);
    }


    public function postDelete(Request $request){
        $id = $request->has('id') ? $request->get('id') : null;
        $job = AgencyJobs::find($id);
        if(!$job){
            return back();
        }
        $job->delete();
        request()->session()->flash('notify-success', 'Job Deleted Successfully..!');

        return redirect('job');
    }

    public function changejobbulkstatus(Request $request) {
        if( $request->has('job_ids') ) {
            foreach ($request->get('job_ids') as $key => $value) {
                if(Auth::user()->role == 'agency'){
                    // first check in 'agency_job_changes' table
                    // if not found then clone from 'agency_jobs' to 'agency_job_changes'
                } else {
                    // change directly in 'agency_jobs' table
                    $job = AgencyJobs::find($value);
                    $job->status = NULL;
                    $job->save();
                }
            }
        }
        request()->session()->flash('notify-success', 'Job Status Updated Successfully..!');
        $response['code'] = 200;
        $response['title'] = 'Job Status Updated Successfully..!';
        $response['message'] = '';
        return response()->json($response);
    }


    public function cronUpdateBookingStatus()
    {
        \Log::debug('XXX_XXX_XXX');
        $jobs = AgencyJobs::where('status','Booked In')->get();
        foreach ($jobs as $key => $job) {
            if($job->booked_date != null){
                $date = Carbon::parse($job->booked_date);
                if(!$date->isToday() && !$date->isFuture()){
                    $job->status = 'Overdue';
                    $job->save();
                }
            }
        }
    }
    public function testing()
    {

        $jobs = AgencyJobs::all();
        foreach ($jobs as $key => $job) {
            dump($key);
            if($job->services != null){
                $_services = explode(',', $job->services);
                if(in_array('Alarm', $_services)){
                    $job->alarm_service = 'Yes';
                }
                if(in_array('Gas', $_services)){
                    $job->gas_service = 'Yes';
                }
                if(in_array('Elec', $_services)){
                    $job->elec_service = 'Yes';
                }
                $job->save();

            }
        }
    }
}

