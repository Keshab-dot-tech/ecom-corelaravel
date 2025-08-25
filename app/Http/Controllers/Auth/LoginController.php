<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{

    public function create(){
        return view('user.user_login');
    }

    public function store(Request $request){
        //  $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);
        $credentials = $request->validateWithBag('login', [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ])->errorBag('login');
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("user_login")->with('success', 'You have been successfully logged out.');
        // return redirect("user_login");
         
    }


}
