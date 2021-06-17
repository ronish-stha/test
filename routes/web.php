<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Admin\BannerAdController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Admin\SellerProductController as SProductController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;


/*----------------------------------------------------Frontend--------------------------------------------------------*/

Route::resource('/cart', CartController::class);
Route::get('checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::post('empty/cart', [CartController::class, 'emptyCart'])->name('cart.empty');
//    Route::get('wishlist/{id}', [WishListController::class, 'add'])->name('wishlist.add');
//    Route::get('empty/wishlist', [WishListController::class, 'emptyWishList'])->name('wishlist.empty');
//    Route::resource('wishlist', WishListController::class);
    Route::get('about', [IndexController::class, 'about'])->name('about');
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::post('search', [ProductController::class, 'productSearch'])->name('product.search');
    Route::post('location', [IndexController::class, 'location'])->name('location');
    Route::get('categories', [IndexController::class, 'categories'])->name('categories');
    Route::post('contact', [IndexController::class, 'contact'])->name('contact.post');
    Route::get('product/{category}/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('category/{id}', [ProductController::class, 'categoryProduct'])->name('category.product');
    Route::get('store/{id}', [ProductController::class, 'sellerProducts'])->name('store.product');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('products/filter', [ProductController::class, 'filter'])->name('product.filter');
    Route::get('vendor/product/{productId}/{volumeId}', [ProductController::class, 'getSellerProductVariants'])->name('product.vendor');
    Route::post('offer-redeem/{id}', [IndexController::class, 'redeemOffer'])->name('offer.redeem');
    Route::post('coupon-redeem', [IndexController::class, 'redeemCoupon'])->name('coupon.redeem');
    Route::get('/contact', function () {
        return view('frontend.contact');
    })->name('contact');
});

/*----------------------------------------------------Frontend--------------------------------------------------------*/


/*-----------------------------------------------------Admin----------------------------------------------------------*/
Route::get('admin/login', [UserController::class, 'getAdminLogin'])->name('admin.login');
Route::post('admin/login', [UserController::class, 'postAdminLogin'])->name('admin.post.login');
Route::group(['prefix' => 'admin', 'middleware' => 'roles', 'roles' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('admin/edit', 'admin.edit_credentials')->name('admin.edit');
    Route::post('admin/edit', [UserController::class, 'update'])->name('admin.update');
    Route::resource('products', ProductsController::class);
    Route::get('subcategory/{id}', [CategoryController::class, 'getSubCategory'])->name('subcategory');
    Route::resource('category', CategoryController::class)->except([
        'create', 'edit'
    ]);
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order-new', [OrderController::class, 'newOrders'])->name('order.new.index');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('order/{id}/approve', [OrderController::class, 'approve'])->name('order.approve');
    Route::get('order/{id}/deliver', [OrderController::class, 'deliver'])->name('order.deliver');
    Route::resource('sales', SalesController::class);
    Route::get('review/status/{id}', [ReviewController::class, 'changeStatus'])->name('review.status');
    Route::resource('banner', BannerController::class);
    Route::get('change-password', [UserController::class, 'password'])->name('password');
    Route::resource('customer', CustomerController::class);
    Route::post('seller/{id}/verify', [SellerController::class, 'verify'])->name('admin.seller.verify');
    Route::post('seller/{id}/deactivate', [SellerController::class, 'deactivate'])->name('admin.seller.deactivate');
    Route::resource('sellers', SellerController::class);
    Route::post('logout', [UserController::class, 'adminLogout'])->name('admin.logout');
    Route::get('seller-product', [SProductController::class, 'index'])->name('admin.seller-product.index');
    Route::get('seller-product/{id}', [SProductController::class, 'show'])->name('admin.seller-product.show');
    Route::post('seller-product/{id}/accept', [SProductController::class, 'accept'])->name('admin.seller-product.accept');
    Route::post('seller-product/{id}/accept-old', [SProductController::class, 'acceptOld'])->name('admin.seller-product.accept-old');
    Route::resource('content', ContentController::class);
    Route::resource('banner-ad', BannerAdController::class);
});
Route::resource('review', ReviewController::class);

/*-----------------------------------------------------Admin----------------------------------------------------------*/

Route::get('user/verify/{token}', [UserController::class, 'verifyUser'])->name('user.verify');

/*-----------------------------------------------------Seller----------------------------------------------------------*/

