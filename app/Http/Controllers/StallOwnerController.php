<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stallowner;
use App\payment;
use DB;
use Carbon\Carbon;
use Storage;

class StallOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $data = stallowner::filter($request)->orderBy('id','asc')->get();
        // // $data = stallowner::filter($request)->orderBy('created_at','desc')->paginate(20);
        // // $data = stallowner::orderBy('created_at','desc')->paginate(20);
        // return view('admin.stall_owner_list')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email',
            'class' => 'required',
            'stall_number' => 'required:unique',
            'address' => 'required',
            // 'birthday' => 'required|before:today',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $profile_image_name = 'stallowner'.uniqid().date('dmy').'.'.request()->profile_image->getClientOriginalExtension();
        request()->profile_image->move(public_path('images/profile_images'), $profile_image_name);
        //return request()->all();
        $stallowner = new stallowner;
        $stallowner->name = $request->input('name');
        $stallowner->email = $request->input('email');
        $stallowner->class = $request->input('class');
        $stallowner->stall_number = $request->input('stall_number');
        $stallowner->area = $request->input('area');
        $stallowner->profile_image = $profile_image_name;
        $stallowner->address = $request->input('address');
        $stallowner->birthday = $request->input('birthday');
        // $stallowner->duedate = today();
        $stallowner->uploader = auth()->user()->id;
        // $stallowner->contract_date = today();
        //input old data
        $stallowner->contract_date = $request->input('contract_date');
        
       
        $expiredate = Carbon::create($request->input('contract_date'));
        // $dt->day(20)->addMonth(1)->format('M-d-Y');
        
        $stallowner->duedate = today()->day(20)->addMonth()->format('Y-m-d');
        
        // $stallowner->expiration_date = today()->addYear(5);
        $stallowner->expiration_date = $expiredate->addYear(5);

        $duplicate = stallowner::where('stall_number',$stallowner->stall_number)
                        ->first();
        if ($duplicate) {
            return redirect('/admin/create_stall_owner')->with('error','Stall Number already existed');
        }else{
            $stallowner->save();
            return redirect('/admin/stall_owner_list')->with('success','Stall owner created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //get stallowners
    //    $stallowner = stallowner::findOrFail($id);
    //     //return single stallowner as a resources
    //     return new stallownerResources($stallowner);
    // }

    public function show($id)
    {
        $stallowner = stallowner::find($id);
        $data = [
            'payments' => $stallowner->payments,
            'stallowner' => $stallowner,
        ];
        return view('admin.stall_owner_detail')->with($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'class' => 'required',
            'stall_number' => 'required',
            'address' => 'required',
            'birthday' => 'required|before:today',
            'profile_image' => 'image',
        ]);
        
        
        //return request()->all();
        $stallowner = stallowner::find($id);
        $stallowner->name = $request->input('name');
        $stallowner->email = $request->input('email');
        $stallowner->class = $request->input('class');
        $stallowner->stall_number = $request->input('stall_number');
        $stallowner->area = $request->input('area');
        $stallowner->address = $request->input('address');
        $stallowner->birthday = $request->input('birthday');
        $stallowner->uploader = auth()->user()->id;
        $stallowner->contract_date = today();
        $stallowner->expiration_date = today()->addYear(5);
        
        if ($request->hasFile('profile_image')) {
            $profile_image_name = 'stallowner'.uniqid().date('dmy').'.'.request()->profile_image->getClientOriginalExtension();
            request()->profile_image->move(public_path('images/profile_images'), $profile_image_name);
            $old_profile_image = $stallowner->profile_image;
            $stallowner->profile_image = $profile_image_name;
            Storage::delete($old_profile_image);
        }

        $duplicate = stallowner::where('name',$stallowner->name)
                        ->where('email',$stallowner->email)
                        ->where('class',$stallowner->class)
                        ->where('stall_number',$stallowner->stall_number)
                        ->where('area',$stallowner->area)
                        ->where('address',$stallowner->address)
                        ->where('birthday',$stallowner->birthday)
                        ->first();
        if (($duplicate)&&($request->hasFile('profile_image')!=true)) {
            return redirect('/admin/update_stall_owner/'.$id)->with('error','Stall owner already existed');
        }else{
            $stallowner->save();
            return redirect('/admin/update_stall_owner/'.$id)->with('success','Stall owner updated');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->account_type !== 'admin') {
            return redirect('/admin/update_stall_owner/'.$id)->with('error','Not Authorized');
        }else{
             //get stallowners
            stallowner::find($id)->delete();
            return redirect('/admin/stall_owner_list')->with('success','Stallowner deleted');
        }
        
    }
}
