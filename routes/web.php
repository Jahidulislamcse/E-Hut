<?php


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard', 'Index')->name('admindashboard');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category', 'Index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
        Route::post('/admin/store-category', 'StoreCategory')->name('store_category');
        Route::get('/admin/edit-category/{id}', 'EditCategory')->name('editcategory');
        Route::post('/admin/update_category', 'UpdateCategory')->name('update_category');
        Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deletecategory');

    });

    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-subcategory', 'Index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}', 'EditSubCategory')->name('editsubcategory');
        Route::get('/admin/delete-subcategory/{id}', 'DeleteSubCategory')->name('deletesubcategory');
        Route::post('/admin/update_subcategory', 'UpdateSubCategory')->name('update_subcategory');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-product', 'Index')->name('allproduct');
        Route::get('/admin/add-product', 'AddProduct')->name('addproduct');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order', 'Index')->name('pendingorder');
        Route::get('/admin/completed-order', 'CompletedOrder')->name('completedorder');
        Route::get('/admin/canceled-order', 'CanceledOrder')->name('canceledorder');
    });
});



require __DIR__.'/auth.php';
