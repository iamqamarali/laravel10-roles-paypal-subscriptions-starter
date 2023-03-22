<?php

use App\Http\Controllers\Admin\AmazonProductsController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\NewSubscriberController;
use App\Http\Controllers\OnlineArbitrageLead\CheckoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 

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

require __DIR__ . '/auth.php';


/**
 * admin dashboard
 */
Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('users', UsersController::class);
    Route::get('dashboard', [AdminPagesController::class, 'dashboard'])->name('dashboard');
});



                

/**
 * customer area
 */
Route::get('/', [PagesController::class, 'dashboard'])->name('dashboard');

// paypal routes
Route::post('/subscription/initiate', [SubscriptionController::class, 'initiateSubscription'])->name('subscription.initiate');
Route::get('/subscription/success', [SubscriptionController::class, 'success'])->name('subscription.success');
Route::get('/subscription/failed', [SubscriptionController::class, 'failed'])->name('subscription.failed');

// new Account
Route::get('/new-subscriber/change-password', [NewSubscriberController::class, 'changePasswordView'])->name('newsubscriber.change-password-view');
Route::post('/new-subscriber/change-password', [NewSubscriberController::class, 'changePassword'])->name('newsubscriber.change-password');
