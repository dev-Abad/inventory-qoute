<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\QuotationController;

Route::resource('inventory', InventoryController::class);
Route::get('quotation', [QuotationController::class, 'index'])->name('quotation.index');
Route::post('quotation/generate', [QuotationController::class, 'generateQuotation'])->name('quotation.generate');

Route::get('/inventory/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::post('/inventory/update/{id}', [InventoryController::class, 'update'])->name('inventory.update');
