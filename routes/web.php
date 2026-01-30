<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RoleAccessSettingsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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




// Public homepage route
Route::get('/', [HomeController::class, 'home']);


Route::group(['middleware' => 'auth'], function () {
	// Store Pricing Annual
	Route::post('pricing/annual', [\App\Http\Controllers\PricingAnnualController::class, 'store'])->name('pricing.annual.store');
	Route::get('pricing/annual/{id}', [\App\Http\Controllers\PricingAnnualController::class, 'show'])->name('pricing.annual.show');
	Route::get('pricing/annual/{id}/edit', [\App\Http\Controllers\PricingAnnualController::class, 'edit'])->name('pricing.annual.edit');
	Route::put('pricing/annual/{id}', [\App\Http\Controllers\PricingAnnualController::class, 'update'])->name('pricing.annual.update');
	Route::delete('pricing/annual/{id}', [\App\Http\Controllers\PricingAnnualController::class, 'destroy'])->name('pricing.annual.destroy');
	// Store Pricing Month
	Route::post('pricing/month', [\App\Http\Controllers\PricingMonthController::class, 'store'])->name('pricing.month.store');
	Route::get('pricing/month/{id}', [\App\Http\Controllers\PricingMonthController::class, 'show'])->name('pricing.month.show');
	Route::get('pricing/month/{id}/edit', [\App\Http\Controllers\PricingMonthController::class, 'edit'])->name('pricing.month.edit');
	Route::put('pricing/month/{id}', [\App\Http\Controllers\PricingMonthController::class, 'update'])->name('pricing.month.update');
	Route::delete('pricing/month/{id}', [\App\Http\Controllers\PricingMonthController::class, 'destroy'])->name('pricing.month.destroy');
	// Store Pricing Years
	Route::post('pricing/years', [\App\Http\Controllers\PricingYearsController::class, 'store'])->name('pricing.years.store');
	Route::get('pricing/years/{id}', [\App\Http\Controllers\PricingYearsController::class, 'show'])->name('pricing.years.show');
	Route::get('pricing/years/{id}/edit', [\App\Http\Controllers\PricingYearsController::class, 'edit'])->name('pricing.years.edit');
	Route::put('pricing/years/{id}', [\App\Http\Controllers\PricingYearsController::class, 'update'])->name('pricing.years.update');
	Route::delete('pricing/years/{id}', [\App\Http\Controllers\PricingYearsController::class, 'destroy'])->name('pricing.years.destroy');

		// Pricing menu
		Route::get('pricing', function () {
			$annuals = \App\Models\PricingAnnual::all();
			$months = \App\Models\PricingMonth::all();
			$years = \App\Models\PricingYears::all();
			return view('pricing.index', compact('annuals', 'months', 'years'));
		})->name('pricing.index');
	Route::get('notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
	Route::get('notifications/dashboard', [\App\Http\Controllers\NotificationController::class, 'dashboard'])->name('notifications.dashboard');
	Route::post('notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
	Route::match(['get','post'],'order/{id}/pay', [\App\Http\Controllers\OrderController::class, 'pay'])->name('order.pay');
	Route::get('order/{id}/midtrans-token', [\App\Http\Controllers\OrderController::class, 'midtransToken']);
	Route::post('duitku/callback', [\App\Http\Controllers\OrderController::class, 'duitkuCallback'])->name('duitku.callback');
	// Invoice routes
	Route::get('invoice', [\App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
	Route::get('invoice/{id}', [\App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.show');
	Route::get('invoice/{id}/download', [\App\Http\Controllers\InvoiceController::class, 'download'])->name('invoice.download');
	Route::delete('invoice/{id}', [\App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoice.destroy');
	Route::post('order/subscribe', [\App\Http\Controllers\OrderController::class, 'subscribe'])->name('order.subscribe');

	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');



	Route::get('produk', [\App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
	Route::get('produk/{id}', [\App\Http\Controllers\ProdukController::class, 'show'])->name('produk.show');
	Route::get('produk/create', [\App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
	Route::post('produk', [\App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
	Route::get('produk/{id}/edit', [\App\Http\Controllers\ProdukController::class, 'edit'])->name('produk.edit');
	Route::put('produk/{id}', [\App\Http\Controllers\ProdukController::class, 'update'])->name('produk.update');
	Route::delete('produk/{id}', [\App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');

	// Produk Group CRUD
	Route::get('produk-group', [\App\Http\Controllers\ProdukGroupController::class, 'index'])->name('produk-group.index');
	Route::post('produk-group', [\App\Http\Controllers\ProdukGroupController::class, 'store'])->name('produk-group.store');
	Route::put('produk-group/{id}', [\App\Http\Controllers\ProdukGroupController::class, 'update'])->name('produk-group.update');
	Route::delete('produk-group/{id}', [\App\Http\Controllers\ProdukGroupController::class, 'destroy'])->name('produk-group.destroy');

	// Produk Module CRUD
	Route::get('produk-module', [\App\Http\Controllers\ProdukModuleController::class, 'index'])->name('produk-module.index');
	Route::post('produk-module', [\App\Http\Controllers\ProdukModuleController::class, 'store'])->name('produk-module.store');
	Route::put('produk-module/{id}', [\App\Http\Controllers\ProdukModuleController::class, 'update'])->name('produk-module.update');
	Route::delete('produk-module/{id}', [\App\Http\Controllers\ProdukModuleController::class, 'destroy'])->name('produk-module.destroy');
	Route::get('order', [\App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
	Route::delete('order/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');
	Route::get('order/{id}/detail', [\App\Http\Controllers\OrderController::class, 'detail'])->name('order.detail');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', [\App\Http\Controllers\UserManagementController::class, 'index'])->name('user-management');
	Route::post('user-management', [\App\Http\Controllers\UserManagementController::class, 'store'])->name('user-management.store');
	Route::put('user-management/{id}', [\App\Http\Controllers\UserManagementController::class, 'update'])->name('user-management.update');
	Route::delete('user-management/{id}', [\App\Http\Controllers\UserManagementController::class, 'destroy'])->name('user-management.destroy');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');


	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	// Setting menu permission, hanya superadmin
	Route::middleware(['auth'])->group(function () {
		Route::get('settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
		Route::post('settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
	});

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	// Route login untuk sign-up sudah ada di bawah, tidak perlu di sini
	// Route konversi currency (akses internal)
	Route::post('currency/convert', [\App\Http\Controllers\CurrencyController::class, 'convert'])->name('currencies.convert');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create'])->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
	Route::get('/login', function() {
		return view('auth.login');
	});
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

// Route login utama diarahkan ke SessionsController@create (login-session)
// Route dashboard TIDAK BOLEH ada di luar group 'auth'!

Route::get('/login', function() {
	return view('auth.login');
})->name('login');
Route::post('/login', [\App\Http\Controllers\SessionsController::class, 'store'])->name('login.post');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/otp-verify', [\App\Http\Controllers\OtpController::class, 'showForm'])->name('otp.verify.form');
Route::post('/otp-verify', [\App\Http\Controllers\OtpController::class, 'verify'])->name('otp.verify');
Route::get('/otp-login', [\App\Http\Controllers\OtpController::class, 'showOtpLoginForm'])->name('otp.login.form');
Route::post('/otp-login', [\App\Http\Controllers\OtpController::class, 'verifyOtpLogin'])->name('otp.login.verify');
Route::get('/set-locale', function () {
    $lang = request('lang', 'id');
    session(['locale' => $lang]);
    return redirect('/'); // redirect ke halaman utama, bukan back
});

// Payment module
Route::get('payment', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
Route::get('payment/currencies', [\App\Http\Controllers\PaymentController::class, 'currencies'])->name('payment.currencies');
Route::resource('currencies', \App\Http\Controllers\CurrencyController::class)->except(['show', 'edit', 'create']);
Route::post('currencies/update-rates', [\App\Http\Controllers\CurrencyController::class, 'updateRates'])->name('currencies.updateRates');
Route::post('currencies/update-rates-free', [\App\Http\Controllers\CurrencyController::class, 'updateRatesFreeApi'])->name('currencies.updateRatesFreeApi');
Route::get('currencies/available', [\App\Http\Controllers\CurrencyController::class, 'getAvailableCurrencies'])->name('currencies.available');
Route::get('payment/gateways', [\App\Http\Controllers\PaymentController::class, 'gateways'])->name('payment.gateways');
Route::match(['get','post'],'payment/tax', [\App\Http\Controllers\PaymentController::class, 'tax'])->name('payment.tax');
Route::get('payment/promotions', [\App\Http\Controllers\PaymentController::class, 'promotions'])->name('payment.promotions');
// Tax CRUD
Route::delete('payment/tax/{id}', [\App\Http\Controllers\PaymentController::class, 'destroy'])->name('payment.tax.destroy');
Route::post('payment/tax/{id}/edit', [\App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.tax.edit');
Route::get('role-access-settings', [RoleAccessSettingsController::class, 'index'])->name('role-access-settings.index');