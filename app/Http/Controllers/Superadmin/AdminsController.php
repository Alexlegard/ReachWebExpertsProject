<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Mail\AdminRegistration;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;


class AdminsController extends Controller
{
	/**
	 * Show the form to create a new admin.
	 */
	public function create()
	{
		return view("superadmin/admins/create");
	}

	/**
	 * Create a new admin.
	 */
	public function store(AdminRequest $request)
	{
		$admin = new Admin;
		
		$random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%^&!$%^&');
		$password = substr($random, 0, 10);

		$admin->name = $request->name;
		$admin->email = $request->email;
		$admin->password = Hash::make($password);
		$admin->save();

		//Send email to new admin with their account credentials
		Mail::to( $admin->email )
			->send(new AdminRegistration($admin->name, $admin->email, $password));

		$msg = 'An email has been sent to ' . $admin->email . '!';

		return redirect("admin/admins")
			->with('message', $msg); ;
	}

    /**
     * Display a listing admins.
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
     * Display the specified admin.
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
     * Remove the specified admin from storage.
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
