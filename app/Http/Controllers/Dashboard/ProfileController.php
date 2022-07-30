<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Setting;
use App\Models\Role;

class ProfileController extends Controller
{
    public function index()
    {
        $idUser = \Auth::user()->id;
        $title = 'Profile Setting';
        $appName = Setting::first();
        $profile = User::where('id',$idUser)->first();
        $listRole = Role::get();

        return view('dashboard.profile.index', compact('title','appName','profile','listRole'));
    }

    public function update(Request $request, $id)
	{
		$request->validate([
            'role_id',
			'name' => 'required',
            'short_name',
            'nik',
            'phone',
            'company_name',
            'photo' => 'file|mimes:jpg,jpeg,png,svg|max:1024',
            'email' => 'email|required',
            'password',
            'confirm_password' => 'same:password'
		]);

        $data['role_id'] = $request->role_id;
        $data['name'] = $request->name;
        $data['short_name'] = $request->short_name;
        $data['nik'] = $request->nik;
		$data['phone'] = $request->phone;
		$data['company_name'] = $request->company_name;
		$data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
		// $data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');

        $file = $request->file('photo');
        if($file){
            $nama_file = rand().'-'. $file->getClientOriginalName();
            $file->move('assets',$nama_file);
            $data['photo'] = 'assets/' .$nama_file;
        }

		User::where('id',$id)->update($data);
		return redirect()->back()->with('success','Profile berhasil diupdate');
	}
}
