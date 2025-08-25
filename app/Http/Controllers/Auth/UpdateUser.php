<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdateUser extends Controller
{
    public function show(){
        $user = Auth::user();
        return view('user.user_account' , ['user' => $user]);
    }

    public function updateDetails(Request $request){
        $user = Auth::user();

        $validated = $request->validateWithBag('updateDetails' , [
            'name' => 'required|string|max:255',
            'email'=>'required|email|max:255|unique:users,email,'.$user->id,
            'company' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
        ]);

        // $user->update($validated);
        $user->update($validated);
        return redirect()->route('user_account')->with('status', 'Profile details updated successfully!');
    }



    public function updatePassword(Request $request)
    {
         
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => 'required|string',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

         
        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The provided password does not match your current password.',
            ])->errorBag('updatePassword');
        }

         
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

         
        return redirect()->route('user_account')->with('status', 'Password changed successfully!');
    }
}
