<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\Listing\ListingController;
use App\Http\Controllers\Api\Listing\ListingSellerController;
use App\Http\Controllers\Api\Listing\ListingOpsController;
use App\Http\Controllers\Api\Listing\ListingOccupancyLeaseController;
use App\Http\Controllers\Api\Listing\ListingOccupancyRealEstateController;
use App\Http\Controllers\Api\Listing\ListingOfficeController;
use App\Http\Controllers\Api\Listing\ListingHeadlinesController;
use App\Http\Controllers\Api\Listing\SellerNotesController;
use App\Http\Controllers\Api\Listing\ListingMediaController;
use App\Http\Controllers\Api\Listing\ListingMediaSubImagesController;
use App\Http\Controllers\Api\DB\DbScriptController;
use App\Http\Controllers\Api\Listing\ListingMarketingController;
use App\Http\Controllers\Api\Listing\ListingBatController;
use App\Http\Controllers\Api\Listing\ListingEquipmentController;
use App\Http\Controllers\Api\Listing\ListingSpinController;
use App\Http\Controllers\Api\Listing\ListingBuyerNotesController;
use App\Http\Controllers\Api\Listing\ListingDocsController;
use App\Http\Controllers\Api\Listing\RestaurantReviewController;
use App\Http\Controllers\Api\Listing\TrackOnListingStatusController;
use App\Http\Controllers\Api\Listing\QualityController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\Listing\ReviewController;
use App\Http\Controllers\Api\Listing\ListingChecklistController;
use App\Http\Controllers\Api\Listing\ListingChecklistDetailsController;
use App\Http\Controllers\Api\Listing\InContractAndLOIController;
//removed use App\Http\Controllers\Api\Listing\SoldController;
use App\Http\Controllers\Api\Listing\CancelledController;
use App\Http\Controllers\Api\VendorsController;
use App\Http\Controllers\Api\LendersController;
use App\Http\Controllers\Api\RolesController;

// use App\Http\Controllers\Api\BuyerController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\CampaignListController;

use App\Http\Controllers\Api\Buyer\BuyerController;
use App\Http\Controllers\Api\Buyer\EmailAndNotesController;
use App\Http\Controllers\Api\Buyer\PrintBuyerDocsController;
use App\Http\Controllers\Api\Buyer\BuyerTaskController;

use App\Http\Controllers\Api\Listing\ListingDocPdfController;

use App\Http\Controllers\Api\Reports\BbsListingReportdwnldController;
use App\Http\Controllers\Api\Reports\PriceChangeReportController;
use App\Http\Controllers\Api\Reports\FranchiseReportController;
use App\Http\Controllers\Api\Marketing\TestimonialsController;
use App\Http\Controllers\Api\Marketing\SearchCategoryController;
use App\Http\Controllers\Api\Marketing\BlogCategoryController;

use App\Http\Controllers\Api\Accounting\TransactionsController;

use App\Http\Controllers\Api\VideoController;

use App\Http\Controllers\Api\Reports\PhoneBurnerReportController;
use App\Http\Controllers\Api\Reports\NonLookingStateBuyersController;
use App\Http\Controllers\Api\Reports\BbsListingReportDownloadController;
use App\Http\Controllers\Api\Accounting\FranchiseInvoiceController;
use App\Http\Controllers\Api\BuyeruserController;
use App\Http\Controllers\Api\FeaturedlistingController;
use App\Http\Controllers\Api\footerController;




use App\Http\Controllers\Api\Accounting\RoyaltyReportsController;

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\JotformLeadController;
use App\Http\Controllers\Api\MyAccountController;

//user dashboard
use App\Http\Controllers\Api\User\userDashboardController;
use App\Http\Controllers\Api\User\requestController;
use App\Http\Controllers\Api\User\franchisInfoController;

use App\Http\Controllers\Api\Agent\Reports\AgentPipelineController;
use App\Http\Controllers\Api\Agent\Reports\AgentManagersController;
use App\Http\Controllers\Api\Agent\Reports\AgentOfficeController;
use App\Http\Controllers\Api\Agent\Reports\BuyerConversionController;
use App\Http\Controllers\Api\Agent\Reports\OfficePipelineController;


