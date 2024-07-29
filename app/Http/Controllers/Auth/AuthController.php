<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function index()
	{
		return view("auth.login");
	}

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required',
			'password' => 'required'
		]);

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			return redirect()->route('contacts.index');
		}

		return redirect()->back()->withInput()
			->withErrors(["login_failed" => "The credentials provided does not exist in our database."]);
	}

	public function register()
	{
		return view("auth.register");
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'password' => 'required|confirmed'
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password
		]);

		Auth::login($user);

		return redirect()->route("welcome");
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect()->route("login");
	}
}
