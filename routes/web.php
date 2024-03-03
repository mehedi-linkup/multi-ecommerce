<?php

use Illuminate\Support\Facades\Route;

//Frontend/
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\StripeController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\TrackingController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\ChatController;



//Backend
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubsubcategoryController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ProductReviewController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\SubadminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

//Language Routes
Route::get('/language/bangla', [LanguageController::class, 'bangla'])->name('bangla.language');
Route::get('/language/english', [LanguageController::class, 'english'])->name('english.language');

//Product Details
Route::get('/product/details/{id}', [HomeController::class, 'show'])->name('product.details');

//Product tags  Details
Route::get('/product/tag/{tag}', [HomeController::class, 'tagWiseProduct'])->name('product.tag.wise');

//Product Subategory Wise  Details
Route::get('/subcategory/product/{id}', [HomeController::class, 'subCatWiseProduct'])->name('product.subcategory.wise');
//Product Sub Subategory Wise  Details
Route::get('/subsubcategory/product/{id}', [HomeController::class, 'subSubCatWiseProduct'])->name('product.subsubcategory.wise');


//Product View Modal Ajax  Routes
Route::get('/product/view/modal/{id}', [HomeController::class, 'productViewAjax'])->name('product.view.modal.ajax');

//Product Cart Store with Ajax  Routes
Route::post('/product/cart/store/{id}', [CartController::class, 'store'])->name('product.cart.store');

//Product Mini with Ajax  Routes
Route::get('/product/mini/cart', [CartController::class, 'miniCart'])->name('product.mini.cart');
Route::get('/mini/cart/remove/{rowId}', [CartController::class, 'miniCartRemove'])->name('product.mini.cart.remove');

//Add to Wishlist with Ajax  Routes
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'addToWishlist'])->name('product.add.wishlist');

//Cart  Routes
Route::get('/product/carts', [CartController::class, 'index'])->name('product.carts');
Route::get('/get-cart-product', [CartController::class, 'getAllCart'])->name('product.get.cart');
Route::get('/cart-remove/{rowId}', [CartController::class, 'cartDestroy'])->name('product.cart.remove');
Route::get('/cart-increment/{rowId}', [CartController::class, 'cartIncrement'])->name('product.cart.increment');
Route::get('/cart-decrement/{rowId}', [CartController::class, 'cartDecrement'])->name('product.cart.decrement');

//Coupon  Routes
Route::post('/coupon-apply', [CartController::class, 'couponApply'])->name('product.coupon.apply');
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation'])->name('product.coupon.calculation');
Route::get('/coupon-remove', [CartController::class, 'couponRemove'])->name('product.coupon.remove');

//Checkout Routes
Route::get('/product/checkout', [CartController::class, 'checkout'])->name('product.checkout');

//Shop Routes
Route::get('/shop', [ShopController::class, 'index'])->name('product.shop');
Route::post('/shop/filter', [ShopController::class, 'shopFilter'])->name('product.shop.filter');



//LARAVEL SOCIALITE ROUTES
//------------------------
//login with google route
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//login with facebook route
Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

//Order Tracking Routes
Route::post('/order/tracking', [TrackingController::class, 'index'])->name('order.tracking');

//Product Search Routes
Route::get('/product/search', [SearchController::class, 'search'])->name('search.product');
Route::post('/product/get', [SearchController::class, 'productGet'])->name('get.product');



Auth::routes();

//User Dashboard Routes
Route::group(['prefix'=>'user','middleware' => ['user','auth']], function(){
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/update/data', [UserDashboardController::class, 'update'])->name('user.profile.update');
    Route::get('/images', [UserDashboardController::class, 'imagePage'])->name('user.images');
    Route::post('/image/update', [UserDashboardController::class, 'imageUpdate'])->name('user.image.update');
    Route::get('/password/edit', [UserDashboardController::class, 'passwordEdit'])->name('user.password.edit');
    Route::post('/password/update', [UserDashboardController::class, 'passwordUpdate'])->name('user.password.update');
    
    //Wishlist Routes
    Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/get-wishlist-product', [WishlistController::class, 'getWishlistProduct'])->name('get.wishlist.product');
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'removeWishlist'])->name('remove.wishlist.product');
    
    //Checkout Routes
    Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'getDistrict'])->name('user.get.district');
    Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'getState'])->name('user.get.state');
    Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('user.checkout.store');
    
    //Stripe Payment Routes
    Route::post('/stripe/order/store', [StripeController::class, 'store'])->name('stripe.order.store');
    
    //Orders Routes
    Route::get('/orders', [UserDashboardController::class, 'orderShow'])->name('orders.show');
    Route::get('/order/details/{id}', [UserDashboardController::class, 'orderDetails'])->name('orders.details');
    Route::get('/order/invoice/{id}', [UserDashboardController::class, 'invoice'])->name('orders.invoice');
    
    //Returns Order Routes
    Route::post('/return/order/store/{id}', [UserDashboardController::class, 'returnOrderStore'])->name('user.return.order');
    Route::get('/return/order/show', [UserDashboardController::class, 'returnOrderShow'])->name('user.return.order.show');
    Route::get('/cancel/order', [UserDashboardController::class, 'cancelOrder'])->name('user.cancel.order');
    
    //User Product Review Routes
    Route::get('/review/create/{product_id}', [ReviewController::class, 'create'])->name('user.review.create');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('user.review.store');
});

