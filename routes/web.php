<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'Index')->name('homepage');
});


Route::controller(ClientController::class)->group(function(){
    Route::get('/register', 'Register')->name('register');
    Route::get('/category/{id}/{slug}', 'Category')->name('category');
    Route::get('/product-details/{id}/{slug}', 'SingleProduct')->name('single_product');
    Route::get('/new-release', 'NewRelease')->name('new_release');
});

Route::middleware('auth')->group(function(){
    Route::controller(ClientController::class)->group(function(){
        Route::get('/add-to-cart', 'AddToCart')->name('add_to_cart');
        Route::post('/add-product-to-cart/{id}', 'AddProductToCart')->name('add_product_to_cart');
        Route::get('/checkout', 'Checkout')->name('checkout');
        Route::post('/add-shipping-info', 'AddShippingInfo')->name('addshippinginfo');
        Route::get('/ordersummery', 'Ordersummery')->name('ordersummery');
        Route::get('/customer-service', 'CustomerService')->name('customer_service');
        Route::get('/todays-deal', 'TodaysDeal')->name('todays_deal');
        Route::get('/user-profile', 'UserProfile')->name('user_profile');
        Route::get('/pending-orders', 'PendingOrders')->name('pendingorders');
        Route::get('/user-profile/history', 'History')->name('history');
        Route::get('/remove-from-cart/{id}', 'RemoveFromCart')->name('removefromcart');
        Route::post('/place-order', 'PlaceOrder')->name('placeorder');


    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
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
        Route::post('/admin/store-product', 'StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product_image/{id}', 'EditProductImage')->name('editproduct_image');
        Route::post('/admin/update-productimage', 'UpdateProductImage')->name('updateproductimage');
        Route::get('/admin/edit-product/{id}', 'EditProduct')->name('editproduct');
        Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
        Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}', 'DeleteProduct')->name('deleteproduct');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order', 'Index')->name('pendingorder');
        Route::get('/admin/completed-order', 'CompletedOrder')->name('completedorder');
        Route::get('/admin/canceled-order', 'CanceledOrder')->name('canceledorder');
        Route::get('/admin/deliver-order/{id}', 'Deliver')->name('deliver');
    });
});


require __DIR__.'/auth.php';
