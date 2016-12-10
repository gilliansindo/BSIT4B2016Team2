<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	return view('settings');
    }

    public function update()
    {
    	$this->validate(request(),[
    		'name' => 'required',
    		// 'email' => 'required|email|unique:users,email,' .auth()->id(),
    		'email' => ['required','email',Rule::unique('users')->ignore(auth()->id())],
    		'password' => 'required'
    	]);

    	auth()->user()->update([
    		'name' => request('name'),
    		'email' => request('email'),
    		'password' => bcrypt(request('password'))
    	]);

    	return back();
    }
}
