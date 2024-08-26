<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\UserrolesController;
use App\Http\Controllers\Api\TopicsController;
use App\Http\Controllers\Api\TemplatesController;
use App\Http\Controllers\Api\SignaturesController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\DocumentsignaturesController;
use App\Http\Controllers\Api\DocumentsController;
use App\Http\Controllers\Api\Document_valuesController;
use App\Http\Controllers\Api\ClassificationsController;
use App\Http\Controllers\Api\Template_parametersController;


use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Rutas protegidas
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('auth', [AuthController::class, 'getAuthenticatedUser']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);


    // Otras rutas protegidas
    Route::apiResource('users', UsersController::class);

    Route::apiResource('Roles', RolesController::class);
    Route::apiResource('Userroles', UserrolesController::class);
    
    Route::apiResource('Topics', TopicsController::class);
    Route::apiResource('Classifications', ClassificationsController::class);
    Route::apiResource('Templates', TemplatesController::class);
    Route::apiResource('Templates_parameters', Template_parametersController::class);
    Route::apiResource('Signatures', SignaturesController::class);
    
    Route::apiResource('Documents', DocumentsController::class);
    Route::apiResource('Document_values', Document_valuesController::class);
    Route::apiResource('Documentsignatures', DocumentsignaturesController::class);   
    
    

    Route::get('/generate-pdf-example', [PDFController::class, 'generatePDFExample']);
    Route::post('/generate-pdf', [PDFController::class, 'generatePDF']);
    Route::get('/generate-pdf/{document_id}', [PDFController::class, 'getPdf']);
    

});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');