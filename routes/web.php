<?php

Use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordManager;
use App\Models\changes;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('LandingPage');
Route::post('/login', [AuthController::class, 'login'])->name('Login');
Route::get('/logout', [AuthController::class, 'logout'])->name('Logout');
Route::get('/signup', [AuthController::class, 'signup'])->name('SignupPage');
Route::post('/register',[AuthController::class, 'register'])->name('ResgiterUser');

Route::get('/dashboard', function(){
    if(Auth::check()){
        $currId = Auth::id();
        $recentChanges = changes::where('userId', '=', $currId)->orderBy('created_at', 'desc')->get();
        return view('profile.dashboard', ['recentChanges' => $recentChanges]);
    }
    return redirect('/')->withFail('Please Login To continue...');

});

Route::get('/generate', [PasswordManager::class, 'generate'])->name('GenerateRandomPassword');
Route::get('/check', [PasswordManager::class, 'check'])->name('CheckCredentials');
Route::get('/edit/{id}', [PasswordManager::class, 'editCred'])->name('editCredentials');
Route::delete('/delete/{id}', [PasswordManager::class, 'delete'])->name('deleteCredentials');
Route::post('/addtoVault', [PasswordManager::class, 'addPassword'])->name('AddPasswordToVault');
Route::post('/decrypt', [PasswordManager::class, 'decrypt'])->name('decryptPassword');


