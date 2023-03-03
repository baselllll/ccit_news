<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SupporterController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;



Route::group(['prefix'=>RouteServiceProvider::ADMIN], function (){
    \Illuminate\Support\Facades\Config::set('auth.defines', 'admin');
    Route::get('login',[AdminAuthController::class, 'getLogin'])->name('admin.getLogin');
    Route::post('authenticateAdmin',[AdminAuthController::class, 'authenticateAdmin'])
        ->name('admin.authenticateAdmin');
    Route::group(['middleware'=>'admin:admin'], function (){
        Route::any('logout',[AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/',[DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::group(['prefix'=>'admins'], function (){
            Route::get('index',[AdminsController::class, 'index'])
                ->middleware('permission:list_admin')
                ->name('admin.admins.index');

            Route::get('getAll',[AdminsController::class, 'getAll'])
                ->middleware('permission:list_admin')
                ->name('admin.admins.getAll');

            Route::get('show',[AdminsController::class, 'show'])
                ->middleware('permission:list_admin')
                ->name('admin.admins.show');

            Route::post('store',[AdminsController::class, 'store'])
                ->middleware('permission:create_admin')
                ->name('admin.admins.store');

            Route::post('update',[AdminsController::class, 'update'])
                ->middleware('permission:edit_admin')
                ->name('admin.admins.update');

            Route::post('changeStatus',[AdminsController::class, 'changeStatus'])
                ->middleware('permission:edit_admin')
                ->name('admin.admins.changeStatus');

            Route::delete('delete',[AdminsController::class, 'delete'])
                ->middleware('permission:delete_admin')
                ->name('admin.admins.delete');
        });

        Route::group(['prefix'=>'roles'], function (){
            Route::get('index',[AdminRoleController::class, 'index'])
                ->middleware('permission:list_role')
                ->name('admin.roles.index');

            Route::get('getAll',[AdminRoleController::class, 'getAll'])
                ->middleware('permission:list_role')
                ->name('admin.roles.getAll');

            Route::get('show',[AdminRoleController::class, 'show'])
                ->middleware('permission:list_role')
                ->name('admin.roles.show');

            Route::post('store',[AdminRoleController::class, 'store'])
                ->middleware('permission:create_role')
                ->name('admin.roles.store');

            Route::post('update',[AdminRoleController::class, 'update'])
                ->middleware('permission:edit_role')
                ->name('admin.roles.update');

            Route::delete('delete',[AdminRoleController::class, 'delete'])
                ->middleware('permission:delete_role')
                ->name('admin.roles.delete');
        });

        Route::group(['prefix'=>'general-settings'], function (){
            Route::get('index',[GeneralSettingsController::class, 'index'])
                ->middleware('permission:list_settings')
                ->name('admin.settings.index');

            Route::post('update',[GeneralSettingsController::class, 'update'])
                ->middleware('permission:edit_settings')
                ->name('admin.settings.update');

        });
        Route::group(['prefix'=>'contact-us'], function (){
            Route::get('index',[ContactUsController::class, 'index'])
                ->middleware('permission:list_admin')
                ->name('admin.contact.index');

            Route::get('delete/{id}',[ContactUsController::class, 'delete'])
                ->middleware('permission:delete_admin')
                ->name('admin.contact.delete');
        });
        Route::group(['prefix'=>'about-us'], function (){
            Route::get('index',[AboutUsController::class, 'index'])
                ->middleware('permission:list_admin')
                ->name('admin.about.index');
            Route::post('store',[AboutUsController::class, 'store'])
                ->middleware('permission:create_admin')
                ->name('admin.about.store');
            Route::post('update',[AboutUsController::class, 'update'])
                ->middleware('permission:edit_admin')
                ->name('admin.about.update');
            Route::get('delete/{id}',[AboutUsController::class, 'delete'])
                ->middleware('permission:delete_admin')
                ->name('admin.about.delete');
        });
        Route::group(['prefix'=>'support'], function (){
            Route::get('index',[SupporterController::class, 'index'])
                ->middleware('permission:list_admin')
                ->name('admin.support.index');
            Route::post('store',[SupporterController::class, 'store'])
                ->middleware('permission:create_admin')
                ->name('admin.support.store');
            Route::post('update',[SupporterController::class, 'update'])
                ->middleware('permission:edit_admin')
                ->name('admin.support.update');
            Route::get('delete/{id}',[SupporterController::class, 'delete'])
                ->middleware('permission:delete_admin')
                ->name('admin.support.delete');
        });
        Route::group(['prefix'=>'category'], function (){
            Route::get('index',[CategoryController::class, 'index'])
                ->middleware('permission:list_admin')
                ->name('admin.category.index');
            Route::post('store',[CategoryController::class, 'store'])
                ->middleware('permission:create_admin')
                ->name('admin.category.store');
            Route::post('update',[CategoryController::class, 'update'])
                ->middleware('permission:edit_admin')
                ->name('admin.category.update');

            Route::get('delete/{id}',[CategoryController::class, 'delete'])
                ->middleware('permission:delete_admin')
                ->name('admin.category.delete');
        });

    });
});
