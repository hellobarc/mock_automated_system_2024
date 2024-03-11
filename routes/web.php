<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpeakingTimeController;
use App\Http\Controllers\Register\{
    StudentRegistrationController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login2');
});

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/


Route::middleware(['auth', 'user-access:register'])->group(function () {
  
    Route::get('/register/home', [HomeController::class, 'registerHome'])->name('register.home');

    Route::controller(StudentRegistrationController::class)->group(function(){
        Route::get('/candidate/register-form', 'candidateForm')->name('candidate.form');
        Route::post('/candidate/register-form-store', 'candidateFormStore')->name('candidate.form.store');
        Route::get('/candidate-list', 'candidateList')->name('candidate.list');
        Route::get('/candidate-edit/{id}', 'candidateEdit')->name('candidate.edit');
        Route::post('/candidate-edit-store', 'candidateEditStore')->name('candidate.edit.store');
        Route::get('/candidate-delete/{id}', 'candidateDelete')->name('candidate.delete');
        Route::post('/purchase-new-mock', 'purchaseNewMock')->name('buy.new.mock');
        
    });

    Route::post('/get-time-slots',[SpeakingTimeController::class,'speakingTimeSlots'])->name('something-like-that');
});

Route::middleware(['auth', 'user-access:assessor'])->group(function () {
  
    Route::get('/assessor/home', [HomeController::class, 'assessorHome'])->name('aassessordmin.home');

});

Route::middleware(['auth', 'user-access:moderator'])->group(function () {
  
    Route::get('/moderator/home', [HomeController::class, 'moderatorHome'])->name('moderator.home');

});

Route::middleware(['auth', 'user-access:editor'])->group(function () {
  
    Route::get('/editor/home', [HomeController::class, 'editorHome'])->name('editor.home');

});

Route::middleware(['auth', 'user-access:accounts'])->group(function () {
  
    Route::get('/accounts/home', [HomeController::class, 'accountsHome'])->name('accounts.home');

});

Route::middleware(['auth', 'user-access:invigilator'])->group(function () {
  
    Route::get('/invigilator/home', [HomeController::class, 'invigilatorHome'])->name('invigilator.home');

});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

});