//Admin Dashboard Routes
Route::group(['prefix'=>'admin','middleware' => ['admin','auth','permission']], function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    //Profile Routes
    Route::get('/profiles', [AdminDashboardController::class, 'profile'])->name('admin.profiles');
    Route::post('/update/info', [AdminDashboardController::class, 'update'])->name('admin.profile.update');
    Route::get('/edit/image', [AdminDashboardController::class, 'editImage'])->name('admin.image.edit');
    Route::post('/update/image', [AdminDashboardController::class, 'updateImage'])->name('admin.image.update');
    Route::get('/change/password', [AdminDashboardController::class, 'password'])->name('admin.passwords');
    Route::post('/update/password', [AdminDashboardController::class, 'updatePassword'])->name('admin.password.update');
    
    //Read All User Routes
    Route::get('/all-users', [AdminDashboardController::class, 'allUsers'])->name('admin.all.users');
    //Banned User Routes
    Route::get('/user/banned/{id}', [AdminDashboardController::class, 'banned'])->name('admin.user.banned');
    Route::get('/user/unbanned/{id}', [AdminDashboardController::class, 'unbanned'])->name('admin.user.unbanned');
    
    //Brand Routes
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::post('/brand/delete', [BrandController::class, 'delete'])->name('admin.brand.delete');
    
    //Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
    
    //Sub Category Routes
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('admin.subcategories');
    Route::get('/subcategory/create', [SubcategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::post('/subcategory/delete', [SubcategoryController::class, 'delete'])->name('admin.subcategory.delete');
    
    //Sub Subcategory Routes
    Route::get('/subsubcategories', [SubsubcategoryController::class, 'index'])->name('admin.subsubcategories');
    Route::get('/subcategory/get/{subcate_id}', [SubsubcategoryController::class, 'getSubCate'])->name('admin.subcategory.get');
    Route::get('/subsubcategory/create', [SubsubcategoryController::class, 'create'])->name('admin.subsubcategory.create');
    Route::post('/subsubcategory/store', [SubsubcategoryController::class, 'store'])->name('admin.subsubcategory.store');
    Route::get('/subsubcategory/edit/{id}', [SubsubcategoryController::class, 'edit'])->name('admin.subsubcategory.edit');
    Route::post('/subsubcategory/update/{id}', [SubsubcategoryController::class, 'update'])->name('admin.subsubcategory.update');
    Route::post('/subsubcategory/delete', [SubsubcategoryController::class, 'delete'])->name('admin.subsubcategory.delete');
    
    //Product Routes
    Route::get('/products', [ProductsController::class, 'index'])->name('admin.products');
    Route::get('/product/create', [ProductsController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductsController::class, 'store'])->name('admin.product.store');
    Route::get('/product/show/{id}', [ProductsController::class, 'show'])->name('admin.product.show');
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('admin.product.update');
    Route::post('/product/delete', [ProductsController::class, 'delete'])->name('admin.product.delete');
    Route::get('/product/inactive/{id}', [ProductsController::class, 'inActive'])->name('admin.product.inactive');
    Route::get('/product/active/{id}', [ProductsController::class, 'active'])->name('admin.product.active');
    //get category & subcategory routes
    Route::get('/subcategory/get/{subcat_id}', [ProductsController::class, 'getSubCate'])->name('admin.get.subcat');
    Route::get('/sub-subcategory/get/{subsubcat_id}', [ProductsController::class, 'getSubsubCate'])->name('admin.get.subsubcat');
    
    //Slider Routes
    Route::get('/sliders', [SliderController::class, 'index'])->name('admin.sliders');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('admin.slider.create');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::post('/slider/delete', [SliderController::class, 'delete'])->name('admin.slider.delete');
    Route::get('/slider/inactive/{id}', [SliderController::class, 'inactive'])->name('admin.slider.inactive');
    Route::get('/slider/active/{id}', [SliderController::class, 'active'])->name('admin.slider.active');
    
    //Coupon Routes
    Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::post('/coupon/update/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::post('/coupon/delete', [CouponController::class, 'delete'])->name('admin.coupon.delete');
    
    //Division Routes
    Route::get('/divisions', [ShippingAreaController::class, 'index'])->name('admin.divisions');
    Route::get('/division/create', [ShippingAreaController::class, 'create'])->name('admin.division.create');
    Route::post('/division/store', [ShippingAreaController::class, 'store'])->name('admin.division.store');
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'edit'])->name('admin.division.edit');
    Route::post('/division/update/{id}', [ShippingAreaController::class, 'update'])->name('admin.division.update');
    Route::post('/division/delete', [ShippingAreaController::class, 'delete'])->name('admin.division.delete');
    
    //District Routes
    Route::get('/districts', [ShippingAreaController::class, 'indexDistrict'])->name('admin.districts');
    Route::get('/district/create', [ShippingAreaController::class, 'createDistrict'])->name('admin.district.create');
    Route::post('/district/store', [ShippingAreaController::class, 'storeDistrict'])->name('admin.district.store');
    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'editDistrict'])->name('admin.district.edit');
    Route::post('/district/update/{id}', [ShippingAreaController::class, 'updateDistrict'])->name('admin.district.update');
    Route::post('/district/delete', [ShippingAreaController::class, 'deleteDistrict'])->name('admin.district.delete');
    
    //State Routes
    Route::get('/states', [ShippingAreaController::class, 'indexState'])->name('admin.states');
    Route::get('/state/create', [ShippingAreaController::class, 'createState'])->name('admin.state.create');
    Route::get('/district-get/ajax/{id}', [ShippingAreaController::class, 'getDistrict'])->name('admin.get.district');
    Route::post('/state/store', [ShippingAreaController::class, 'storeState'])->name('admin.state.store');
    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'editState'])->name('admin.state.edit');
    Route::post('/state/update/{id}', [ShippingAreaController::class, 'updateState'])->name('admin.state.update');
    Route::post('/state/delete', [ShippingAreaController::class, 'deleteState'])->name('admin.state.delete');
    
    //Order Routes
    Route::get('/pending-order', [OrderController::class, 'pendingOrder'])->name('admin.pending.orders');
    Route::get('/order/show/{id}', [OrderController::class, 'show'])->name('admin.show.order');
    Route::get('/order/confirm', [OrderController::class, 'confirmOrder'])->name('admin.confirm.order');
    Route::get('/order/processing', [OrderController::class, 'processingOrder'])->name('admin.processing.order');
    Route::get('/order/picked', [OrderController::class, 'pickedOrder'])->name('admin.picked.order');
    Route::get('/order/shipped', [OrderController::class, 'shippedOrder'])->name('admin.shipped.order');
    Route::get('/order/delivered', [OrderController::class, 'deliveredOrder'])->name('admin.delivered.order');
    Route::get('/order/canceled', [OrderController::class, 'canceledOrder'])->name('admin.canceled.order');
    
    //Status Update Routes
    Route::post('/pending-to/confirm', [OrderController::class, 'pendingToConfirm'])->name('admin.pending.to.confirm');
    Route::get('/pending-to/canceled/{id}', [OrderController::class, 'pendingToCanceled'])->name('admin.pending.to.canceled');
    Route::get('/confirm-to/processing/{id}', [OrderController::class, 'confirmToProcessing'])->name('admin.confirm.to.processing');
    Route::get('/processing-to/picked/{id}', [OrderController::class, 'processingToPicked'])->name('admin.processing.to.picked');
    Route::get('/picked-to/shipped/{id}', [OrderController::class, 'pickedToShipped'])->name('admin.picked.to.shipped');
    Route::get('/shipped-to/delivered/{id}', [OrderController::class, 'shippedToDelivered'])->name('admin.shipped.to.delivered');
    //Order Invoice Routes
    Route::get('/invoice/download/{id}', [OrderController::class, 'downloadInvoice'])->name('admin.invoice.download');
    
    //Reports Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::post('/report/by-date', [ReportController::class, 'reportByDate'])->name('admin.report.by.date');
    Route::post('/report/by-month', [ReportController::class, 'reportByMonth'])->name('admin.report.by.month');
    Route::post('/report/by-year', [ReportController::class, 'reportByYear'])->name('admin.report.by.year');
    
    //Customer Review Routes
    Route::get('/reviews', [ProductReviewController::class, 'index'])->name('customer.reviews');
    Route::get('/review/approved/{id}', [ProductReviewController::class, 'approved'])->name('customer.review.approved');
    Route::post('/review/delete', [ProductReviewController::class, 'delete'])->name('customer.review.delete');
    
    //Stock Management Routes
    Route::get('/product/stock', [StockController::class, 'index'])->name('product.stock');
    Route::get('/product/stock/edit/{id}', [StockController::class, 'edit'])->name('product.stock.edit');
    Route::post('/product/stock/update/{id}', [StockController::class, 'update'])->name('product.stock.update');
    
    //Role & Permission Routes
    Route::resource('/role', RoleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/subadmin', SubadminController::class);
    
});

// SSLCOMMERZ Start
Route::group(['middleware' => ['user','auth']], function(){
    
    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
});
//SSLCOMMERZ END

//User Buyer
Route::group(['middleware' => 'auth'], function(){
    Route::post('send-message',[ChatController::class,'sendMsg'])->name('send.msg');
    Route::get('my-chat',[ChatController::class,'chatPage'])->name('chat.page');
    Route::get('user-all',[ChatController::class,'getAllUsers'])->name('chat.users');
    Route::get('user-messages/{id}',[ChatController::class,'useMsgById'])->name('user.msg');
});