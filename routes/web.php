<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('home');
Route::get('/product', 'ProductController@index')->name('guestProductIndex');
Route::get('/product/detail/{id}', 'ProductController@detailProduct')->name('guestProductDetail');
Route::get('/dashboard/testimonial/', 'TestimonialController@index')->name('testimonialIndex');
Route::get('/dashboard/testimonial/delete/{id}', 'TestimonialController@deleteTestimonial')->name('testimonialDelete');
Route::post('/testimonial/create', 'TestimonialController@createTestimonial')->name('testimonialUserCreate');

Route::prefix('rajaongkir')->group(function(){
  Route::get('/city/{id}', 'RajaOngkirController@getCity')->name('city');
  Route::get('/service/{cityId}/{courierId}', 'RajaOngkirController@getService')->name('service');
});

Route::middleware('auth')->group(function(){
  Route::prefix('payment')->group(function(){
    Route::get('/add/{id}', 'PaymentController@addPayment')->name('addPayment');
    Route::post('/create/{id}', 'PaymentController@createPayment')->name('createPayment');
  });
  Route::get('/invoice/{id}', 'Admin\InvoiceController@index')->name('checkoutInvoice');
});

Route::middleware('auth')->namespace('User')->group(function(){
  Route::group(['middleware' => ['role:user']], function(){
    Route::prefix('cart')->group(function(){
      Route::get('/', 'CartController@index')->name('cartUserIndex');
      Route::get('/create/{id}', 'CartController@createCart')->name('cartUserCreate');
      Route::Get('/delete/{id}', 'CartController@deleteCart')->name('cartUserDelete');
    });

    Route::prefix('checkout')->group(function(){
      Route::get('/add', 'CheckoutController@addCheckout')->name('checkoutUserAdd');
      Route::post('/create', 'CheckoutController@createCheckout')->name('checkoutUserCreate');
    });

    Route::prefix('invoice')->group(function(){
      Route::get('/', 'InvoiceController@index')->name('invoiceUserIndex');
    });
  });
});

Route::middleware('auth')->namespace('Admin')->prefix('dashboard')->group(function() {
  Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
  
    Route::prefix('product')->group(function() {
      Route::get('/', 'ProductController@index')->name('productIndex');
      Route::get('/add', 'ProductController@addProduct')->name('productAdd');
      Route::get('/edit/{id}', 'ProductController@editProduct')->name('productEdit');
      Route::get('delete/{id}', 'ProductController@deleteProduct')->name('productDelete');
      Route::post('store', 'ProductController@storeProduct')->name('productStore');
      Route::post('update/{id}', 'ProductController@updateProduct')->name('productUpdate');
    });
  
    Route::prefix('user')->group(function() {
      Route::get('/', 'UserController@index')->name('userIndex');
      Route::get('/add', 'UserController@addUser')->name('userAdd');
      Route::get('/edit/{id}', 'UserController@editUser')->name('userEdit');
      Route::get('/delete/{id}', 'UserController@deleteUser')->name('userDelete');
      Route::post('/create', 'UserController@createUser')->name('userCreate');
      Route::post('/update/{id}', 'UserController@updateUser')->name('userUpdate');
    });
  
    Route::prefix('admin')->group(function() {
      Route::get('/', 'AdminController@index')->name('adminIndex');
      Route::get('/add', 'AdminController@addAdmin')->name('adminAdd');
      Route::get('/edit/{id}', 'AdminController@editAdmin')->name('adminEdit');
      Route::get('/delete/{id}', 'AdminController@deleteAdmin')->name('adminDelete');
      Route::post('/create', 'AdminController@createAdmin')->name('adminCreate');
      Route::post('/update/{id}', 'AdminController@updateAdmin')->name('adminUpdate');
    });
  
    Route::prefix('schedule')->group(function() {
      Route::get('/', 'ScheduleController@index')->name('scheduleIndex');
      Route::get('/calendar', 'ScheduleController@indexCalendar')->name('scheduleCalendar');
      Route::get('/add', 'ScheduleController@addSchedule')->name('scheduleAdd');
      Route::get('/detail/{id}', 'ScheduleController@detailSchedule')->name('scheduleDetail');
      Route::get('/status/{id}', 'ScheduleController@statusSchedule')->name('scheduleStatus');
      Route::get('/edit/{id}', 'ScheduleController@editSchedule')->name('scheduleEdit');
      Route::get('/delete/{id}', 'ScheduleController@deleteSchedule')->name('scheduleDelete');
      Route::post('/create', 'ScheduleController@createSchedule')->name('scheduleCreate');
      Route::post('/update/{id}', 'ScheduleController@updateSchedule')->name('scheduleUpdate');
  
      Route::prefix('cart')->group(function() {
        Route::get('/', 'CartController@index')->name('cartIndex');
        Route::get('add/{id}', 'CartController@addCart')->name('cartAdd');
        Route::get('edit/{id}', 'CartController@editCart')->name('cartEdit');
        Route::get('delete/{id}', 'CartController@deleteCart')->name('cartDelete');
        Route::post('create/{id}', 'CartController@createCart')->name('cartCreate');
        Route::post('update/{id}', 'CartController@updateCart')->name('cartUpdate');
  
        Route::prefix('checkout')->group(function() {
          Route::get('/{id}', 'CheckoutController@cartCheckout')->name('checkoutCart');
          Route::get('/confirm/{id}', 'CheckoutController@confirmationCheckout')->name('checkoutConfirmation');
          Route::post('/create/{id}', 'CheckoutController@createCheckout')->name('checkoutCreate');
        });
      });
    });

    Route::prefix('checkout')->group(function() {
      Route::get('/', 'CheckoutController@index')->name('checkoutIndex');
      Route::get('/detail/{id}', 'CheckoutController@detailCheckout')->name('checkoutDetail');
    });
  });
});
