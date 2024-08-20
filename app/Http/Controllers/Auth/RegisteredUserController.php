<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.signup');
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
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Rules\Password::defaults()],
            'user_type' => ['required', 'string', 'max:255'],
            'terms' => ['required'],
        ], [
            'terms.required' => 'Please accept terms and conditions!'
        ]);

        // dd($request->user_name);

        $names = explode(" ", $request->name);
        $first_name = current($names);
        $last_name = end($names);

        $user = User::create([
            'name' => $request->name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'mls_id' => $request->mls_id,
        ]);
        $user->saveMeta("name", $request->name);
        $user->saveMeta("first_name", $first_name);
        $user->saveMeta("last_name", $last_name);
        $user->saveMeta("license_no", $request->license_no);
        $user->saveMeta("license_date", $request->license_date);
        $user->saveMeta("nar_id", $request->nar_id);
        $user->saveMeta("brokerage", $request->brokerage);
        $user->saveMeta("office_building_no", $request->office_building_no);
        $user->saveMeta("office_zip", $request->office_zip);
        $user->saveMeta("total_transactions", $request->total_transactions);
        $user->saveMeta("sales_address", $request->sales_address);
        $user->saveMeta("sales_zip", $request->sales_zip);
        $user->saveMeta("sales_price", $request->sales_price);
        $user->saveMeta("realtor_profile", $request->realtor_profile);
        $user->saveMeta("email", $request->email);
        $user->saveMeta("user_name", $request->user_name);
        $user->saveMeta("user_type", $request->user_type);
        $user->saveMeta("mls_id", $request->mls_id);
        $user->saveMeta("office_address", $request->office_address);
        $user->saveMeta("city", $request->city);
        $user->saveMeta("county", $request->county);
        $user->saveMeta("state", $request->state);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
