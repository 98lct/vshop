<?php

Route::namespace('Guest')->group(function () {
    //trang chủ
    Route::get('/', 'IndexController@index')->name('Home');
    //trang chi tiết sản phẩm
    Route::get('{slug}.html', 'ProductController@show')->name('ProductDetail');
    Route::post('binh-luan','ProductController@conments')->name('conments');
    Route::post('voted','ProductController@voted')->name('voted');
    //giỏ hàng
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@index')->name('IndexCart');
        Route::get('/create/{id}', 'CartController@create')->name('AddCart');
        Route::get('/remove/{rowId}', 'CartController@remove')->name('RemoveCart');
        Route::get('/destroy', 'CartController@destroy')->name('DestroyCart');
        Route::get('/update', 'CartController@update');
    });
    //trang loại sp
    Route::get('category', 'ProductController@all_category');
    Route::post('category', 'ProductController@category')->name('Category');
    //trang thương hiệu
    Route::get('brand', 'ProductController@all_brand');
    Route::post('brand', 'ProductController@brand')->name('Brand');
    //trang bài viết
    Route::get('post', 'PostController@index')->name('Post');
    Route::post('post', 'PostController@loadmore')->name('loadmore');
    //trang chủ đề bài viết
    Route::get('chu-de/{slug}', 'PostController@topic')->name('topic');
    Route::post('chu-de/{slug}', 'PostController@loadmore_topic')->name('loadmore_topic');
    //trang chi tết bài viết
    Route::get('bai-viet/{slug}.html', 'PostController@show')->name('PostDetail');
    //trang tìm kiếm
    Route::get('search', 'ProductController@search')->name('Search');

    //thanh toán
    Route::get('thanh-toan','CheckOutController@index')->name('index.checkout');
    Route::post('diachi','CheckOutController@diachi')->name('diachi.checkout');
    Route::post('laykm','CheckOutController@laykm')->name('laykm.checkout');

    Route::post('thanh-toan', 'CheckOutController@checkout')->name('checkout');
    // liên hệ
    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@postindex')->name('contact');
    //trang so sánh sp
    Route::get('{slug1}&&{slug2}', 'ProductController@sosanh')->name('sosanh');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    //login-logout admin
    Route::get('/', 'HomeController@index')->name('home');
    //admin
    Route::namespace('Admin')->group(function () {
        Route::get('/', 'DashboardController@index');
        //category
        Route::prefix('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('IndexCategory');
            Route::get('/create', 'CategoryController@create');
            Route::post('/create', 'CategoryController@store')->name('AddCategory');
            Route::get('/edit/{id}', 'CategoryController@edit');
            Route::put('/edit/{id}', 'CategoryController@update')->name('EditCategory');
            Route::get('/status/{id}', 'CategoryController@status');
            Route::get('/trash', 'CategoryController@index');
            Route::get('/remove/{id}', 'CategoryController@remove');
            Route::get('/restore/{id}', 'CategoryController@restore');
            Route::delete('/destroy/{id}', 'CategoryController@destroy')->name('DeleteCategory');
        });
        //brand
        Route::prefix('brand')->group(function () {
            Route::get('/', 'BrandController@index')->name('IndexBrand');
            Route::get('/create', 'BrandController@create');
            Route::post('/create', 'BrandController@store')->name('AddBrand');
            Route::get('/edit/{id}', 'BrandController@edit');
            Route::put('/edit/{id}', 'BrandController@update')->name('EditBrand');
            Route::get('/status/{id}', 'BrandController@status');
            Route::get('/trash', 'BrandController@index');
            Route::get('/remove/{id}', 'BrandController@remove');
            Route::get('/restore/{id}', 'BrandController@restore');
            Route::delete('/destroy/{id}', 'BrandController@destroy')->name('DeleteBrand');
        });
        //product
        Route::prefix('product')->group(function () {
            Route::get('/', 'ProductController@index')->name('IndexProduct');
            Route::get('/datatable', 'ProductController@datatable')->name('datatableProduct');
            Route::get('/create', 'ProductController@create');
            Route::post('/create', 'ProductController@store')->name('AddProduct');
            Route::get('/edit/{id}', 'ProductController@edit');
            Route::put('/edit/{id}', 'ProductController@update')->name('EditProduct');
            Route::get('/status/{id}', 'ProductController@status');
            Route::get('/trash', 'ProductController@index');
            Route::get('/remove/{id}', 'ProductController@remove');
            Route::get('/removeall', 'ProductController@remove_all')->name('RemoveProduct');
            Route::get('/restore/{id}', 'ProductController@restore');
            Route::delete('/destroy/{id}', 'ProductController@destroy')->name('DeleteProduct');
        });
        //user
        Route::group(['prefix'=>'user','middleware'=>'role3'],function () {
            Route::get('/', 'UserController@index')->name('IndexUser');
            Route::get('/create', 'UserController@create')->middleware('role4');
            Route::post('/create', 'UserController@store')->name('AddUser');
            Route::get('/edit/{id}', 'UserController@edit');
            Route::put('/edit/{id}', 'UserController@update')->name('EditUser');
            Route::get('/roles/{id}', 'UserController@roles');
            Route::delete('/destroy/{id}', 'UserController@destroy')->name('DeleteUser');
        });
        //menu
        Route::prefix('menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('IndexMenu');
            Route::get('/create', 'MenuController@create');
            Route::post('/create', 'MenuController@store')->name('AddMenu');
            Route::get('/edit/{id}', 'MenuController@edit');
            Route::put('/edit/{id}', 'MenuController@update')->name('EditMenu');
            Route::delete('/destroy/{id}', 'MenuController@destroy')->name('DeleteMenu');
            Route::get('/status/{id}', 'MenuController@status');
        });
        //slider
        Route::prefix('slider')->group(function () {
            Route::get('/', 'SliderController@index')->name('IndexSlider');
            Route::get('/create', 'SliderController@create');
            Route::post('/create', 'SliderController@store')->name('AddSlider');
            Route::get('/edit/{id}', 'SliderController@edit');
            Route::put('/edit/{id}', 'SliderController@update')->name('EditSlider');
            Route::delete('/destroy/{id}', 'SliderController@destroy')->name('DeleteSlider');
            Route::get('/status/{id}', 'SliderController@status');
        });
        //adverts
        Route::prefix('adverts')->group(function () {
            Route::get('/', 'AdvertsController@index')->name('IndexAdverts');
            Route::get('/create', 'AdvertsController@create');
            Route::post('/create', 'AdvertsController@store')->name('AddAdverts');
            Route::get('/edit/{id}', 'AdvertsController@edit');
            Route::put('/edit/{id}', 'AdvertsController@update')->name('EditAdverts');
            Route::delete('/destroy/{id}', 'AdvertsController@destroy')->name('DeleteAdverts');
            Route::get('/status/{id}', 'AdvertsController@status');
        });
        //sites
        Route::get('sites/', 'SitesController@edit')->name('IndexSites');
        Route::put('sites/{id}', 'SitesController@update')->name('EditSites');
        //contact
        Route::get('contact', 'ContactController@index')->name('IndexContact');
        Route::get('contact/reply/{id}', 'ContactController@detail');
        Route::post('contact/reply/{id}', 'ContactController@reply')->name('ReplyContact');
        //topic
        Route::prefix('topic')->group(function () {
            Route::get('/', 'TopicController@index')->name('IndexTopic');
            Route::get('/create', 'TopicController@create');
            Route::post('/create', 'TopicController@store')->name('AddTopic');
            Route::get('/edit/{id}', 'TopicController@edit');
            Route::put('/edit/{id}', 'TopicController@update')->name('EditTopic');
            Route::get('/status/{id}', 'TopicController@status');
            Route::delete('/destroy/{id}', 'TopicController@destroy')->name('DeleteTopic');
        });
        //post
        Route::prefix('post')->group(function () {
            Route::match(['post', 'get'], '/', 'PostController@index')->name('IndexPost');
            Route::get('/create', 'PostController@create');
            Route::post('/create', 'PostController@store')->name('AddPost');
            Route::get('/edit/{id}', 'PostController@edit');
            Route::put('/edit/{id}', 'PostController@update')->name('EditPost');
            Route::get('/status/{id}', 'PostController@status');
            Route::delete('/destroy/{id}', 'PostController@destroy')->name('DeletePost');
        });
        //order
        Route::prefix('order')->group(function () {
            Route::get('/', 'OrderController@index')->name('IndexOrder');
            Route::get('/detail/{id}', 'OrderController@detail');
            Route::post('/status/{id}', 'OrderController@status')->name('StatusOrder');
            Route::delete('/destroy/{id}', 'OrderController@destroy')->name('DeleteOrder');
        });
        //xuất hóa đơn
        Route::get('/export_excel', 'ExportExcelController@index');
        Route::get('/export_excel/{id}', 'ExportExcelController@export')->name('export'); 
        Route::get('/exportc_pdf/{id}', 'PDFController@pdf')->name('PDF');
    });
});

//
