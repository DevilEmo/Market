<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('setting.settingshow')->with('user', $user);
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
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect('setting')->with('success','Password Updated ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('setting.settingshow')->with('user', $user);
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
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday' => 'required|before:today',
            'address' => 'required',
            'position' => 'required',
        ]);
        
        $user = User::find($id);
        $user->name = $request->input('name');
        // $user->email = $request->input('email');
        $user->birthday = $request->input('birthday');
        $user->address = $request->input('address');
        $user->position = $request->input('position');

        if ($request->hasFile('profile_image')) {
            $profile_image_name = 'user'.uniqid().date('dmy').'.'.request()->profile_image->getClientOriginalExtension();
            request()->profile_image->move(public_path('images/profile_images'), $profile_image_name);
            $old_profile_image = $user->profile_image;
            $user->profile_image = $profile_image_name;
            Storage::delete($old_profile_image);
        }


        $duplicate = User::where('name',$user->name)
                        // ->where('email',$user->email)
                        ->where('birthday',$user->birthday)
                        ->where('address',$user->address)
                        ->where('position',$user->position)
                        ->first();
        if (($duplicate)&&($request->hasFile('profile_image')!=true)) {
            return redirect('setting')->with('error','User already existed');
        }
        else{
            $user->save();
            return redirect('setting')->with('success','Profile info updated ');
        }
    }

    public function validid(Request $request, $id)
    {
        
        // if (auth()->user()->id !== $user->id) {
        //     return redirect('/posts/create')->with('error', 'Unauthorized page');
        // }

        $this->validate($request,[
            'valid_id' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'valid_id2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time().'.'.request()->valid_id->getClientOriginalExtension();
        $imageName2 = time().'.'.request()->valid_id2->getClientOriginalExtension();
        $imageName3 = time().'.'.request()->nbi_clearance->getClientOriginalExtension();
        
        request()->valid_id->move(public_path('valid_id_images'), $imageName);
        request()->valid_id2->move(public_path('valid_id_images'), $imageName2);
        request()->nbi_clearance->move(public_path('nbi_clearance_images'), $imageName3);
        $user = User::find($id);
        $user->valid_id = $imageName;
        $user->valid_id2 = $imageName2;
        $user->save();
        return redirect('posts/create')->with('success','Requirement submitted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