Route::group(['prefix' => 'seller'], function () {
    Route::view('login', 'seller.login')->name('seller.login');
    Route::post('login', [AuthController::class, 'login'])->name('seller.login.post');
    Route::view('register', 'seller.register')->name('seller.register');
    Route::post('register', [AuthController::class, 'register'])->name('seller.register.store');
    Route::group(['middleware' => 'roles', 'roles' => ['seller', 'admin']], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('seller.logout');
        Route::get('verify', [SellerDashboardController::class, 'verify'])->name('seller.verify');
        Route::post('verify', [SellerDashboardController::class, 'verifySeller'])->name('seller.verify.account');
        Route::group(['middleware' => 'can:isVerifiedSeller'], function () {
            Route::get('dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');
            Route::view('edit', 'seller.edit_credentials')->name('seller.edit');
            Route::post('edit', [UserController::class, 'update'])->name('seller.update');
            Route::post('product-volume-table', [SellerProductController::class, 'productVolumeTable'])->name('seller.product-volume-table');
            Route::post('product-volume-table-old', [SellerProductController::class, 'oldProductVolumeTable'])->name('seller.product-volume-table-old');
            Route::get('seller-product/type', [SellerProductController::class, 'selectProductType'])->name('seller-product.type');
            Route::post('seller-product/add', [SellerProductController::class, 'add'])->name('seller-product.add');
//            Route::get('seller-product/add/{id}', [SellerProductController::class, 'add'])->name('seller-product.add');
            Route::post('seller-product/store-old', [SellerProductController::class, 'storeOld'])->name('seller-product.store-old');
            Route::get('seller-product/view/spv/{id}', [SellerProductController::class, 'viewSellerProductVariant'])->name('seller-product.view-seller-product-variant');
            Route::get('seller-product/view/pv/{id}', [SellerProductController::class, 'viewProductVariant'])->name('seller-product.view-product-variant');
            Route::get('seller-product/edit/spv/{id}', [SellerProductController::class, 'editSellerProductVariant'])->name('seller-product.edit-seller-product-variant');
            Route::get('seller-product/edit/pv/{id}', [SellerProductController::class, 'editProductVariant'])->name('seller-product.edit-product-variant');
            Route::post('seller-product/update/spv/{id}', [SellerProductController::class, 'updateSellerProductVariant'])->name('seller-product.update-seller-product-variant');
            Route::post('seller-product/update/pv/{id}', [SellerProductController::class, 'updateProductVariant'])->name('seller-product.update-product-variant');
            Route::post('seller-product/delete/bulk', [SellerProductController::class, 'bulkDelete'])->name('seller-product.delete-bulk');
            Route::resource('seller-product', SellerProductController::class);
            Route::get('seller-order', [SellerOrderController::class, 'index'])->name('seller-order.index');
            Route::get('seller-order/{id}', [SellerOrderController::class, 'show'])->name('seller-order.show');
            Route::post('seller-order/{id}/approve', [SellerOrderController::class, 'approve'])->name('seller-order.approve');

//        Route::resource('products', ProductsController::class);
//        Route::get('subcategory/{id}', [CategoryController::class, 'getSubCategory'])->name('subcategory');
            /*Route::resource('category', CategoryController::class)->except([
                'create', 'edit'
            ]);*/
//        Route::get('order', [OrderController::class, 'index'])->name('order.index');
//        Route::get('order-new', [OrderController::class, 'newOrders'])->name('order.new.index');
//        Route::get('order/{id}', [OrderController::class, 'show'])->name('order.show');
//        Route::get('order/{id}/approve', [OrderController::class, 'approve'])->name('order.approve');
//        Route::get('order/{id}/deliver', [OrderController::class, 'deliver'])->name('order.deliver');
//        Route::resource('sales', SalesController::class);
//        Route::get('review/status/{id}', [ReviewController::class, 'changeStatus'])->name('review.status');
//        Route::resource('banner', BannerController::class);
//        Route::get('change-password', [UserController::class, 'password'])->name('password');
//        Route::resource('customer', CustomerController::class);
//        Route::post('logout', [UserController::class, 'sellerLogout'])->name('seller.logout');
        });
    });
});

/*-----------------------------------------------------Seller----------------------------------------------------------*/


/*-----------------------------------------------------Customer----------------------------------------------------------*/

Route::view('login', 'frontend.account.login')->name('login');
Route::post('login', [UserController::class, 'customerLogin'])->name('customer.login');
Route::view('signup', 'frontend.pages.signup')->name('signup');
Route::view('login', 'frontend.pages.signup')->name('login');
Route::post('signup', [UserController::class, 'customerSignup'])->name('customer.signup');
Route::post('logout', [UserController::class, 'logout'])->name('customer.logout');
Route::group(['middleware' => 'roles', 'roles' => ['customer', 'admin']], function () {
    Route::get('account', [AccountController::class, 'account'])->name('account');
    Route::post('update/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::view('change-password', 'frontend.account.change_password')->name('password.change');
    Route::get('order/detail/{id}', [AccountController::class, 'orderDetail'])->name('order.detail');
    Route::get('orders', [AccountController::class, 'orders'])->name('orders');
    Route::post('change-password', [AccountController::class, 'updatePassword'])->name('update.password');
    Route::get('details/edit', [AccountController::class, 'edit'])->name('details.edit');
    Route::post('address/update', [AccountController::class, 'updateAddress'])->name('address.update');
    Route::get('payment', [TransactionController::class, 'payment'])->name('payment');
    Route::get('cancel', [TransactionController::class, 'cancel'])->name('payment.cancel');
    Route::get('payment/success', [TransactionController::class, 'success'])->name('payment.success');
    Route::view('thankyou', 'frontend.pages.thankyou')->name('thankyou');
    Route::post('checkout', [TransactionController::class, 'postCheckout'])->name('post.checkout');
});
Route::get('password/reset', [PasswordResetController::class, 'getResetLinkForm'])->name('password.form');
Route::post('password/email', [PasswordResetController::class, 'sendResetEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'getResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

//Route::view('thankyou', 'frontend.pages.thankyou');

Route::get('storage-link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'linked';
});

Route::get('email', function () {
   \Illuminate\Support\Facades\Mail::to('stharonish@gmail.com')->send(new \App\Mail\InvoiceTestMail()) ;
});

/*Route::get('payment-successful', function () {
    $order = Order::find(1);

    return view('frontend.pages.payment-success', compact('order'));
});

Route::view('check', 'frontend.pages.invoice');*/
Route::view('checker', 'frontend.pages.emailinvoice');

/*-----------------------------------------------------Customer----------------------------------------------------------*/



