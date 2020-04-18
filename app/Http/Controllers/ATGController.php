<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ATG;

class ATGController extends Controller
{
    //

    public function index()
    {
        return view('register');

    }

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'username' => 'required|unique:a_t_g_s|max:255',
            'email' => 'required|unique:a_t_g_s|email:rfc,dns',
            'pincode' => 'size:6'
        ]);

        $user = new ATG();

        $user->email = request('email');
        $user->username = request('username');
        $user->pincode = request('pincode');
        
 
    
    

        $user->save();

        

        return redirect('/')->with('status','you have successfully registered!');
    }
}
