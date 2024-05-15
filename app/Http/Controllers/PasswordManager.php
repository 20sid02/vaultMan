<?php

namespace App\Http\Controllers;

use App\Models\changes;
use App\Models\User;
use App\Models\vault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PasswordManager extends Controller
{
    public function encryptPass($string, $username)
    {
        $ciphering = "AES-256-CBC";

        $encryption_iv = '1234567891011121';

        $encryption_key = $username;

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt(
            $string,
            $ciphering,
            $encryption_key,
            0,
            $encryption_iv
        );

        return $encryption;
    }
    public function decryptPass($encryption, $username)
    {

        $decryption_iv = '1234567891011121';
        $decryption_key = $username;
        $ciphering = "AES-256-CBC";

        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt(
            $encryption,
            $ciphering,
            $decryption_key,
            0,
            $decryption_iv
        );
        return $decryption;
    }

    public function decrypt(Request $request){
        $masterkey = $request->input('masterkey');
        $userPass = User::where('id','=',Auth::id())->value('password');
        $userName = Auth::user()->username;

         if(password_verify($masterkey, $userPass)){
            $encryptedPass = $request->input('encryptedPassword');
             $decryptedPass = $this->decryptPass($encryptedPass, $userName);
             return response()->json(["decryptedPassword" => $decryptedPass]);
         }
         else{
             return response()->json(['decryptedPassword' => 'Invalid Master Key']);
         }


    }


    public function check()
    {
        $currId = Auth::id();

        $results = vault::where('userId','=',$currId)->get();
        return view('passMan.checkCred',['results'=>$results]);
        

    }

    public function generate()
    {
        
        // $string = bin2hex(random_bytes((12)));
        // return back()->withSuccess('Your Random secure password = ' . $string);
            $length = 17;
            $symbols = '@#$';
            $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
            $password = '';
            $usedSymbols = 0;
            $usedUppercase = 0;
            $partitionCount = 1;
        
            for ($i = 0; $i < $length; $i++) {
                $char = '';
        
                // Insert dash every 5 characters
                if ($partitionCount > 5 && $partitionCount %6 == 0 && $partitionCount != 17) {
                    $char = '-';
                    $partitionCount++;
                    
                } else {
                    $type = rand(1, 3); // 1: lowercase letter, 2: uppercase letter, 3: symbol
                    switch ($type) {
                        case 1:
                            $char = chr(rand(97, 122)); // lowercase letter
                            $partitionCount++;
                            break;
                        case 2:
                            if ($usedUppercase < 2) {
                                $char = $uppercase[rand(0, strlen($uppercase) - 1)]; // uppercase letter
                                $usedUppercase++;
                                $partitionCount++;
                            } else {
                                $char = chr(rand(97, 122)); // lowercase letter
                                $partitionCount++;
                            }
                            break;
                        case 3:
                            if ($usedSymbols < 1) {
                                $char = $symbols[rand(0, strlen($symbols) - 1)]; // symbol
                                $usedSymbols++;
                                $partitionCount++;
                            } else {
                                $char = chr(rand(97, 122)); // lowercase letter
                                $partitionCount++;
                            }
                            break;
                        default:
                            $char = chr(rand(97, 122)); // lowercase letter
                            $partitionCount++;
                    }
                }
        
                $password .= $char;
            }
        
            return back()->withSuccess('You Random Password is: '.$password);
    }

    public function addPassword(Request $request)
    {
        $request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $vaultDat = $request->all();
        
        vault::create([
            'userId' => Auth::id(),
            'website' => $vaultDat['website'],
            'username'=>$vaultDat['username'],
            'password' => $this->encryptPass($vaultDat['password'], $vaultDat['username'])
            
        ]);

        changes::createRecentChange(Auth::id(), 'create', $vaultDat['website']);
        
        return back()->withSuccess('Credentials added successfully');

    }

    public function edit($id){

    }

    public function delete($id){
        
        $item = vault::where('id', '=', $id)->get()->first();
        $item = $item->website;
        vault::destroy($id);
        
        changes::createRecentChange(Auth::id(), 'delete', $item);
        return back();
    }

}
