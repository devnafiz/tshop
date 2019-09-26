<?php
use App\Events\Event;

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
Route::get('/','IndexController@index');
Route::get('/products/{url}','productController@products');
//product details 
Route::get('/product/{id}','productController@product');
//get atttributes price
Route::get('/get-product-price','productController@getProductPrice');

//add cart 
Route::match(['get','post'],'/add-cart','productController@addtoCart');
//cart page
Route::match(['get','post'],'/cart','productController@cart');
//Delete cart product
Route::get('/cart/delete-product/{id}','productController@deleteCartProduct');
//update cart quantity
Route::get('/cart/update-quantity/{id}/{quantity}','productController@updateCartQuantity');

//apply coupon
Route::post('/cart/apply-coupon','productController@applyCoupon');

// register login
Route::get('/register-login','UsersController@userLoginRegister');
Route::post('/user-register','UsersController@register');
Route::match(['get','post'],'/forgot-password','UsersController@forgotPassword');
//user login
Route::post('/user-login','UsersController@login');
Route::get('/user-logout','UsersController@logout');
//contact form
Route::match(['get','post'],'/contact-us','FrontendController@contactUs');

// user acount

Route::group(['middleware'=>['frontlogin']],function(){
     Route::match(['get','post'],'/account','UsersController@account');
     //check user  current password
     Route::post('/check-user-pwd','UsersController@chkUserPassword');
     Route::post('/update-user-pwd','UsersController@updatePassword');

     //check out page
      Route::match(['get','post'],'/checkout','productController@checkout');
      //order review
      Route::match(['get','post'],'/orderReview','productController@orderReview');
      //place Order
      Route::match(['get','post'],'/place-order','productController@placeOrder');
      //Thanks page
      Route::get('/thanks','productController@thanks');
      //paypal
      Route::get('/paypal','productController@paypal');
      //user oder page
      Route::get('/orders','productController@userOrders');
      Route::get('/orders/{id}','productController@userOrderDetails');


});


//Route::match(['get','post'],'/register-login','UsersController@register');
//check mail
Route::match(['get','post'],'/check-email','UsersController@checkEmail');


// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/admin','AdminController@login');
 Route::match(['get','post'],'/admin','AdminController@login');
 Route::group(['middleware'=>['adminlogin']],function(){
 Route::get('/admin/dashboard','AdminController@dashboard');
 Route::get('/admin/settings','AdminController@settings');
 Route::get('/admin/check-pwd','AdminController@chkPassword');
 Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
 // cartegoriy route
 Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
 Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
 Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
 Route::get('/admin/view-category','CategoryController@viewCategory');
 //product
 Route::match(['get','post'],'/admin/add-product','productController@addProduct');
 Route::match(['get','post'],'/admin/edit-product/{id}','productController@editProduct');
 Route::get('/admin/view-product','productController@viewProduct');
 Route::get('/admin/delete-product-image/{id}','productController@deleteProductImage');
 Route::get('/admin/delete-product/{id}','productController@deleteProduct');
 Route::get('/admin/delete-alt-image/{id}','productController@deleteAltImage');
 // productattribute
 Route::match(['get','post'],'/admin/add-attributes/{id}','productController@addAttributes');
 Route::match(['get','post'],'/admin/edit-attributes/{id}','productController@editAttributes');
 Route::match(['get','post'],'/admin/add-image/{id}','productController@addImage');
 Route::get('/admin/delete-attribute/{id}','productController@deleteAttribute');

  //page 
  Route::match(['get','post'],'/admin/add-page','PageController@addPage');
  Route::get('/admin/view-page','PageController@viewPage');

  // coupon add
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');

Route::get('/admin/view-coupons','CouponsController@viewCoupons');
Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

//banner route
Route::match(['get','post'],'/admin/add-banner','BannerController@addBanner');
Route::get('/admin/view-banner','BannerController@viewBanner');
Route::match(['get','post'],'/admin/edit-banner/{id}','BannerController@editBanner');
Route::get('/admin/delete-banner/{id}','BannerController@deleteBanner');

// Admin Users Route
  Route::get('/admin/view-admin','AdminController@viewAdmin');
  Route::match(['get','post'],'/admin/add-admin','AdminController@addAdmin');
  Route::match(['get','post'],'/admin/edit-admin/{id}','AdminController@editAdmin');

});

Route::get('/logout','AdminController@logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('event',function(){
   event(new Event('Hey How Are You'));

});