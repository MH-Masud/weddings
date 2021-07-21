<?php

use App\Http\Controllers\Api\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomePageApiController;
use App\Http\Controllers\Api\MemberApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
############################ Api Route Start  ################################
Route::post('/tokens/create', [AuthController::class, 'createToken']);
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/tokens/delete', [AuthController::class, 'createDelete']);

    ############################ Frontend Api Route Start  ################################
    Route::get('/slider', [HomePageApiController::class, 'slider']);
    Route::get('/premium-member', [HomePageApiController::class, 'premiumMember']);
    Route::get('/happy-story', [HomePageApiController::class, 'happyStory']);
    Route::post('/app-login', [MemberApiController::class, 'appLogin']);
    Route::post('/app-registration', [MemberApiController::class, 'appRegistration']);
    Route::get('/on-behalf', [MemberApiController::class, 'onBehalf']);
    Route::get('/country-list', [MemberApiController::class, 'countryList']);
    Route::get('/state/{id}', [MemberApiController::class, 'stateList']);
    Route::get('/city/{id}', [MemberApiController::class, 'cityList']);
    Route::get('/footer-link', [MemberApiController::class, 'footerLink']);
    Route::get('/follow-us', [MemberApiController::class, 'followUs']);
    Route::get('/pay-with', [MemberApiController::class, 'payWith']);
    Route::get('/side-menu', [MemberApiController::class, 'sideMenu']);
    Route::get('/company-info', [MemberApiController::class, 'companyInfo']);
    Route::get('/how-work', [MemberApiController::class, 'howWork']);
    Route::get('/member/{id}', [MemberApiController::class, 'memberInfo']);
    Route::post('/registration-next/{id}', [MemberApiController::class, 'registrationNext']);
    Route::get('/premium-plan', [MemberApiController::class, 'premiumPlan']);
    Route::post('/search-result', [MemberApiController::class, 'searchResult']);
    Route::get('/happy-story-list', [MemberApiController::class, 'happyStoryList']);
    Route::get('/happy-story-detail/{id}', [MemberApiController::class, 'happyStoryDetail']);
    Route::get('/on-behalf', [MemberApiController::class, 'Behalf']);
    Route::get('/marital-status', [MemberApiController::class, 'maritalStatus']);
    Route::get('/religion', [MemberApiController::class, 'Religion']);
    Route::get('/caste/{id}', [MemberApiController::class, 'Caste']);
    Route::get('/sub-caste/{id}', [MemberApiController::class, 'subCaste']);
    Route::get('/family-value', [MemberApiController::class, 'familyValue']);
    Route::get('/family-status', [MemberApiController::class, 'familyStatus']);
    Route::get('/education', [MemberApiController::class, 'Education']);
    Route::get('/occupation', [MemberApiController::class, 'Occupation']);
    Route::get('/income', [MemberApiController::class, 'Income']);
    Route::get('/language', [MemberApiController::class, 'Language']);
    Route::post('/update-info/{id}', [MemberApiController::class, 'updateInfo']);
    Route::get('/member-detail/{id}', [MemberApiController::class, 'memberDetail']);
    Route::post('/all-state', [MemberApiController::class, 'allState']);
    Route::post('/all-city', [MemberApiController::class, 'allCity']);
    Route::get('/partner-profile/{id}', [MemberApiController::class, 'partnerProfile']);
    Route::post('/update-partner-profile/{id}', [MemberApiController::class, 'updatePartnerProfile']);
    Route::get('/contact-details/{id}', [MemberApiController::class, 'contactDetails']);
    Route::post('/update-contact-number/{id}', [MemberApiController::class, 'updateContactNumber']);
    Route::post('/update-contact-details/{id}', [MemberApiController::class, 'updateContactDetails']);
    Route::get('/member-profile/{id}', [MemberApiController::class, 'memberProfile']);
    Route::post('/change-password/{id}', [MemberApiController::class, 'changePassword']);
    Route::post('/change-email/{id}', [MemberApiController::class, 'changeEmail']);
    Route::post('/my-account-regular-search/{start}/{end}', [MemberApiController::class, 'myAccountRegularSearch']);
    Route::post('/my-account-advanced-search/{start}/{end}', [MemberApiController::class, 'myAccountAdvancedSearch']);
    Route::post('/all-caste', [MemberApiController::class, 'allCaste']);
    Route::get('/connect-invitation/{to}/{from}', [MemberApiController::class, 'connectInvitation']);
    Route::get('/contact-invitation/{to}/{from}', [MemberApiController::class, 'contactInvitation']);
    Route::get('/check-invitation/{from}/{to}', [MemberApiController::class, 'checkInvitation']);
    Route::get('/ignore/{memberId}/{ignoreId}', [MemberApiController::class, 'Ignored']);
    Route::get('/block/{memberId}/{blockId}', [MemberApiController::class, 'Blocked']);
    Route::post('/report/{memberId}/{reportId}', [MemberApiController::class, 'Reported']);
    Route::get('/shortlist/{memberId}/{shortlistId}', [MemberApiController::class, 'Shortlisted']);
    Route::get('/invitations/{memberId}', [MemberApiController::class, 'Invitation']);
    Route::get('/accepted-invitations/{memberId}', [MemberApiController::class, 'acceptedInvitation']);
    Route::get('/declined-invitations/{memberId}', [MemberApiController::class, 'declinedInvitation']);
    Route::get('/sent-invitations/{memberId}', [MemberApiController::class, 'sentInvitation']);
    Route::post('/update-invitation-status/{fromId}/{toId}', [MemberApiController::class, 'updateInvitationStatus']);
    Route::get('/cancel-invitation/{fromId}/{toId}', [MemberApiController::class, 'cancelInvitationStatus']);
    Route::get('/pending-request/{memberId}', [MemberApiController::class, 'pendingRequestList']);
    Route::get('/accepted-request/{memberId}', [MemberApiController::class, 'acceptedRequestList']);
    Route::get('/sent-request/{memberId}', [MemberApiController::class, 'sentRequestList']);
    Route::post('/new-match', [MemberApiController::class, 'newMatch']);
    Route::post('/filter-result', [MemberApiController::class, 'filterResult']);
    Route::get('/my-account-data/{id}', [MemberApiController::class, 'myAccountData']);
    Route::post('/upload-image/{id}', [MemberApiController::class, 'uploadProfileImage']);
    Route::post('/upload-gallery-image/{id}', [MemberApiController::class, 'uploadGalleryImage']);
    Route::get('/member-galley/{id}', [MemberApiController::class, 'getGalleryImage']);
    Route::get('/make-profile-photo/{id}/{index}', [MemberApiController::class, 'makeProfilePhoto']);
    Route::get('/remove-photo/{id}/{index}', [MemberApiController::class, 'removePhoto']);
    Route::get('/update-photo-settings/{id}/{type}', [MemberApiController::class, 'photoSettings']);
    Route::get('/dynamic-page/{id}', [MemberApiController::class, 'dynamicPage']);
    ############################ Frontend Api Route End  ################################
    
    ############################ Backend Api Route Start  ################################
    Route::get('/post', [MemberController::class, 'memberPost']);
    Route::get('/member-block/{id}', [MemberController::class, 'memberBlock'])->name('member-block');
    Route::get('/member-unblock/{id}', [MemberController::class, 'memberUnblock'])->name('member-unblock');
    Route::get('/member-featured/{id}', [MemberController::class, 'memberFeatured'])->name('member-featured');
    Route::get('/member-unfeatured/{id}', [MemberController::class, 'memberUnfeatured'])->name('member-unfeatured');
    Route::post('/member-group/{id}', [MemberController::class, 'memberGroup'])->name('member-group');
    Route::get('/member-package/{id}', [MemberController::class, 'memberPackage'])->name('member-package');
    Route::post('/update-package', [MemberController::class, 'updatePackage'])->name('update-package');
    Route::get('/states/{id}', [MemberController::class, 'statesInCountry'])->name('states');
    Route::get('/cities/{id}', [MemberController::class, 'citiesInState'])->name('cities');
    Route::get('/postcode/{id}', [MemberController::class, 'postCode'])->name('postcode');
    Route::get('/castes/{id}', [MemberController::class, 'allCastes'])->name('castes');
    Route::get('/sub_castes/{id}', [MemberController::class, 'allSubCastes'])->name('sub_castes');
    Route::post('/member-info', [MemberController::class, 'memberInfo'])->name('member-info');
    Route::get('/publish-story/{id}', [MemberController::class, 'publishStory'])->name('publish-story');
    Route::get('/unpublish-story/{id}', [MemberController::class, 'unpublishStory'])->name('unpublish-story');
    Route::get('/plan-detail/{id}', [MemberController::class, 'planDetail'])->name('plan-detail');
    ############################ Backend Api Route End  ################################
});
