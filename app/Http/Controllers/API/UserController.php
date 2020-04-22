<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\ATG; 
use Illuminate\Support\Facades\Auth; 
// use Validator;

use Illuminate\Support\Facades\Validator;

use App\Traits\ATGTrait;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    // public function login(){ 
    //     if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('MyApp')-> accessToken; 
    //         return response()->json(['success' => $success], $this-> successStatus); 
    //     } 
    //     else{ 
    //         return response()->json(['error'=>'Unauthorised'], 401); 
    //     } 
    // }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function registere(Request $request)
    {

       $dup = 0;

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

        if($validatedData->fails())
        {
            return response()->json(['status'=>'0','error'=>[$validatedData->errors()]]);
        }
        
        $user = ATGTrait::createapi();
    
        foreach(ATG::all() as $users)
        {
            if( $users->email ==  request('email') &&
            $users->username == request('username') &&
            $users->pincode == request('pincode') )
            {
                // flash('Sorry! the record already exists in database.')->error()->important();
                // return redirect('/index');
                //return "Sorry! the record already exists in database.";
                $dup = 1;

                return response()->json(['status'=>'0','error'=>['duplicate'=>$dup]]);
                
                
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

        
        return response()->json(['status'=>'1','error'=>'Record has been added to database!']);
    }
}