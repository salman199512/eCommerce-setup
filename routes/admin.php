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


Route::group(['prefix' => 'admin',
    'middleware' => ['auth',],], function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class, ["as" => 'admin']);
    Route::resource('inquiries', App\Http\Controllers\Admin\InquiryController::class, ["as" => 'admin']);
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class, ["as" => 'admin']);
    Route::resource('newsletters', App\Http\Controllers\Admin\NewsLetterController::class, ["as" => 'admin']);
    Route::resource('contentManagements', App\Http\Controllers\Admin\ContentManagementController::class, ["as" => 'admin']);
    Route::resource('websites', App\Http\Controllers\Admin\WebsiteController::class, ["as" => 'admin']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class, ["as" => 'admin']);
    Route::get('categories-status-change/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'statusChange'])->name('admin.categories.status-change');
    Route::resource('sub-categories', App\Http\Controllers\Admin\SubCategoryController::class, ["as" => 'admin']);
    Route::get('sub-categories-status-change/{subCategory}', [\App\Http\Controllers\Admin\SubCategoryController::class, 'statusChange'])->name('admin.sub-categories.status-change');
    Route::resource('attribute-groups', App\Http\Controllers\Admin\AttributeGroupController::class, ["as" => 'admin']);
    Route::get('attribute-groups-status-change/{attributeGroup}', [\App\Http\Controllers\Admin\AttributeGroupController::class, 'statusChange'])->name('admin.attribute-groups.status-change');
    Route::resource('attributes', App\Http\Controllers\Admin\AttributeController::class, ["as" => 'admin']);
    Route::get('attributes-status-change/{attribute}', [\App\Http\Controllers\Admin\AttributeController::class, 'statusChange'])->name('admin.attributes.status-change');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class, ["as" => 'admin']);
    Route::get('products-status-change/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'statusChange'])->name('admin.products.status-change');
    Route::get('get-attributes', [\App\Http\Controllers\Admin\ProductController::class, 'getAttributes'])->name('admin.products.get-attributes');


    Route::group(['prefix' => 'users', 'as' => 'admin.users.'], function () {
        Route::group(['prefix' => '{user}/change-password', 'as' => 'changePassword.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('index');
            Route::post('process', [\App\Http\Controllers\Admin\UserController::class, 'changePassword_process'])->name('process');
        });
    });
    Route::group(['prefix' => 'roles', 'as' => 'admin.roles.'], function () {
        Route::group(['prefix' => '{role}/manage-permissions', 'as' => 'permissions.manage.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('index');
            Route::post('update', [\App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('update');
        });
    });
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class, ["as" => 'admin'])->except([
        'show', 'edit', 'update'
    ]);

    Route::group(['prefix' => 'user-tokens/{user}', 'as' => 'admin.userTokens.'], function () {
        Route::get('index', [\App\Http\Controllers\Admin\UserTokenController::class, 'index'])->name('index');
        Route::post('generate', [\App\Http\Controllers\Admin\UserTokenController::class, 'generate'])->name('generate');
        Route::delete('destroy/{token}', [\App\Http\Controllers\Admin\UserTokenController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
        Route::post('upload-media', [\App\Http\Controllers\Admin\UploadMediaController::class, 'uploadMedia'])->name('upload');
        Route::post('remove-media', [\App\Http\Controllers\Admin\UploadMediaController::class, 'removeMedia'])->name('remove');
    });
    Route::get('contentManagement-status-change/{contentManagement}', [\App\Http\Controllers\Admin\ContentManagementController::class, 'statusChange'])->name('admin.contentManagements.status-change');

    Route::get('setting', [\App\Http\Controllers\Admin\SettingController::class, 'create'])->name('admin.setting.create');
    Route::post('setting-save', [\App\Http\Controllers\Admin\SettingController::class, 'store'])->name('admin.setting.store');
    });
