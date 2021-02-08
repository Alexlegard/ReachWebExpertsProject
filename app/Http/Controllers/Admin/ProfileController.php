<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\AdminProfile;
use App\Http\Requests\AdminProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $admin = Auth::guard('admin')->user();
		$profile = $admin->profile;
		
		return view("admin/myProfile/show", [
			'admin' => $admin
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
		$admin = Auth::guard('admin')->user();
		$profile = $admin->profile;
		
        return view("admin/myProfile/edit", [
			'admin' => $admin,
			'profile' => $profile
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminProfileRequest $request, AdminProfile $adminProfile)
    {
		$admin = $adminProfile->admin;
        $admin->name = $request->name;
		$admin->email = $request->email;
		$admin->save();
		
		$adminProfile->description = $request->description;
		$adminProfile->save();
		
		return redirect('admin/my-profile');
    }
}
