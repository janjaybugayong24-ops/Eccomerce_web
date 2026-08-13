
<?php

use App\Http\Controllers\address\AddressController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\brand\BrandController;
use App\Http\Controllers\cart\CartController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\checkout\CheckoutController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\delivery\DeliveryController;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\order\OrderController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\rating\RatingController;
use App\Http\Controllers\review\ReviewController;
use App\Http\Controllers\Shipping\ShippingController;
use App\Http\Controllers\wishlist\WishlistController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mime\Address;


//Route::get('/', function()  {
//return view('HomePage'); 
//});

//Home Page
Route::get('/', [HomeController::class, 'slider'])->name('HomePage');
Route::get('/category', [HomeController::class, 'category'])->name('show.category');
Route::get('view/category/{slug}', [HomeController::class, 'view_category'])->name('view.category');
Route::get('category/{category_slug}/{product_slug}', [HomeController::class, 'product_view'])->name('category.products');
Route::get('/product-list', [HomeController::class, 'productList_ajax'])->name('product.list');
Route::post('searchProduct', [HomeController::class, 'search_product'])->name('search.product');

// admin
Route::prefix('admins')->middleware(['admins', 'user.active'])->group(function () {

   Route::controller(AdminController::class)->group(function () {

      Route::get('/dashboard', 'dashbord')->name('admin.dashbord');
      Route::post('/logout', 'Admin_logout')->name('admin.logout');
      Route::get('/edit/{id}', 'edit')->name('admin.edit');
      Route::put('/update/{id}', 'update')->name('admin.update');

      Route::get('customer/registered', 'customer_view')->name('customer.view');
      Route::get('customer/view/{id}', 'customer_details')->name('customers.view');

      Route::get('customers', 'customers')->name('admin.customers');
   });

   Route::controller(CategoryController::class)->group(function () {

      Route::get('/categories/create', 'create')->name('categories.create');
      Route::post('/categories/store', 'store')->name('categories.store');
      Route::get('/categories', 'index')->name('categories.show');
      Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
      Route::put('/categories/update/{id}', 'update')->name('categories.update');
      Route::delete('/categories/{id}/destroy', 'destroy')->name('categories.destroy');
   });

   Route::controller(BrandController::class)->group(function () {

      Route::get('brands/create', 'create')->name('brands.create');
      Route::post('brands/store', 'store')->name('brands.store');
      Route::get('brands', 'index')->name('brands.show');
      Route::get('brands/edit/{id}', 'edit')->name('brands.edit');
      Route::put('brands/update/{id}', 'update')->name('brands.update');
      Route::delete('brands/{id}/destroy', 'destroy')->name('brands.destroy');
   });

   Route::controller(ProductController::class)->group(function () {

      Route::get('/product', 'index')->name('product.index');
      Route::get('product/create', 'create')->name('product.create');
      Route::post('/product', 'store')->name('product.store');
      Route::get('/product/{id}/edit', 'edit')->name('product.edit');
      Route::put('/product/{id}/update', 'update')->name('product.update');
      Route::delete('/product/{id}/destroy', 'destroy')->name('product.destroy');
   });


   Route::controller(OrderController::class)->group(function () {

      Route::get('orders', 'admin_show_orders')->name('admin_show.orders');
      Route::get('view/order/{id}', 'view_orders')->name('admin.view.order');
      Route::put('update/order/{id}', 'update_status');
      Route::get('orders/history', 'order_history')->name('order.history');
   });

   Route::controller(ShippingController::class)->group(function () {
      Route::get('order/shipping/{order_id}', 'view_shipments')->name('show.shipping');
      Route::post('order/shipping/create', 'create_shipments')->name('create.shipping');
      Route::get('order/shipping-status/{order_id}', 'show_shipping')->name('get.shipping');
      Route::get('edit/shipping/{id}', 'edit_shipping')->name('edit.shipping');
      Route::put('update/shipping/{id}', 'update_shipping')->name('update.shipping');
   });

   Route::controller(DeliveryController::class)->group(function () {
      Route::get('order/delivery/{shipping_id}', 'create_delivery')->name('create.delivery');
      Route::post('order/delivery/create', 'store_delivery')->name('store.delivery');
      Route::get('order/view/delivery/{shipping_id}', 'view_delivery')->name('view.delivery');
      Route::get('order/delivery/edit/{id}', 'edit_deliveries')->name('deliveries.edit');
      Route::put('order/delivery/update/{id}', 'update_deliveries')->name('deliveries.update');
   });
});

