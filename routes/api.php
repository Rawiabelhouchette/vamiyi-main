<?php

use App\Services\Paiement\PaiementService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::match(['get', 'post'], '/payment/notify', [PaiementService::class, 'notify'])->name('payment.notification');

Route::post('/payment/return', [PaiementService::class, 'afterPayment'])->name('payment.return');
