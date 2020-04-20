<?php
  
namespace App\Traits;

use App\ATG;

use Illuminate\Http\Request;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
  

  
trait ATGTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public static function create(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:rfc,dns',
            'pincode' => 'size:6'
        ]);
        
        // if ($validatedData->fails()) { 
        //     return response()->json(['error'=>$validatedData->errors()], 401);            
        // }

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
                flash('Sorry! the record already exists in database.')->error()->important();
                return redirect('/index');
            }
        }    
        // return redirect('/index')->with('message','Sorry! the record already exists');

        $user->save();
    }

    public static function createapi(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:rfc,dns',
            'pincode' => 'size:6'
        ]);
        
        // if ($validatedData->fails()) { 
        //     return response()->json(['error'=>$validatedData->errors()], 401);            
        // }

        $user = new ATG();

        $user->email = request('email');
        $user->username = request('username');
        $user->pincode = request('pincode');

        return $user;
        
        // foreach(ATG::all() as $users)
        // {
        //     if( $users->email ==  request('email') &&
        //     $users->username == request('username') &&
        //     $users->pincode == request('pincode') )
        //     {
        //         //flash('Sorry! the record already exists in database.')->error()->important();
        //         //return redirect('/index')->with('message','Sorry! the record already exists in database.');
        //         return "Sorry! the record already exists in database.";
        //     }
        // }    
        // // return redirect('/index')->with('message','Sorry! the record already exists');

        // $user->save();
    }

    public static function mail()
    {
        $logger = new Logger('create_new');

        $logger->pushHandler(new StreamHandler(__DIR__.'/logs/mylog.log', Logger::INFO));
        $logger->pushHandler(new FirePHPHandler());
        
        $logger->info('EMAIL SENT!');

        $logger_err = new Logger('create_new_error');

        $logger_err->pushHandler(new StreamHandler(__DIR__.'/logs/mylog.log', Logger::ERROR));
        $logger_err->pushHandler(new FirePHPHandler());
        
        $logger_err->info('EMAIL NOT SENT!');
    }

  
}