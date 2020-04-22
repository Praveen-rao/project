<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ATG;
use App\Traits\ATGTrait;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class ATGController extends Controller
{
    //
    //public $successStatus = 200;

    public function index()
    {
        return view('register');

    }

    public function register(Request $request)
    {

       

        // $validatedData = $request->validate([
        //     'email' => 'required|email:rfc,dns',
        //     'pincode' => 'size:6'
        // ]);
        
        // // if ($validatedData->fails()) { 
        // //     return response()->json(['error'=>$validatedData->errors()], 401);            
        // // }

        // $user = new ATG();

        // $user->email = request('email');
        // $user->username = request('username');
        // $user->pincode = request('pincode');

        $validatedData = ATGTrait::validateapi($request);

        $validatedData->validate();
        
        $user = ATGTrait::createapi();


        foreach(ATG::all() as $users)
        {
            if( $users->email ==  request('email') &&
            $users->username == request('username') &&
            $users->pincode == request('pincode') )
            {
                flash('Sorry! the record already exists in database.')->error()->important();
                return redirect('/index')->with('message','Sorry! the record already exists in database.');
            }
        }    
        // return redirect('/index')->with('message','Sorry! the record already exists');

        $user->save();

        

        // $logger = new Logger('create_new');

        // $logger->pushHandler(new StreamHandler(__DIR__.'/logs/mylog.log', Logger::INFO));
        // $logger->pushHandler(new FirePHPHandler());
        
        // $logger->info('EMAIL SENT!');

        // $logger_err = new Logger('create_new_error');

        // $logger_err->pushHandler(new StreamHandler(__DIR__.'/logs/mylog.log', Logger::ERROR));
        // $logger_err->pushHandler(new FirePHPHandler());
        
        // $logger_err->info('EMAIL NOT SENT!');

        ATGTrait::mail();

        // $input = $request->all(); 
        // //$input['password'] = bcrypt($input['password']); 
        // $usered = ATG::create($input); 
        // $success['token'] =  $usered->createToken('MyApp')-> accessToken; 
        // $success['name'] =  $usered->name;

        // return response()->json(['success'=>$success], $this-> successStatus); 

        return redirect('/')->with('status','you have successfully registered!!');
        //return response()->json(['success'=>'1'], $this-> successStatus);
    }
}
