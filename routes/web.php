<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController, SalesController, CategoryController,
    AuthController, OrderController, ReportController,
    MessageController, MainCategoryController, BrandController, SalesCartController,DashboardController,ChatController
};
use App\Http\Controllers\CustomerController;
use App\Livewire\UserChat;
use App\Livewire\AdminChat;

Route::get('/', fn() => view('welcome'));
Route::get('/inventory', fn() => view('inventory'));

// Public routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {


     Route::get('/chat', [ChatController::class,'index'])->name('user.chat');
     Route::get('/admin/chat', [ChatController::class,'adminIndex'])->name('admin.chat');


    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::get('/products/{product}/sell', [ProductController::class, 'sell'])->name('products.sell');

    Route::post('/sales', [ProductController::class, 'storeSale'])->name('sales.store');

    Route::resource('categories', CategoryController::class);
    Route::post('/categories/main', [CategoryController::class, 'storeMain'])->name('categories.storeMain');
    Route::post('/categories/brand', [CategoryController::class, 'storeBrand'])->name('categories.storeBrand');
    Route::post('/categories/type', [CategoryController::class, 'storeType'])->name('categories.storeType');
    Route::post('/categories/size', [CategoryController::class, 'storeSize'])->name('categories.storeSize');

    Route::resource('sales', SalesController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('messages', MessageController::class);








// Cart routes
Route::post('/products/{product}/add-to-cart', [SalesCartController::class, 'addToCart'])->name('products.addToCart');
Route::delete('/cart/{cartItem}', [SalesCartController::class, 'removeFromCart'])->name('products.removeFromCart');
Route::put('/cart/{cartItem}', [SalesCartController::class, 'updateCartItem'])->name('products.updateCartItem');
Route::get('/cart/clear', [SalesCartController::class, 'clearCart'])->name('products.clearCart');
Route::post('/cart/process-sale', [SalesCartController::class, 'processSale'])->name('products.processSale');

// Optional: View all sales history
Route::get('/salesCart', [SalesCartController::class, 'salesHistory'])->name('salesCart.index');
Route::get('/sales/{sessionId}/download-pdf', [SalesCartController::class, 'downloadSalePDF'])->name('sales.downloadPDF');
Route::patch('/sales/{sessionId}/update-status', [SalesCartController::class, 'updateSaleStatus'])->name('sales.updateStatus');



// order management routes
  Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

});










Route::prefix('shop')->name('customer.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('products');
    
    Route::post('/cart/add', [CustomerController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CustomerController::class, 'cart'])->name('cart');
    Route::post('/cart/update', [CustomerController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [CustomerController::class, 'removeFromCart'])->name('cart.remove');
    
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/success/{order}', [CustomerController::class, 'orderSuccess'])->name('order.success');
});
