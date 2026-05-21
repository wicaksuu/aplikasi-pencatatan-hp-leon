<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\OrderDashboard;
use App\Livewire\Admin\OrderList;
use App\Livewire\Admin\PlatformManager;
use App\Http\Controllers\ExportController;

use App\Livewire\PublicOrderForm;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/input', PublicOrderForm::class)->name('input');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', OrderDashboard::class)->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/orders', \App\Livewire\Admin\OrderList::class)->name('admin.orders');
        Route::get('/archives', \App\Livewire\Admin\ArchiveList::class)->name('admin.archives');
        Route::get('/archives/{id}', \App\Livewire\Admin\ArchiveDetail::class)->name('admin.archives.detail');
        Route::get('/trash', \App\Livewire\Admin\TrashOrderList::class)->name('admin.trash');
        Route::get('/trash/archives', \App\Livewire\Admin\TrashArchiveList::class)->name('admin.trash.archives');
        Route::get('/platforms', \App\Livewire\Admin\PlatformManager::class)->name('admin.platforms');
    });

    Route::get('/export/excel', [ExportController::class, 'excel'])->name('admin.export.excel');
    Route::get('/export/pdf', [ExportController::class, 'pdf'])->name('admin.export.pdf');
});
