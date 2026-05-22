<?php

use App\Http\Controllers\ExportController;
use App\Livewire\Admin\ArchiveDetail;
use App\Livewire\Admin\ArchiveList;
use App\Livewire\Admin\OrderDashboard;
use App\Livewire\Admin\OrderList;
use App\Livewire\Admin\PlatformManager;
use App\Livewire\Admin\TrashArchiveList;
use App\Livewire\Admin\TrashOrderList;
use App\Livewire\Admin\UserManager;
use App\Livewire\PublicOrderForm;
use Illuminate\Support\Facades\Route;

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
        Route::get('/orders', OrderList::class)->name('admin.orders');
        Route::get('/archives', ArchiveList::class)->name('admin.archives');
        Route::get('/archives/{id}', ArchiveDetail::class)->name('admin.archives.detail');
        Route::get('/trash', TrashOrderList::class)->name('admin.trash');
        Route::get('/trash/archives', TrashArchiveList::class)->name('admin.trash.archives');
        Route::get('/platforms', PlatformManager::class)->name('admin.platforms');
        Route::get('/users', UserManager::class)->name('admin.users');
    });

    Route::get('/export/excel', [ExportController::class, 'excel'])->name('admin.export.excel');
    Route::get('/export/pdf', [ExportController::class, 'pdf'])->name('admin.export.pdf');
});
