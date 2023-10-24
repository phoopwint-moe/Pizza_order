<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserController as ControllersUserController;
use App\Models\Order;

Route::middleware('admin_auth')->group(function(){
    //login, register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    //admin
    Route::middleware('admin_auth')->group(function(){
        //dashboard
        Route::get('adminDashboard', [AdminController::class, 'dashboard'])->name('admin#dashboard');
        //category
        Route::prefix('category')->group(function(){
            Route::get('listPage', [CategoryController::class , 'listPage'])-> name('cat#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('cat#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('cat#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('cat#delete');
            Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('cat#edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('cat#update');
        });
        //products
        Route::prefix('product')->group(function(){
            Route::get('listPage', [ProductController::class, 'listPage'])->name('product#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}' , [ProductController::class, 'delete'])->name('product#delete');
            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product#detail');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#editPage');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('product#update');
        });
        // account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            
            //account
            Route::get('info',[AdminController::class, 'info'])->name('acc#info');
            Route::get('edit', [AdminController::class, 'edit'])->name('acc#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('acc#update');

            //list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changerole', [AdminController::class, 'changeRole'])->name('ajax#changerole');
        });
        Route::prefix('user')->group(function(){
            Route::get('list', [ControllersUserController::class, 'listPage'])->name('useracc#list');
            Route::get('changerole', [ControllersUserController::class, 'changeRole'])->name('ajax#userchangerole');
            Route::get('delete/{id}', [ControllersUserController::class, 'delete'])->name('user#delete');
        });

        //order
        Route::prefix('order')->group(function(){
            Route::get('list', [OrderController::class, 'listPage'])->name('admin#orderList');
            Route::get('sort', [OrderController::class, 'sort'])->name('ajax#sortOrder');
            Route::get('change', [OrderController::class, 'change'])->name('ajax#changeStatus');
            Route::get('detail/{orderCode}', [OrderController::class, 'detail'])->name('order#detail');
            Route::get('delete/{orderCode}', [OrderController::class, 'delete'])->name('order#delete');
        });

        //contact 
        Route::prefix('contact')->group(function(){
            Route::get('list', [ContactController::class, 'list'])->name('admin#contact');
            Route::get('delete/{id}', [ContactController::class, 'delete'])->name('admin#contactDelete');
        });
    });
    

    //user 
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function(){
        Route::get('home', [UserController::class, 'home'])->name('user#home');
        Route::get('filter/{catID}', [UserController::class, 'filter'])->name('cat#filter');
        Route::get('order', [UserController::class, 'order'])->name('user#order');
        Route::get('detail/{orderCode}', [UserController::class, 'Orderdetail'])->name('user#orderdetail');

        //pizza
        Route::prefix('pizza')->group(function(){
            Route::get('detail/{id}', [UserController::class,'detail'])->name('user#pizzaDetail');
        });
        
        //account
        Route::prefix('account')->group(function(){
            Route::get('info', [UserController::class, 'info'])->name('useracc#info');
            Route::get('edit', [UserController::class, 'edit'])->name('useracc#edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('useracc#update');
        });

        //password
        Route::prefix('password')->group(function(){
            Route::get('change', [UserController::class, 'changePage'])->name('useracc#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('useracc#changepassword');
        });

        //cart
        Route::prefix('cart')->group(function(){
            Route::get('list', [CartController::class, 'listPage'])->name('cart#list');
            Route::get('delete/{id}', [CartController::class, 'delete'])->name('cart#delete');
            Route::get('deleteAll', [CartController::class, 'deleteAll'])->name('cart#deleteAll');
        });

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizza', [AjaxController::class, 'pizza'])->name('ajax#pizza');
            Route::get('cart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('increase/viewCount', [AjaxController::class, 'viewCount'])->name('ajax#increaseViewCount');
        });

        Route::get('checkout/{orderCode}', [OrderController::class, 'checkout'])->name('order#checkout');
        Route::post('order/{orderCode}', [OrderController::class, 'order'])->name('order#update');
        Route::get('order/cancel/{id}', [OrderController::class, 'cancel'])->name('order#cancel');

        //contact
        Route::prefix('contact')->group(function(){
            Route::get('page', [ContactController::class, 'page'])->name('contactPage');
            Route::post('message', [ContactController::class, 'message'])->name('contact#message');
        });
    });
});

//user