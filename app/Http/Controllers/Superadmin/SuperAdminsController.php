<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuperAdmin;

class SuperAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $superAdmins = SuperAdmin::all();
		
		return view("superadmin/superAdmins/index", [
			'superAdmins' => $superAdmins
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SuperAdmin $superAdmin)
    {
        return view("superadmin/superAdmins/show", [
			'superAdmin' => $superAdmin
		]);
    }
}
