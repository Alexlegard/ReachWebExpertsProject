<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Mail\AdminRegistration;
use Illuminate\Support\Facades\Mail;


class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::paginate(20);
		
		return view("superadmin/admins/index", [
			"admins" => $admins
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
		$restaurants = $admin->restaurants;
		
        return view("superadmin/admins/show", [
			'admin' => $admin,
			'restaurants' => $restaurants
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
		
		return redirect("admin/admins");
    }
	
	public function ban(Admin $admin)
	{
		$admin->is_banned = true;
		
		$admin->save();
		
		return redirect("admin/admins/".$admin->id);
	}
	
	public function unban(Admin $admin)
	{
		$admin->is_banned = false;
		
		$admin->save();
		
		return redirect("admin/admins/".$admin->id);
	}

	public function showRegistrationEmailForm()
	{
		return view("superadmin/admins/showRegistrationEmailForm");
	}

	public function sendRegistrationEmail(Request $request)
	{
		request()->validate([
			'recipientemail' => 'required'
		]);

		$token = 'asdffdsa';

		Mail::to($request->recipientemail)->send(new AdminRegistration($token));

		return redirect("admin/admins")
			->withSession(['success_message' => 'Email successfully sent!']);
	}
}
