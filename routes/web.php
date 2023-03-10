<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Categorie;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Welcome;


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

Route::get('/wel', function () {
    return view('fontend.index');
});
Route::get('/',[Welcome::class, 'welcome'])->name('index');
Route::get('/about',[Welcome::class, 'about'])->name('about');
Route::get('/service',[Welcome::class,'service']);
Route::get('/information',[Welcome::class, 'information']);
Route::get('/master',[Welcome::class, 'master']);
Route::get('/product/details/{slug}',[Welcome::class, 'product_details'])->name('product.details');
Route::post('/getSize',[Welcome::class, 'getSize']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//users
Route::get('/users',[Usercontroller::class, 'users'])->name('user');
Route::get('/user/delete/{user_id}',[Usercontroller::class,'delete'])->name('delete');
Route::get('/profile',[Usercontroller::class,'Profile'])->name('profile');
Route::post('/name/update',[Usercontroller::class,'name_update'])->name('name.update');
Route::post('/password/update',[Usercontroller::class,'pass_update'])->name('pass.update');
Route::post('/uploadimage',[Usercontroller::class,'updatePhoto'])->name('upload.image');
Route::get('/categorie',[Categorie::class, 'categorie'])->name('categorie');
Route::post('/category/store',[Categorie::class,'add_categorie'])->name('add_categorie');
Route::get('/category/delete/{category_id}',[Categorie::class,'category_delete'])->name('category_delete');
Route::get('/category/restore/{categoryRestore_id}',[Categorie::class,'category_restore'])->name('category_restore');
Route::get('/category/fixeddelete/{fixeddelete}',[Categorie::class,'fixed_delete'])->name('fixed_delete');
Route::get('/category/permanentDelete/{categoryRestore_id}',[Categorie::class,'permanent_delete'])->name('permanent_delete');
Route::get('/category/edit/{categoryRestore_id}',[Categorie::class,'caregory_edit'])->name('category.edit');
Route::post('/category/update',[Categorie::class,'caregory_update'])->name('category.update');
Route::get('/subcategory',[SubcategoryController::class,'subcategory'])->name('sub_category');
Route::post('/subcategory/store',[SubcategoryController::class,'subcategory_store'])->name('subcategory.store');
Route::post('/getsubcategory',[SubcategoryController::class,'getsubcategory'])->name('getsubcategory');
Route::get('/add/product',[ProductController::class,'add_product'])->name('add.product');
Route::post('/getSubcategory',[ProductController::class,'getSubcategory']);
Route::get('/add/product',[ProductController::class,'add_products'])->name('add.products');
Route::post('/getSubcategories',[ProductController::class,'getSubcategories']);
Route::post('/product/store',[ProductController::class,'product_store'])->name('product.store');
Route::get('/product/list',[ProductController::class,'product_list'])->name('product.list');
Route::get('/product/edit/{id}',[ProductController::class,'product_edit'])->name('product_edit');
Route::get('/produt/inventory/{product_id}',[ProductController::class,'add_inventory'])->name('add.inventory');
Route::post('/produt/inventory/store',[ProductController::class,'inventory_store'])->name('inventory.store');
Route::get('/product/delete/{product_id}',[ProductController::class,'product_delete'])->name('product.delete');




///Variation/color
Route::get('/produt/variation',[ProductController::class,'add_variation'])->name('add.variation');
Route::post('/add/color',[ProductController::class,'add_color'])->name('add.color');

//Product Sizes



Route::post('/add/sizes',[ProductController::class,'add_size'])->name('add.size');


//font-end
//customer login/Register
Route::get('/customer/register/login',[Welcome::class,'customer_register_login'])->name('customer.register.login');
Route::post('/customer/register',[CustomerRegisterController::class,'customer_store'])->name('customer.store');
Route::post('/customer/login',[CustomerLoginController::class,'customer_login'])->name('customer.login');
Route::get('/customer/login',[CustomerLoginController::class,'customer_logout'])->name('customer.logout');
Route::get('/customer/profile',[CustomerController::class,'customer_profile'])->name('customer.profile');
Route::post('/customer/profile/update',[CustomerController::class,'customer_profile_update'])->name('profile.update');
Route::get('/customer/order',[CustomerController::class,'customer_order'])->name('customer.order');



//Cart
Route::post('/cart/store',[CartController::class,'cart_store'])->name('cart.store');
Route::get('/remove/cart/{cart_id}',[CartController::class,'cart_remove'])->name('remove.cart');
Route::get('/clear/cart',[CartController::class,'clear_cart'])->name('clear.cart');
Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::post('/cart/update',[CartController::class,'update_cart'])->name('update.cart');

//Coupon
Route::get('/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::post('/coupon/store',[CouponController::class,'coupon_store'])->name('coupon.store');

//checkRoute
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/order/store',[CheckoutController::class,'order_store'])->name('order.store');
Route::get('/order/success',[CheckoutController::class,'order_success'])->name('order.success');



