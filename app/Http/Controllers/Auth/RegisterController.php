<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
	/**
	 * Display the registration view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return view('auth.register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
			'terms' => ['required'],
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'role' => '2',
			'phone' => $request->phone,
			'status' => 'inactive',
			'password' => Hash::make($request->password),
		]);

		$phone = '085858908600';
		$message = 'Halo *Owner*, Someone *' . $user->name . '*
Email *' .$user->email. '*
Register new account
		
		
Please check your sistem if this your employee for verification!' ;
					Http::withHeaders([
						'Content-Type' => 'application/json',
						'Authorization' => 'JHo@f!MiddUTWVCfZERS',
					])->asForm()->post('https://api.fonnte.com/send', [
						"target" => $phone,
						"type"  => "text",
						"message" => $message,
						"delay" => 3,
					]);

		event(new Registered($user));

		return redirect('register')->with('success', __('Thanks for register. please wait the verification.'));
	}
}
