<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\mitra\MitraController;
use App\Http\Controllers\mitra\BrandController;
use App\Http\Controllers\mitra\CategoryController;
use App\Http\Controllers\mitra\DiscountCodeController;
use App\Http\Controllers\mitra\SubCategoryController;
use App\Http\Controllers\mitra\HomeController;
use App\Http\Controllers\mitra\OrderController;
use App\Http\Controllers\mitra\PagesController;
use App\Http\Controllers\mitra\ProductController;
use App\Http\Controllers\mitra\ProductImageController;
use App\Http\Controllers\mitra\ProductSubCategoryController;
use App\Http\Controllers\mitra\ShippingController;
use App\Http\Controllers\mitra\TempImagesController;
use App\Http\Controllers\mitra\UserController;
use App\Http\Controllers\mitra\SettingController;
use App\Http\Controllers\Transportasi\TransportasiController;

// Transportasi
use App\Http\Controllers\Transportasi\Motor\MotorController;
use App\Http\Controllers\Transportasi\Mobil\MobilController;

// Order User
use App\Http\Controllers\Transportasi\Motor\OrderMotorController;
use App\Http\Controllers\Transportasi\Mobil\OrderMobilController;

// Pencairan Controller Mitra
use App\Http\Controllers\Transportasi\Motor\PencairanMotorController;
use App\Http\Controllers\Perlengkapan\PencairanPerlengkapanController;

// Sopir Mitra Mobil
use App\Http\Controllers\Transportasi\Mobil\SopirController;

// Route Order Mitra
use App\Http\Controllers\Perlengkapan\PerlengkapanController;
use App\Http\Controllers\Perlengkapan\OrderPerlengkapanController;
use App\Http\Controllers\Perjalanan\OrderPerjalananController;


// Bank
use App\Http\Controllers\Perlengkapan\BankPerlengkapanController;


use App\Http\Controllers\Perjalanan\PerjalananController;
use App\Http\Controllers\Perjalanan\OrderMeltingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ListMitraController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\CategoriesAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Homestay\HomestayController;
use App\Http\Controllers\Homestay\OrderHomestayController;
use App\Http\Controllers\Homestay\FasilitasController;

// Route User Order
// use App\Http\Controllers\UserOrder\OrderTransportasiController;
use App\Http\Controllers\UserOrder\UserOrderController;
use App\Http\Controllers\UserOrder\UserOrderPerjalananController;
use App\Http\Controllers\UserOrder\UserOrderMotorController;
use App\Http\Controllers\UserOrder\UserOrderMobilController;
use App\Http\Controllers\UserOrder\UserOrderHomestayController;
use App\Http\Controllers\UserOrder\UserOrderPerlengkapanController;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\Booking\BookingPerjalananController;
use App\Models\Fasilitas;
use Doctrine\DBAL\Schema\Index;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Http\Controllers\AiController;
use App\Http\Controllers\EcotourismController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/chat', [AiController::class, 'index'])->name('user.chat');

Route::get('/guide-ai', [AiController::class, 'showChatForm'])->name('user.chat.form');
Route::post('/guide-ai', [AiController::class, 'chat'])->name('user.chat');


// Route::get('/', function () {
// return view('welcome');
// });

// Route::get('/test', function () {
//     orderEmail(20);

// });

Route::get('/', [FrontController::class, 'index'])->name('front.home');
// Route::get('/', [FrontController::class, 'index'])->name('front.maintenance');
// Route::get('/shop/{categorySlug?}/{subCategory?}', [ShopController::class, 'index'])->name('front.shop');
// Route::get('/product/{slug}', [ShopController::class, 'product'])->name('front.product');

Route::get('/cart', [CartController::class, 'index'])->name('front.cart');
Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::delete('/delete-item/{id}', [CartController::class, 'delete'])->name('front.delete.cart');
Route::get('/get-cart-item-count', [CartController::class, 'getCartItemCount'])->name('front.getCartItemCount');

// Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
// Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('front.processCheckout');
// Route::get('/thanks/{orderId}', [CartController::class, 'thankyou'])->name('front.thankyou');
// Route::post('/get-order-summary', [CartController::class, 'getOrderSummary'])->name('front.getOrderSummary');
// Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('front.applyDiscount');
// Route::post('/remove-discount', [CartController::class, 'removeCoupon'])->name('front.removeCoupon');
// Route::post('/add-to-wishlist', [FrontController::class, 'addToWishlist'])->name('front.addToWishlist');
// Route::get('/page/{slug}', [FrontController::class, 'page'])->name('front.page');
// Route::post('/send-contact-email', [FrontController::class, 'sendContactEmail'])->name('front.sendContactEmail');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('front.forgotPassword');
// Route::post('/process-forgot-password', [AuthController::class, 'processForgotPassword'])->name('front.processForgotPassword');
// Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('front.resetPassword');
// Route::post('/process-reset-password', [AuthController::class, 'processResetPassword'])->name('front.processResetPassword');
// Route::post('/save-rating/{productId}', [ShopController::class, 'saveRating'])->name('front.saveRating');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('account.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('account.register');
    Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
    // Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
    // Route::post('/update-address', [AuthController::class, 'updateAddress'])->name('account.updateAddress');

    // Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('account.changePassword');
    // Route::post('/process-change-password', [AuthController::class, 'changePassword'])->name('account.processChangePassword');

    // Route::get('/my-orders', [AuthController::class, 'orders'])->name('account.orders');
    // Route::get('/my-wishlist', [AuthController::class, 'wishlist'])->name('account.wishlist');
    // Route::post('/remove-product-from-wishlist', [AuthController::class, 'removeProductFromWishList'])->name('account.removeProductFromWishList');
    // Route::get('/order-detail/{orderId}', [AuthController::class, 'orderDetail'])->name('account.orderDetail');
    // Route::get('/generate-invoice/{orderId}', [AuthController::class, 'generateInvoice'])->name('account.generateInvoice');
    Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
});


