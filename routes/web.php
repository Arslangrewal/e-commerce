<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group( function() {

        Route::get('/', 'index'); 
        Route::get('/collections', 'categories'); 
        Route::get('/collections/{category_slug}','products'); 
        Route::get('/collections/{category_slug}/{product_slug}', 'productView'); 

        Route::get('/new-arrival', 'newArrival');
        Route::get('search', 'searchProduct');
});
//------------------Wishlist--------------------//
Route::middleware(['auth'])->group(function(){

    Route::get('wishlist',[WishlistController::class,'index']);
    Route::get('cart',[CartController::class, 'index']);
    Route::get('checkout',[CheckoutController::class,'index']);
    Route::get('order',[OrderController::class, 'index']);
    Route::get('order/{order_id}',[OrderController::class, 'show']);
    
    Route::get('profile',[App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile',[App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);

    Route::get('change-password',[App\Http\Controllers\Frontend\UserController::class, 'passwordCreate']);
    Route::post('change-password',[App\Http\Controllers\Frontend\UserController::class, 'changePassword']);
});

       //----------------Home----------------//
Route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class,'thankYou']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
    //------------------Admin-----------------//

Route::prefix('admin')->middleware('auth', 'isAdmin')->group( function(){

    Route::get('dashboard',[DashboardController::class,'index']);

    Route::get('settings',[SettingController::class,'index']);
    Route::post('setting',[SettingController::class,'store']);

        //------------Category-------------//

        Route::controller(CategoryController::class)->group(function () {
            Route::get('category', 'index');
            Route::get('add/category', 'create');
            Route::post('store/category', 'store');
            Route::get('edit/category/{id}', 'edit');
            Route::put('update/category/{id}', 'update');
            Route::get('category/delete/{id}', 'destroy');
           
    
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('products', 'index');
            Route::get('products/create', 'create');    
            Route::post('save/products', 'store');
            Route::get('product/edit/{id}', 'edit');
            Route::put('update/products/{id}', 'update');
            Route::get('product/delete/{id}', 'destroy');
            Route::get('product-image/delete/{product_image_id}', 'deleteImage');
            
            Route::post('product-color/{prod_color_id}','updateProdColorQty');
            Route::get('product-color/delete/{prod_color_id}', 'deleteProductColor')->name('deleteProdColor');
                            
        });

        Route::controller(ColorController::class)->group(function () {
            Route::get('colors', 'index');
            Route::get('colors/create', 'create');
            Route::post('colors/store', 'store');
            Route::get('color/edit/{id}', 'edit');
            Route::put('colors/update/{id}', 'update');
            Route::get('colors/destroy/{id}', 'destroy');
        });

        Route::controller(SliderController::class)->group(function(){
            Route::get('sliders', 'index'); 
            Route::get('sliders/create', 'create');
            Route::post('sliders/store', 'store');
            Route::get('sliders/edit/{id}', 'edit');
            Route::put('sliders/update/{id}', 'update');
            Route::get('sliders/destroy/{id}', 'destroy');
        });
        
        Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);
         
        Route::controller(AdminOrderController::class)->group(function(){
            Route::get('/orders', 'index');
            Route::get('orders/view/{orderId}', 'show');
            Route::put('orders/view/{orderId}', 'updateOrderStatus');

            Route::get('/invoice/{orderId}', 'viewInvoice');
            Route::get('/invoice/{orderId}/generate', 'generateInvoice');
            Route::get('/invoice/mail/{orderId}', 'mailInvoice');

            // Route::get('/invoice/mail/{orderId}', 'dummyEmail');

            
        });

        Route::controller(UserController::class)->group(function(){
            Route::get('/users', 'index');
            Route::get('/users/create', 'create');
            Route::post('/users', 'store');
            Route::get('users/edit/{id}', 'edit');
            Route::put('users/update/{id}', 'update');
            Route::get('users/destroy/{id}', 'destroy');
        });


});

