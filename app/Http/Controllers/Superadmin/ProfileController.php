<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\SuperAdminProfile;
use App\Http\Requests\SuperAdminProfileRequest;

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
        $superAdmin = Auth::guard('superadmin')->user();
		$profile = $superAdmin->profile;
		
		return view("superadmin/profile/show", [
			'superAdmin' => $superAdmin,
			'profile' => $profile
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
		$superAdmin = Auth::guard('superadmin')->user();
        $profile = $superAdmin->profile;
		
		return view("superadmin/profile/edit", [
			'superAdmin' => $superAdmin,
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
    public function update(SuperAdminProfileRequest $request, SuperAdminProfile $profile)
    {
        $user = $profile->superadmin;
		$user->name = request('name');
		$user->email = request('email');
		$profile->description = request('description');
		
		$user->save();
		$profile->save();
		
		return redirect('admin/profile');
    }
}
