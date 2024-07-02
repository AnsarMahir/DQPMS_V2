<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateProfileRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function edit (){
       return view('users.editProfile')->with('user', auth()->user());

    }

    public function update(UpdateProfileRequest $request){
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    public function authorize($ability, $arguments = []){
        return true;
    }
    public function rules(){
     return [
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
         'password' => 'required|string|min:8|confirmed',
         'phone' => 'required|string|max:255',

     ];
    }
 }

