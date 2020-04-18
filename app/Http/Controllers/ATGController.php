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
            'email' => 'required|email:rfc,dns',
            'pincode' => 'size:6'
        ]);


        $user = new ATG();

        $user->email = request('email');
        $user->username = request('username');
        $user->pincode = request('pincode');
        
        foreach(ATG::all() as $users)
        {
            if( $users->email ==  request('email') &&
            $users->username == request('username') &&
            $users->pincode == request('pincode') )
            {
                return redirect('/index')->with('message','Sorry! the record already exists in database.');
            }
        }    
        // return redirect('/index')->with('message','Sorry! the record already exists');

        $user->save();

        

        return redirect('/')->with('status','you have successfully registered!');
    }
}
