<?php

use App\Edition;
use Illuminate\Support\Facades\Auth;
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


// Route::get('/test1' , function(){


//       Artisan::call("cache:clear");
    
// });
//Route::post('/login' , 'Auth\LoginController@login')->name('test.login');
//Route::get('/register' , 'Auth\RegisterController@showRegistrationForm')->name('test.reg');
//Route::post('/register' , 'Auth\RegisterController@register')->name('register');



Route::group([ 'prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function()
{
    Route::namespace('Web')->name('web.')->group(function(){

        Route::get('/' , 'WebController@home')->name('home');
        Route::get('/ReplacementCases' , 'WebController@ReplacementCases')->name('ReplacementCases');

        Route::group(['middleware' => 'auth:admin,web'] , function (){
            Route::post('book/addfavorite/{bookid}' , 'WebController@addfavorite')->name('addfavorite');
            Route::delete('book/deletefavorite/{bookid}' , 'WebController@deletefavorite')->name('deletefavorite');
            Route::post('book/addcart/{bookid}' , 'WebController@addcart')->name('addcart');
            Route::delete('book/deletecart/{bookid}' , 'WebController@deletecart')->name('deletecart');
            Route::get('/profile' , 'WebController@profile')->name('profile');
            Route::post('/paymob/{id?}' , 'WebController@paymob')->name('paymob');
            Route::get('/processedCallback' , 'WebController@processedCallback')->name('processedCallback');
        });

        Route::get('book/search' , 'WebController@search')->name('search');

        Route::post('login' , 'AuthController@login')->name('login');
        Route::post('logout' , 'AuthController@logout')->name('logout');
        Route::post('register' , 'AuthController@register')->name('register');

        Route::get('/google', 'AuthController@redirectToGoogle')->name('google');
        Route::get('/google/callback', 'AuthController@handleGoogleCallback');

        Route::get('classification/{id}' , 'WebController@getBooksByClassification')->name('getBbyC');
        Route::get('book/{slug}' , 'WebController@getBook')->name('getBook');
        Route::get('reset' , 'AuthController@reset')->name('reset');

        Route::post('forget-password', 'AuthController@ForgetPassword')->name('forget.password');

        Route::post('reset-password/{token}', 'AuthController@ResetPassword')->name('reset.password');

        Route::get('reset-password/{token}/', 'AuthController@showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'AuthController@submitResetPasswordForm')->name('reset.password.post');

        Route::get('/sandbox' , 'WebController@sandbox')->name('sandbox');

    });

    Route::get('admin/login' , 'Admin\AuthController@login_form')->name('admin.login_form');

    Route::post('admin/login' , 'Admin\AuthController@login')->name('admin.login');

    Route::post('admin/logout' , 'Admin\AuthController@logout')->name('admin.logout');

    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('AuthAdmin:admin')->group(function(){

        Route::get('/' , 'BookController@home')->name('home');
        Route::resource('books', 'BookController');
        Route::resource('editions', 'EditionController')->except(['show']);
        Route::resource('shipping', 'ShippingController')->except(['show']);
        Route::resource('classifications', 'ClassificationController')->except(['show']);
        Route::resource('persons', 'CharacterController')->except(['show']);
        Route::get('/sandbox' , 'BookController@sandbox')->name('sandbox');
        Route::get('/orders' , 'BookController@orders')->name('orders');
        Route::get('/sandbox/{id}' , 'BookController@showsandbox')->name('show.sandbox');
        Route::get('/orders/{id}' , 'BookController@showorder')->name('show.order');

        //        Route::resource('topics', 'TopicController')->except(['show']);

    });

});