Route::group(['prefix' => 'mitra'], function () {
    Route::group(['middleware' => 'mitra.guest'], function () {
        Route::get('/login', [MitraController::class, 'index'])->name('mitra.login');
        Route::post('/authenticate', [MitraController::class, 'authenticate'])->name('mitra.authenticate');
        Route::get('/register', [MitraController::class, 'register'])->name('mitra.register');
        Route::post('/process-register', [MitraController::class, 'process_register'])->name('mitra.processRegister');
        Route::post('/save-type', [MitraController::class, 'saveType'])->name('mitra.saveType');
    });

    Route::group(['middleware' => 'mitra.auth'], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('mitra.dashboard');
        Route::get('/check-new-orders', [HomeController::class, 'checkNewOrders'])->name('mitra.checkNewOrders');
        Route::get('/logout', [HomeController::class, 'logout'])->name('mitra.logout');
        // Route::get('account', [MitraController::class, 'account'])->name('mitra.account');
        Route::put('update-account', [MitraController::class, 'updateAccount'])->name('mitra.update-account');

        // Grup routing dengan pengecekan jenis pengguna
        Route::group(['middleware' => 'check.mitra.type:perjalanan'], function () {
            Route::get('/perjalanan', [PerjalananController::class, 'index'])->name('mitra.perjalanan.index');
            Route::get('/perjalanan/create', [PerjalananController::class, 'create'])->name('mitra.perjalanan.create');
            Route::get('/perjalanan/detail/{perjalananId}', [PerjalananController::class, 'detail'])->name('mitra.perjalanan.detail');
            Route::post('/perjalanan/store', [PerjalananController::class, 'store'])->name('mitra.perjalanan.store');
            Route::delete('/perjalanan/{perjalananId}', [PerjalananController::class, 'destroy'])->name('mitra.perjalanan.destroy');
            Route::put('/perjalanan/{perjalananId}', [PerjalananController::class, 'update'])->name('mitra.perjalanan.update');

            // Route User Order Perjalanan
            Route::get('/perjalanan/orders', [OrderPerjalananController::class, 'index'])->name('mitra.perjalanan.order');
            Route::get('/perjalanan/orders/{id}', [OrderPerjalananController::class, 'show'])->name('mitra.perjalanan.order.detail');

            Route::get('/perjalanan/pencairan', [OrderMeltingController::class, 'index'])->name('order.perjalanan.pencairan');
        });

        Route::group(['middleware' => 'check.mitra.type:perlengkapan'], function () {
            Route::get('/perlengkapan', [PerlengkapanController::class, 'index'])->name('mitra.perlengkapan.index');
            Route::get('/perlengkapan/create', [PerlengkapanController::class, 'create'])->name('mitra.perlengkapan.create');
            Route::post('/perlengkapan/store', [PerlengkapanController::class, 'store'])->name('mitra.perlengkapan.store');
            Route::get('/perlengkapan/detail-{perlengkapanId}', [PerlengkapanController::class, 'show'])->name('mitra.perlengkapan.detail');
            Route::delete('/perlengkapan/{perlengkapanId}', [PerlengkapanController::class, 'destroy'])->name('mitra.perlengkapan.destroy');
            Route::put('/perlengkapan/{perlengkapanId}', [PerlengkapanController::class, 'update'])->name('mitra.perlengkapan.update');
            
            // Dropoff Perlengkapan
            Route::get('/perlengkapan/dropoff', [PerlengkapanController::class, 'dropoff'])->name('mitra.perlengkapan.dropoff');
            Route::get('/perlengkapan/dropoff/{invoice_id}', [PerlengkapanController::class, 'dropoffDetail'])->name('mitra.perlengkapan.dropoff.detail');
            Route::put('/perlengkapan/dropoff/{invoice_id}', [PerlengkapanController::class, 'dropoffUpdate'])->name('mitra.perlengkapan.dropoff.update');

            // Profil
            Route::get('/perlengkapan/profil', [PerlengkapanController::class, 'profil'])->name('mitra.perlengkapan.profil');
            Route::put('/perlengkapan/profil/{id}', [PerlengkapanController::class, 'updateProfile'])->name('mitra.perlengkapan.profil.update');
            
            // Route Order Mitra Perlengkapan
            Route::get('/perlengkapan/order', [OrderPerlengkapanController::class, 'index'])->name('mitra.perlengkapan.order');
            Route::get('/perlengkapan/order/{id}', [OrderPerlengkapanController::class, 'show'])->name('mitra.perlengkapan.order.detail');

            // Route to show history
            Route::post('/perlengkapan/move-to-history/{id}', [OrderPerlengkapanController::class, 'moveToHistory'])->name('mitra.order.perlengkapan.movetoHistory');

            Route::get('/perlengkapan/history', [PerlengkapanController::class, 'history'])->name('order.perlengkapan.history');
            Route::get('/perlengkapan/history/{id}', [PerlengkapanController::class, 'showHistory'])->name('mitra.perlengkapan.history.booking.detail');

            // Route::post('/perlengkapan/cairin/{id}', [PencairanPerlengkapanController::class, 'cairin'])->name('mitra.order.perlengkapan.moveToCairin');

            Route::get('/perlengkapan/pencairan', [PencairanPerlengkapanController::class, 'index'])->name('mitra.perlengkapan.pencairan');
            Route::get('/perlengkapan/pencairan/{id}', [PencairanPerlengkapanController::class, 'show'])->name('mitra.perlengkapan.pencairan.show');

            // Informasi Bank
            Route::get('/perlengkapan/bank', [BankPerlengkapanController::class, 'index'])->name('mitra.perlengkapan.bank');
            Route::post('/perlengkapan/bank/store', [BankPerlengkapanController::class, 'store'])->name('mitra.perlengkapan.bank.store');
            Route::put('/perlengkapan/bank/{id}', [BankPerlengkapanController::class, 'update'])->name('mitra.perlengkapan.bank.update');
        });

        // Route Transportasi Mobil
        Route::group(['middleware' => ['check.mitra.type:transportasi mobil']], function () {
            Route::get('/mobil', [MobilController::class, 'index'])->name('mitra.mobil');
            Route::get('/mobil/create', [MobilController::class, 'create'])->name('mitra.mobil.create');
            Route::post('/mobil/store', [MobilController::class, 'store'])->name('mitra.mobil.store');
            Route::get('/mobil/detail-{mobilId}', [MobilController::class, 'show'])->name('mitra.mobil.detail');
            Route::delete('/mobil/{mobilId}', [MobilController::class, 'destroy'])->name('mitra.mobil.destroy');

            // Route::post('/transportasi/store', [TransportasiController::class, 'store'])->name('mitra.transportasi.store');

            // Sopir -> Mitra Mobil
            Route::get('/sopir', [SopirController::class, 'index'])->name('mitra.sopir');
            Route::get('/sopir/create', [SopirController::class, 'create'])->name('mitra.sopir.create');
            Route::post('/sopir/store', [SopirController::class, 'store'])->name('mitra.sopir.store');
            Route::get('/sopir/detail-{sopirId}', [SopirController::class, 'show'])->name('mitra.sopir.detail');
            Route::put('/sopir/edit-{id}', [SopirController::class, 'edit'])->name('mitra.sopir.edit');
            Route::delete('/sopir/delete-{id}', [SopirController::class, 'delete'])->name('mitra.sopir.delete');

            // Route Order Mobil -> Mitra Mobil
            Route::get('/mobil/order', [OrderMobilController::class, 'index'])->name('mitra.mobil.order');
            Route::get('/mobil/order/{mobilId}', [OrderMobilController::class, 'show'])->name('mitra.mobil.order.detail');

            // Route::get('/transportasi/detail/{transportasiId}', [TransportasiController::class, 'detail'])->name('mitra.transportasi.detail');
            // Route::delete('/transportasi/{transportasiId}', [TransportasiController::class, 'destroy'])->name('mitra.transportasi.destroy');
            // Route::put('/transportasi/{transportasiId}', [TransportasiController::class, 'update'])->name('mitra.transportasi.update');
            // Route::get('/transportasi/orders', [OrderTransController::class, 'index'])->name('mitra.transportasi.orders');
        });

        // Route Transportasi Motor
        Route::group(['middleware' => 'check.mitra.type:transportasi motor'], function () {
            Route::get('/motor', [MotorController::class, 'index'])->name('mitra.motor');
            Route::get('/motor/create', [MotorController::class, 'create'])->name('mitra.motor.create');
            Route::post('/motor/store', [MotorController::class, 'store'])->name('mitra.motor.store');
            Route::get('/motor/detail-{motorId}', [MotorController::class, 'show'])->name('mitra.motor.detail');
            Route::delete('/motor/{motorId}', [MotorController::class, 'destroy'])->name('mitra.motor.destroy');
            // Route::put('/motor/{transportasiId}', [TransportasiController::class, 'updateMotor'])->name('mitra.transportasi.update.motor');

            // Mitra Order
            Route::get('/order', [OrderMotorController::class, 'index'])->name('mitra.motor.order');
            Route::get('/motor/order/{motorId}', [OrderMotorController::class, 'show'])->name('mitra.motor.order.detail');

            // routes/web.php
            Route::post('/motor/move-to-history/{id}', [OrderMotorController::class, 'moveToHistory'])->name('order.motor.moveToHistory');

            // Route to show history
            Route::get('/motor/history', [MotorController::class, 'history'])->name('order.motor.history');
            Route::get('/motor/history/{id}', [MotorController::class, 'showHistory'])->name('mitra.motor.history.booking.detail');

            // Pencairan
            Route::get('/motor/pencairan', [PencairanMotorController::class, 'index'])->name('order.motor.pencairan');
        });

        Route::group(['middleware' => 'check.mitra.type:transportasi mobil'], function () {
            // Route::get('/transportasi/create/mobil', [TransportasiController::class, 'create_mobil'])->name('mitra.transportasi.create.mobil');
            // Route::get('/sopir', [TransportasiController::class, 'sopir'])->name('mitra.sopir');
            // Route::post('/sopir/simpan', [TransportasiController::class, 'simpan'])->name('mitra.sopir.simpan');
            // Route::put('/sopir/edit/{id}', [TransportasiController::class, 'edit'])->name('mitra.sopir.edit');
            // Route::delete('/sopir/hapus/{id}', [TransportasiController::class, 'hapus'])->name('mitra.sopir.hapus');
        });

        Route::group(['middleware' => 'check.mitra.type:homestay'], function () {
            Route::get('/homestay', [HomestayController::class, 'index'])->name('mitra.homestay.index');
            Route::get('/homestay/create', [HomestayController::class, 'create'])->name('mitra.homestay.create');
            Route::post('/homestay/store', [HomestayController::class, 'store'])->name('mitra.homestay.store');
            Route::delete('/homestay/{homestayId}', [HomestayController::class, 'destroy'])->name('mitra.homestay.destroy');
            Route::put('/homestay/{homestayId}', [HomestayController::class, 'update'])->name('mitra.homestay.update');

            Route::get('/homestay/orders', [OrderHomestayController::class, 'index'])->name('mitra.homestay.order');
            Route::get('/homestay/orders/{id}', [OrderHomestayController::class, 'show'])->name('mitra.homestay.order.detail');

            Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('homestay.fasilitas.index');
            Route::post('/fasilitas/store', [FasilitasController::class, 'store'])->name('mitra.fasilitas.store');
            Route::put('/fasilitas/{fasilitasId}', [FasilitasController::class, 'update'])->name('mitra.fasilitas.update');

            // Setting
            Route::get('homestay/setting', [HomestayController::class, 'setting'])->name('homestay.setting');
        });
        // Category Routes
        // Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        // Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        // Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        // Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        // Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        // Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');
        // Route::get('/categories/export/excel', [CategoryController::class, 'export_excel'])->name('categories.export_excel');
        // Route::post('/categories/import/excel', [CategoryController::class, 'import_excel'])->name('categories.import_excel');
        // Route::get('/categories/export/pdf', [CategoryController::class, 'export_pdf'])->name('categories.export_pdf');

        // Sub Category Routes
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
        Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        Route::get('/sub-categories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
        Route::put('/sub-categories/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
        Route::delete('/sub-categories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.delete');
        Route::get('/sub-categories/export/excel', [SubCategoryController::class, 'export_excel'])->name('sub-categories.export_excel');
        Route::post('/sub-categories/import/excel', [SubCategoryController::class, 'import_excel'])->name('sub-categories.import_excel');
        Route::get('/sub-categories/export/pdf', [SubCategoryController::class, 'export_pdf'])->name('sub-categories.export_pdf');

        // Brand Routes
        Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.delete');
        Route::get('/brands/export/excel', [BrandController::class, 'export_excel'])->name('brands.export_excel');
        Route::post('/brands/import/excel', [BrandController::class, 'import_excel'])->name('brands.import_excel');
        Route::get('/brands/export/pdf', [BrandController::class, 'export_pdf'])->name('brands.export_pdf');

        // Product Routes
        // Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        // Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        // Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        // Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        // Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        // Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
        // Route::get('/get-products', [ProductController::class, 'getProducts'])->name('products.getProducts');
        // Route::get('/products/export/excel', [ProductController::class, 'export_excel'])->name('products.export_excel');
        // Route::post('/products/import/excel', [ProductController::class, 'import_excel'])->name('products.import_excel');
        // Route::get('/products/export/pdf', [ProductController::class, 'export_pdf'])->name('products.export_pdf');

        // Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');

        // Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        // Route::delete('/product-images', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        //Shipping Route
        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::put('/shipping{id}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::delete('/shipping{id}', [ShippingController::class, 'destroy'])->name('shipping.delete');
        Route::get('/shipping/export/excel', [ShippingController::class, 'export_excel'])->name('shipping.export_excel');
        Route::post('/shipping/import/excel', [ShippingController::class, 'import_excel'])->name('shipping.import_excel');
        Route::get('/shipping/export/pdf', [ShippingController::class, 'export_pdf'])->name('shipping.export_pdf');

        //Coupon Route
        Route::get('/coupons', [DiscountCodeController::class, 'index'])->name('coupons.index');
        Route::get('/coupons/create', [DiscountCodeController::class, 'create'])->name('coupons.create');
        Route::post('/coupons', [DiscountCodeController::class, 'store'])->name('coupons.store');
        Route::get('/coupons/{coupon}/edit', [DiscountCodeController::class, 'edit'])->name('coupons.edit');
        Route::put('/coupons/{coupon}', [DiscountCodeController::class, 'update'])->name('coupons.update');
        Route::delete('/coupons/{coupon}', [DiscountCodeController::class, 'destroy'])->name('coupons.delete');
        Route::get('/coupons/export/excel', [DiscountCodeController::class, 'export_excel'])->name('coupons.export_excel');
        Route::post('/coupons/import/excel', [DiscountCodeController::class, 'import_excel'])->name('coupons.import_excel');
        Route::get('/coupons/export/pdf', [DiscountCodeController::class, 'export_pdf'])->name('coupons.export_pdf');


        // Order Routes
        // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        // Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');
        // Route::post('/order/change-status/{id}', [OrderController::class, 'changeOrderStatus'])->name('orders.changeOrderStatus');
        // Route::post('/order/send-email/{id}', [OrderController::class, 'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');
        // Route::get('/orders/export/excel', [OrderController::class, 'export_excel'])->name('orders.export_excel');
        // Route::get('/orders/export/pdf', [OrderController::class, 'export_pdf'])->name('orders.export_pdf');

        //Users Route
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
        Route::get('/users/export/excel', [UserController::class, 'export_excel'])->name('users.export_excel');

        //Pages Route
        Route::get('pages', [PagesController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [PagesController::class, 'create'])->name('pages.create');
        Route::post('/pages', [PagesController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PagesController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PagesController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{page}', [PagesController::class, 'destroy'])->name('pages.delete');

        //temp-images.create
        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

        //Setting route
        Route::get('/change-password', [SettingController::class, 'ShowChangePasswordForm'])->name('mitra.ShowChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('mitra.ProcessChangePassword');


        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'home'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/mitra', [AdminController::class, 'overview'])->name('admin.mitra.overview');

        Route::get('/admin/mitra-transportasi-motor', [ListMitraController::class, 'transportasi_motor'])->name('admin.mitra.transportasi.motor');
        Route::get('/admin/mitra-transportasi-motor/{id}', [ListMitraController::class, 'detail_motor'])->name('admin.mitra.transportasi.detail.motor');

        Route::get('/admin/mitra-transportasi-mobil', [ListMitraController::class, 'transportasi_mobil'])->name('admin.mitra.transportasi.mobil');
        Route::get('/admin/mitra-transportasi-mobil/{id}', [ListMitraController::class, 'detail_mobil'])->name('admin.mitra.transportasi.detail.mobil');

        // Admin Artikel
        Route::get('/artikel', [ArtikelController::class, 'index'])->name('admin.artikel');
        Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('admin.artikel.create');
        Route::post('/artikel/store', [ArtikelController::class, 'store'])->name('admin.artikel.store');
        Route::get('/artikel/artikel-{id}', [ArtikelController::class, 'show'])->name('admin.artikel.show');
        Route::put('/artikel/update/{id}', [ArtikelController::class, 'update'])->name('admin.artikel.update');
        Route::delete('/admin/artikel/{id}', [ArtikelController::class, 'destroy'])->name('admin.artikel.delete');

        Route::get('/kategori', [CategoriesAdminController::class, 'index'])->name('admin.kategori');
        Route::get('/kategori/create', [CategoriesAdminController::class, 'create'])->name('admin.kategori.create');
        Route::post('/kategori/store', [CategoriesAdminController::class, 'store'])->name('admin.kategori.store');
        Route::delete('/kategori/{id}', [CategoriesAdminController::class, 'destroy'])->name('admin.kategori.destroy');

        Route::get('/admin/mitra-perjalanan', [ListMitraController::class, 'perjalanan'])->name('admin.mitra.perjalanan');
        Route::get('/admin/mitra-perjalanan/{id}', [ListMitraController::class, 'detailperjalanan'])->name('admin.mitra.perjalanan.detail');

        Route::get('/admin/mitra-homestay', [ListMitraController::class, 'homestay'])->name('admin.mitra.homestay');
        Route::get('/admin/mitra-homestay/{id}', [ListMitraController::class, 'detailhomestay'])->name('admin.mitra.homestay.detail');

        Route::get('/admin/mitra-perlengkapan', [ListMitraController::class, 'perlengkapan'])->name('admin.mitra.perlengkapan');
        Route::get('/admin/mitra-perlengkapan/{id}', [ListMitraController::class, 'detailperlengkapan'])->name('admin.mitra.perlengkapan.detail');
    });
});

// Route::get('/admin/mitra/destinasi', function () {
//     return view('admin.mitra.view.destinasi');
// })->name('admin.mitra.destinasi');


Route::get('/mitra/kategori', [CategoryController::class, 'index'])->name('mitra.category');
Route::get('/mitra/kategori/create', [CategoryController::class, 'create'])->name('mitra.category.create');
Route::post('/mitra/kategory/store', [CategoryController::class, 'store'])->name('mitra.category.store');
Route::delete('/mitra/kategori/{categoryId}', [CategoryController::class, 'destroy'])->name('mitra.category.destroy');
Route::put('/mitra/kategori/{categoryId}', [CategoryController::class, 'update'])->name('mitra.category.update');

// User Perjalanan
Route::get('/perjalanan/trip-{perjalananId}', [UserPageController::class, 'showPerjalanan'])->name('perjalanan.detail');
Route::get('/perjalanan/{kota?}', [UserPageController::class, 'perjalanan'])->name('perjalanan');

// Route::get('/perjalanan', [UserPageController::class, 'perjalanan'])->name('perjalanan');
// Route::get('/perjalanan', [UserPageController::class, 'filterByKota'])->name('perjalanan.kota');

// Route User Order Perjalanan
Route::get('/perjalanan/trip-{id}/pesan', [UserOrderPerjalananController::class, 'index'])->name('perjalanan.booking'); // Isi Data Diri Sebelum Order
Route::post('/perjalanan/trip-{id}/store', [UserOrderPerjalananController::class, 'store'])->name('perjalanan.booking.store'); // Proses Data Order

Route::get('/order/perjalanan/{uniq_perjalanan}', [UserOrderPerjalananController::class, 'payment'])->name('user.perjalanan.payment');
Route::get('/order/{perjalanan_id}/success', [UserOrderPerjalananController::class, 'paymentSuccess'])->name('payment.perjalanan.success');
Route::get('/order/{perjalanan_id}/error', [UserOrderPerjalananController::class, 'paymentError'])->name('payment.perjalanan.error');

// User Order Keseluruhan
Route::post('/getkota', [UserOrderController::class, 'getkota'])->name('getkota');
Route::post('/getkecamatan', [UserOrderController::class, 'getkecamatan'])->name('getkecamatan');
Route::post('/getdesa', [UserOrderController::class, 'getdesa'])->name('getdesa');

// User Order
Route::get('/order', [UserOrderController::class, 'index'])->middleware('auth')->name('user.order');
Route::get('/order/selesai', [UserOrderController::class, 'orderSelesai'])->name('order.success');
// Route::get('/order/{order_id}/pembayaran', [UserOrderController::class, 'payment'])->name('user.order.payment');
// Route::get('/order/{perjalanan_id}/bayar', [UserOrderController::class, 'paymentPerjalanan'])->name('perjalanan.payment');

// Route::get('/order/{perjalanan_id}/bayar', [UserOrderPerjalananController::class, 'paymentPerjalanan'])->name('perjalanan.payment');
// Route::get('/order/{motor_id}/bayar', [UserOrderController::class, 'paymentMotor'])->name('motor.payment');
// Route::get('/order/{perlengkapan_id}/bayar', [UserOrderController::class, 'paymentPerlengkapan'])->name('perlengkapan.payment');

// Order User Success

// User Transportasi
Route::get('/transportasi', [UserPageController::class, 'transportasi'])->name('transportasi');
Route::get('/transportasi/motor-{motorId}', [UserPageController::class, 'showMotor'])->name('user.motor.detail');
Route::get('/transportasi/mobil-{mobilId}', [UserPageController::class, 'showMobil'])->name('user.mobil.detail');

// Route User Booking Mobil
Route::get('/mobil/detail-{mobil_id}/booking', [UserOrderMobilController::class, 'index'])->name('mobil.booking');
Route::post('/mobil/detail-{mobil_id}/store', [UserOrderMobilController::class, 'store'])->name('mobil.booking.store');

// Route User Booking Mobil
Route::get('/order/mobil/{uniq_mobil}', [UserOrderMobilController::class, 'payment'])->name('user.mobil.payment');
Route::get('/order/success/{mobil_id}', [UserOrderMobilController::class, 'paymentSuccess'])->name('payment.mobil.success');

// Route User Booking Motor
Route::get('/motor/detail-{motor_id}/booking', [UserOrderMotorController::class, 'index'])->name('motor.booking');
Route::post('/motor/detail-{motor_id}/store', [UserOrderMotorController::class, 'store'])->name('motor.booking.store');
Route::get('/order/motor/{uniq_motor}', [UserOrderMotorController::class, 'payment'])->name('user.motor.payment');
Route::delete('/order/motor/delete/{order_id}', [UserOrderMotorController::class, 'delete'])->name('user.motor.delete');
Route::get('/order/motor/{motor_id}/success', [UserOrderMotorController::class, 'paymentSuccess'])->name('payment.motor.success');

// User Perlengkapan
Route::get('/perlengkapan', [UserPageController::class, 'mitra'])->name('perlengkapan');
Route::get('/perlengkapan/perlengkapan-{perlengkapan_id}', [UserPageController::class, 'showPerlengkapan'])->name('user.perlengkapan.detail');
Route::get('/perlengkapan/{perlengkapan_id}/pesan', [UserOrderPerlengkapanController::class, 'index'])->middleware('auth')->name('perlengkapan.booking');
Route::post('/perlengkapan/{perlengkapan_id}/store', [UserOrderPerlengkapanController::class, 'store'])->name('perlengkapan.booking.store');

Route::delete('/order/perlengkapan/delete/{order_id}', [UserOrderPerlengkapanController::class, 'delete'])->name('user.perlengkapan.delete');
Route::get('/order/perlengkapan/{uniq_perlengkapan}', [UserOrderPerlengkapanController::class, 'payment'])->name('user.perlengkapan.payment');
Route::get('/order/perlengkapan/success/{order_id}', [UserOrderPerlengkapanController::class, 'paymentSuccess'])->name('payment.perlengkapan.success');




// User Homestay
Route::get('/homestay', [UserPageController::class, 'homestay'])->name('homestay');
Route::get('/homestay/{uniq_id}', [UserPageController::class, 'showHomestay'])->name('homestay.detail');

Route::get('/homestay/{uniq_homestay}/booking', [UserOrderHomestayController::class, 'index'])->name('homestay.booking');
Route::post('/homestay/{uniq_homestay}/store', [UserOrderHomestayController::class, 'store'])->name('homestay.booking.store');
Route::get('/order/homestay/{uniq_homestay}', [UserOrderHomestayController::class, 'payment'])->name('user.homestay.payment');
Route::get('/order/homestay/success/{homestay_id}', [UserOrderHomestayController::class, 'paymentSuccess'])->name('payment.homestay.success');





// routes/web.php

// Route untuk perjalanan
// Route::get('/perjalanan/{orderId}/bayar', [UserOrderPerjalananController::class, 'payment'])->name('perjalanan.payment');

// Route untuk motor
// Route::get('/motor/{orderId}/bayar', [UserOrderMotorController::class, 'payment'])->name('motor.payment');

// Route untuk mobil
// Route::get('/mobil/{orderId}/bayar', [UserOrderMobilController::class, 'payment'])->name('mobil.payment');

// Route untuk homestay
// Route::get('/homestay/{orderId}/bayar', [UserOrderHomestayController::class, 'payment'])->name('homestay.payment');

// Route untuk perlengkapan
// Route::get('/order/{perlengkapan_id}/bayar', [UserOrderPerlengkapanController::class, 'payment'])->name('perlengkapan.payment');







// Route::get('/order/{order_id}', [UserOrderMotorController::class, 'orderDetail'])->name('motor.order.detail');


// User Order Mobil
// Route::get('/transportasi/detail-{mobilId}', [UserMobilController::class, 'show'])->name('user.mobil.detail');












// Data Mitra
Route::get('/mitra/biodata', function () {
    return view('mitra.mitra.biodata');
})->name('mitra.mitra.biodata');
// Mitra
Route::get('/mitra/akun', function () {
    return view('mitra.mitra.akun');
})->name('mitra.mitra.akun');

Route::get('/mitra/web', function () {
    return view('mitra.mitra.web');
})->name('mitra.mitra.web');

Route::get('/transportasi/order', function () {
    return view('front.pages.transportasi.order.motor.order');
})->name('testing.data');

// Route::get('/transportasi', function () {
//     return view('front.pages.transportasi.index');
// })->name('front.transportasi.list');

// Frontend User
// Route::get('/transportasi/list', [TransportasiController::class, 'front_index'])->name('transportasi.list');


// Artikel Admin
Route::get('/artikel', [FrontendController::class, 'index'])->name('front.artikel.index');
Route::get('/artikel/artikel-{id}', [FrontendController::class, 'show'])->name('front.artikel.show');


// Akun Mitra   
Route::get('/mitra/web', function () {
    return view('mitra.mitra.web');
})->name('mitra.mitra.web');

Route::get('/perjalanan/testing/cart', function () {
    return view('front.pages.perjalanan.cart');
})->name('perjalanan.testing.cart');

// Route::get('/terjemahkan', function () {
//     return view('front.translate');
// })->name('translate.form');


Route::get('/terjemahkan', [TranslationController::class, 'showForm'])->name('front.translate');
Route::post('/terjemahkan/async', [TranslationController::class, 'translateAsync'])->name('translate.async');
// Route::post('/terjemahkan', [TranslationController::class, 'translate'])->name('translate');


// Frontend User Transportasi
// Route::get('/transportasi', function () {
//     return view('front.pages.transportasi.index');
// })->name('transportasi');








// User Transportasi
// Route::get('/perlengkapan', [FrontController::class, 'perlengkapan'])->name('perlengkapan');
// Detail Perjalanan



// Route::get('/pesanan/{order_id?}', [UserOrderPerjalananController::class, 'order'])->name('front.user.checkout');

// Route::post('/proses-pembayaran', [UserOrderPerjalananController::class, 'orderProses'])->name('front.user.bayar');

Route::get('/ecotourism', [EcotourismController::class, 'index'])->name('front.ecotourism');
Route::post('/ecotourism/store', [EcotourismController::class, 'store'])->middleware('auth')->name('front.ecotourism.store');
Route::get('/ecotourism/detail', [EcotourismController::class, 'detail'])->name('front.ecotourism.detail');
Route::get('/ecotourism/history', [EcotourismController::class, 'history'])->name('front.ecotourism.history');

// Route::get('/perjalanan/trip-{id}/biodata', [UserOrderPerjalananController::class, 'index'])->name('perjalanan.booking'); // Isi Data Diri Sebelum Order
// Route::post('/perjalanan/trip-{id}/', [UserOrderPerjalananController::class, 'store'])->name('perjalanan.booking.store'); // Proses Data Order
// Route::get('/pesanan', [UserOrderPerjalananController::class, 'order'])->name('front.user.orders');



// Route::post('/perjalanan/{id}/booking', [UserOrderPerjalananController::class, 'review'])->name('perjalanan.booking.review');

// Route::get('/checkout/{id}', function($id) {
//     // Ambil data perjalanan berdasarkan ID
//     $perjalanan = \App\Models\Perjalanan::findOrFail($id);

//     return view('front.user.checkout', [
//         'perjalanan' => $perjalanan,
//         'success' => session('success')
//     ]);
// })->name('front.user.checkout');



// Route::get('provinces', 'DependentDropdownController@provinces')->name('provinces');
// Route::get('cities', 'DependentDropdownController@cities')->name('cities');
// Route::get('districts', 'DependentDropdownController@districts')->name('districts');
// Route::get('villages', 'DependentDropdownController@villages')->name('villages');

// Route::get('/transportasi/booking', function () {
//     return view('front.pages.transportasi.biodata');
// })->name('transportasi.booking');
// Route::get('/transportasi/{id}/booking', [OrderTransportasiController::class, 'show'])->name('transportasi.booking');
// Route::post('/transportasi/{id}/booking', [OrderTransportasiController::class, 'store'])->name('transportasi.booking.store');

Route::get('/transportasi/review', function () {
    return view('front.pages.transportasi.review');
})->name('transportasi.review');

// Route::get('/transportasi/detail', function () {
//     return view('front.pages.transportasi.detail');
// })->name('transportasi.detail');


// Mitra Setting
Route::get('/transportasi/setting', function () {
    return view('mitra.setting.data.index');
})->name('mitra.transportasi.setting.data.index');

Route::get('/transportasi/create', function () {
    return view('mitra.setting.data.create');
})->name('mitra.transportasi.setting.data.create');

Route::get('/transportasi/akun', function () {
    return view('mitra.setting.akun');
})->name('mitra.transportasi.akun');

// Front Navbar
Route::get('/help', function () {
    return view('front.pages.help');    
})->name('front.help');

Route::get('/perlengkapan/{mitra_id}/shop', [UserPageController::class, 'shop'])->name('user.perlengkapan.shop');
