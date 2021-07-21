<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CasteController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CompanySettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DeletedMemberController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EmailSetupController;
use App\Http\Controllers\FamilyStatusController;
use App\Http\Controllers\FamilyValueController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FooterLinkController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GoogleAnalyticsController;
use App\Http\Controllers\HappyStoryController;
use App\Http\Controllers\HowWeWorkController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\OnBehalfController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDetailController;
use App\Http\Controllers\PaymentOptionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RecaptchaController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\SideMenuController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SMTPController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubCasteController;
use App\Http\Controllers\UniversityController;

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
####################################### Frontend Route ################################
// Route::get('/', function () {
//     return view('frontend.home');
// });
Route::get('/{any?}', function () {
    return view('frontend.home');
});
Route::get('/happy-story/{any?}', function () {
    return view('frontend.home');
});
Route::get('/checkout/{any?}', function () {
    return view('frontend.home');
});
Route::get('/blog/{any?}', function () {
    return view('frontend.home');
});
Route::get('/page/{any?}', function () {
    return view('frontend.home');
});
Route::get('/my-account/{any?}', function () {
    return view('frontend.home');
});
Route::get('/my-account/view-profile/{any?}', function () {
    return view('frontend.home');
});
Route::get('/my-account/view-profile/{id}/{any?}', function () {
    return view('frontend.home');
});

####################################### Backend Route ################################
Route::get('/admin/login', function () {
    return view('backend.user.login');
})->name('login');
Route::post('/admin/login', [UserController::class, 'login'])->name('login');
Route::group(['prefix'=>'admin','middleware' => ['auth']], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('company', CompanySettingsController::class);
    Route::resource('social-link', SocialLinkController::class);
    Route::resource('smtp', SMTPController::class);
    Route::resource('member', MemberController::class);
    Route::resource('deleted-member', DeletedMemberController::class);
    Route::resource('plan', PlanController::class);
    Route::resource('religion', ReligionController::class);
    Route::resource('caste', CasteController::class);
    Route::resource('sub-caste', SubCasteController::class);
    Route::resource('language', LanguageController::class);
    Route::resource('country', CountryController::class);
    Route::resource('state', StateController::class);
    Route::resource('city', CityController::class);
    Route::resource('family-status', FamilyStatusController::class);
    Route::resource('family-value', FamilyValueController::class);
    Route::resource('on-behalf', OnBehalfController::class);
    Route::resource('occupation', OccupationController::class);
    Route::resource('marital-status', MaritalStatusController::class);
    Route::resource('education', EducationController::class);
    Route::resource('university', UniversityController::class);
    Route::resource('income', IncomeController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('happy-story', HappyStoryController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('follow', FollowController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('payment-option', PaymentOptionController::class);
    Route::resource('footer-link', FooterLinkController::class);
    Route::resource('email-setup', EmailSetupController::class);
    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('career', CareerController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('payment-detail', PaymentDetailController::class);
    Route::resource('recaptcha', RecaptchaController::class);
    Route::resource('google-analytics', GoogleAnalyticsController::class);
    Route::resource('how-we-work', HowWeWorkController::class);
    Route::resource('side-menu', SideMenuController::class);
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