use App\Http\Controllers\Api\SyldialController;
use App\Http\Controllers\Api\EmailBlastController;
use App\Http\Controllers\Api\UploadMarketingController;
use App\Http\Controllers\Api\MarketingReportController;

use App\Http\Controllers\Api\SellerLead\SellerLeadController;
use App\Http\Controllers\Api\SellerLead\SellerLeadValuationController;
use App\Http\Controllers\Api\SellerLead\JotformNoteController;
use App\Http\Controllers\Api\SellerLead\BuyerLeadNoteController;

use App\Http\Controllers\Api\AdManager\AdManagerController;
use App\Http\Controllers\Api\AdManager\AdManagerValuationController;
use App\Http\Controllers\Api\AdManager\AdJotformNoteController;
use App\Http\Controllers\Api\AdManager\AdMangerNoteController;


use App\Http\Controllers\Api\SellerDataController;
use App\Http\Controllers\Api\SuperPipelineController;



use App\Http\Controllers\Api\FranchiseLeadController;


use App\Http\Controllers\Api\Admins\WebsiteAdministration\AdminUrlManagerController;
use App\Http\Controllers\Api\Admins\WebsiteAdministration\AdminAboutUsController;
use App\Http\Controllers\Api\Admins\VendorAdministration\LenderController;
use App\Http\Controllers\Api\Admins\VendorAdministration\VendorController;
use App\Http\Controllers\Api\Admins\WebsiteAdministration\SeoInterfaceController;

use App\Http\Controllers\Api\Admins\TemplateManager\CustomReportTemplateController;
use App\Http\Controllers\Api\Admins\ContractManager\ContractManagerController;

use App\Http\Controllers\Api\Admins\SignedCA\SignedCaController;
use App\Http\Controllers\Api\Admins\TemplateManager\SellerReportTemplateController;

use App\Http\Controllers\Api\Admins\TaskManager\TaskController;
use App\Http\Controllers\Api\Admins\WebsiteAdministration\WebPostingController;

use App\Http\Controllers\HelperScriptsController;

use App\Http\Controllers\Api\ExcelExportReportController;

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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// 12-05


Route::post('addbuyer/',[BuyeruserController::class,'register']);
Route::post('email-check',[BuyeruserController::class,'checkemail']);
Route::get('activate/{email}',[BuyeruserController::class,'activate']);

Route::get('featuredListingSlider/',[FeaturedlistingController::class,'drawFeaturedListingSlider']);
Route::get('restaurent-for-sale/{name}/{listingid}',[FeaturedlistingController::class,'featurelistingdetails']);
Route::get('footerSection/',[footerController::class,'footerSection']);
Route::get('Restaurent-for-sale/{slug}',[footerController::class,'footerdetails']); 
Route::post('also-search',[footerController::class,'alsoSearch']);
Route::post('thankyousellerpage',[requestController::class,'formSave']);


Route::controller(requestController::class)->group(function (){

    Route::post('request-info','storeInfo');
    Route::post('contact-form','contactUs');
    Route::post('registration-contact-form/{id}','registrationForm');
    Route::post('Emai-Restaurant-Broker/{agentemail}', 'RestaurantEmail');


});

Route::controller(franchisInfoController::class)->group(function (){

    Route::post('Franchaies-info','storeFranchaies');
    Route::post('franchise-next-step','nextFranchaies');
});

Route::get('flip-book/{name}/{id}',[BuyeruserController::class,'filpbook']);
Route::post('forgot-password',  [BuyeruserController::class, 'forgotPassword']);
Route::post('reset-password', [BuyeruserController::class, 'verifyPin']);
// Route::post('reset-password', [BuyeruserController::class, 'resetPassword']);


 Route::controller(HelperScriptsController::class)->group(function() {
    Route::get('helper-script', 'index');
}); 






// Verb          Path                        Action  Route Name
// GET           /users                      index   users.index
// GET           /users/create               create  users.create
// POST          /users                      store   users.store
// GET           /users/{user}               show    users.show
// GET           /users/{user}/edit          edit    users.edit
// PUT|PATCH     /users/{user}               update  users.update
// DELETE        /users/{user}               destroy users.destroy
