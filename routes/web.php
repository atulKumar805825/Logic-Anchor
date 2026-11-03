<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\VaultController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\User\WiseController;

Route::middleware('guest')->group(function () {
    
    Route::get('/login',[AuthController::class,'login'])->name('login');
    
     Route::get('/',[AuthController::class,'login'])->name('login');

   
    Route::get('/signup',[AuthController::class,'register'])->name('signup');
    
    Route::post('/stripe/checkout',[StripeController::class,'checkout'])->name('store.checkout');
    Route::get('/stripe/success',[StripeController::class,'success'])->name('stripe.success');
    Route::post('/vault/create-account', [StripeController::class,'createAccount'])->name('vault.create.account');
    
    
    Route::get('quiz', [VaultController::class,'quiz'])->name('user.quiz');
    Route::get('/vault-certification-data/payment', [VaultController::class,'quizPayment'])->name('user.payment');
    Route::post('/vault/start-payment', [VaultController::class,'startPayment'])->name('vault.start.payment');
    
    
    
    
    Route::post('/login',[AuthController::class,'loginPost'])->name('login.post');
    
    
    Route::post('/signup',[AuthController::class,'registerPost'])->name('register.post');
    
    Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('forgot.password');
    Route::post('/forgot-password',[AuthController::class,'forgotPasswordPost'])->name('forgot.password.post');
    
    Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('password.reset');
    Route::post('/reset-password',[AuthController::class,'resetPasswordPost'])->name('reset.password.post');

});

// Route::any('/get_access_token', [WiseController::class, 'get_access_token']);


// Route::get('/checkout-page', [WiseController::class, 'checkout_page'])->name('wise.checkout.page');

// Route::post('/checkout/wise', [WiseController::class, 'checkout'])->name('wise.checkout');

// Route::get('/payment/success', [WiseController::class, 'success'])->name('wise.success');

// Route::get('/payment/cancel', [WiseController::class, 'cancel'])->name('wise.cancel');

Route::get('/stripe/cancel',[StripeController::class,'cancel'])->name('stripe.cancel');
    
Route::post('/vault-certification/initial-audit', [VaultController::class,'saveInitialAudit'])
    ->name('vault.initial.audit');

Route::get('/vault-certification/payment', [VaultController::class, 'paymentPage'])->name('vault.payment.page');
Route::post('/vault-certification/payment-submit', [VaultController::class, 'paymentSubmit'])->name('vault.payment.submit');



Route::post('/certificate', [VaultController::class, 'generate'])->name('create-ceritificate');







Route::middleware('auth')->group(function(){
    
    Route::get('/vault',[VaultController::class,'vault'])->name('valut');
    Route::get('inventory-download/{id}', [VaultController::class,'downloadInventoryNew'])
    ->name('inventory.download-data');

    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

 
 
    
    Route::get('/download/audit-report', [VaultController::class,'downloadAudit'])->name('audit.report.download');
    Route::get('/download/certificate', [VaultController::class,'downloadCertificate'])->name('certificate.download');
    Route::get('/download/stress-protocol', [VaultController::class,'downloadStress'])->name('stress.protocol.download');
    
    Route::get('user/dashboard',[DashboardController::class,'dashboard'])
    ->name('customer.dashboard');
    
});


   


Route::middleware(['auth','admin'])->group(function(){
    
    Route::get('/admin/dashboard',[AdminDashboardController::class,'index'])
    ->name('admin.dashboard');
    
    // Route to update questionnaire status and payment
    Route::patch('/admin/users/questionnaire/{id}/update', [App\Http\Controllers\Admin\UserController::class, 'updateQuestionnaireStatus'])
    ->name('admin.users.questionnaire.status');

    Route::post('/admin/phase-upload',[App\Http\Controllers\Admin\UserController::class,'phaseUpload'])->name('admin.phase.upload');
    Route::post('/admin/phase-status',[App\Http\Controllers\Admin\UserController::class,'phaseStatus'])->name('admin.phase.status');
    Route::post('/admin/phase-status-toogle',[App\Http\Controllers\Admin\UserController::class,'phaseToggle'])->name('admin.phase.toggle');


    
    Route::prefix('admin')->group(function () {
    
        Route::resource('audit-questions', \App\Http\Controllers\Admin\AuditQuestionController::class)
            ->names('admin.audit.questions');
            
        
        
        Route::get('/users',[UserController::class,'index'])->name('admin.users');
        
        Route::get('/users/view/{id}',[UserController::class,'show'])->name('admin.users.view');
        
        Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('admin.users.edit');
        
        Route::post('/users/update/{id}',[UserController::class,'update'])->name('admin.users.update');
        
        Route::delete('/users/delete/{id}',[UserController::class,'destroy'])->name('admin.users.delete');
        
    
    });

});