Route::prefix('admins')->group(function () {

   Route::controller(AdminController::class)->group(function () {

      Route::get('/login', 'adminlogin')->name('admin.login');
      Route::post('/login/submit', 'loginSubmit')->name('adminLogin.Submit');
      Route::get('/forgetPassword', 'forgetPassword')->name('admin_forget_password');
      Route::post('/forget_Password_submit', 'forget_Password_Submit')->name('admin_forget_password_submit');
      Route::get('/reset_password/{token}/{email}', 'admin_reset_password')->name('admin_reset_password');
      Route::post('/reset_password/{token}/{email}', 'reset_password_submit')->name('reset_password_submit');
   });
});


Route::middleware('auth')->group(function () {


   Route::controller(AddressController::class)->group(function () {

      Route::get('address/create/{id}', 'create')->name('show.address');
      Route::post('address/store',  'store')->name('address.store');
      Route::get('address/edit/{id}', 'edit')->name('address.edit');
      Route::put('address/update/{id}', 'update')->name('address.update');
      Route::delete('address/{id}/destroy', 'destroy')->name('address.destroy');
      Route::get('address/{id}/information', 'index')->name('address.info');
   });

   Route::controller(CartController::class)->group(function () {

      Route::get('view/cart', 'view_cart')->name('show.cart');
      Route::post('/delete-cart-item', 'delete_cart_item');
      Route::post('update-cart-item', 'update_cart');
      Route::post('add-to-cart', [CartController::class, 'add_product'])->name('product.add_to_cart');
      Route::get('/load-cart-data', [CartController::class, 'cart_count']);
   });

   Route::controller(CustomerController::class)->group(function () {
      Route::get('myorders', 'show_orders')->name('show.orders');
      Route::get('view/order/{id}', 'view_order')->name('view.order');
      Route::get('your-order/shipping-details/{order_id}', 'shipping_details')->name('shipping.details');
      Route::get('your-order/delivery-details/{shipping_id}', 'delivery_details')->name('delivery.details');
   });

   Route::controller(CheckoutController::class)->group(function () {

      Route::get('checkout', 'index')->name('show.checkout');
      Route::post('place-order/{customer_id}', 'place_order')->name('create.place_order');
      Route::get('pay', 'pay')->name('paymongo');
      Route::get('success', 'success');
      Route::get('link-pay', 'link_pay')->name('link');
      Route::get('link-status/{linkid}', 'link_status')->name('link.status');
   });

   Route::controller(ReviewController::class)->group(function () {

      Route::get('add/customer-review/{slug}', 'customer_review_product')->name('review.product');
      Route::post('add-review', 'add_review')->name('add.review');
      Route::get('edit-review/{slug}/user_review', 'edit_review');
      Route::put('change_review/{slug}', 'edit')->name('change.review');
   });


   Route::controller(WishlistController::class)->group(function () {

      Route::get('wishlist', 'index')->name('wishlist');
      Route::post('/delete-wishlist-item', 'delete_wishlist_item');
      Route::get('/load-wishlist-data', 'wishlist_count');
      Route::post('add-to-wishlist', 'add_wishlist')->name('add.wishlist');
   });

   Route::post('/add-rating', [RatingController::class, 'product_rating'])->name('add.rating');
});


Route::prefix('customer')->group(function () {

   Route::controller(CustomerController::class)->group(function () {
      Route::get('/',  'showRegister')->name('show.register');
      Route::get('/register', 'showRegister')->name('show.register');
      Route::get('/registration_verify/{token}/{email}', 'registration_verify')->name('registration_verify');
      Route::get('/login', 'showLogin')->name('show.login');
      Route::post('/register', 'register')->name('register');
      Route::post('/login', 'login')->name('login');
      Route::post('/logout', 'logout')->name('logout');
      Route::get('/', 'index')->name('customer.index');
      Route::get('/{id}/edit', 'edit')->name('customer.edit');
      Route::put('/{id}/update', 'update')->name('customer.update');
      Route::delete('/{id}/destroy',  'destroy')->name('customer.destroy');
      Route::get('/forgetPassword', 'forgetPassword')->name('customer_forget_password');
      Route::post('/forget_Password_submit', 'forget_Password_Submit')->name('customer_forget_password_submit');
      Route::get('/reset_password/{token}/{email}', 'customer_reset_password')->name('customer_reset_password');
      Route::post('/reset_password/{token}/{email}', 'reset_password_submit')->name('customer_reset_password_submit');
   });
});

/*
Route::get('/order/create/{customer}', [OrderController::class, 'create'])->name('order.create');

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

//order Info
Route::get('order/information', [OrderController::class, 'index'])->name('orderInfo.index');
*/
