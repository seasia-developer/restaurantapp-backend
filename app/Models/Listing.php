<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'listing';
    // protected $fillable = [
    //     'bname','baddress','bcity','showcity','bstate','bzip','bcounty','bregion','btype','burldes','bkeyword','bheadlinead','bdetailedad','bsaleprice','bprivatelist','bacquiredlist','bstatuslist','bcommissionamount',
    //     'bexpiredate','bclosingdate','bsolddate','bcanceldate','bgradelist','filtertype','bmetadescription','footer','isBat','bprequalification','bamount','cat_tag','next_step'
    // ];
    protected $guarded = ['id'];
    protected $hidden = ['updated_at'];


    // public function office()
    // {
    //     return $this->belongsTo(ListingOffice::class, 'id', 'listing_id');
    // }

    // public function franchise()
    // {
    //     return $this->hasOneThrough(
    //         ListingOffice::class,
    //         Agents::class,
    //         'olagent', // Foreign key on the owners table...
    //         'listing_id', // Foreign key on the cars table...
    //         'id', // Local key on the mechanics table...
    //         'id' // Local key on the cars table...
    //     );

    //     //return $this->belongsTo(Agents::class, 'id', 'listing_id');
    // }


    public function agent()
    {
        return $this->belongsTo(Agents::class, 'olagent', 'id');
    }

    
    public function Listing_category()
    {
        return $this->belongsTo(ListingCategory::class, 'btype', 'id');
    }

    public function agent_details()
    {
        return $this->belongsTo(AgentDetails::class, 'olagent', 'agent_id');
    }

    public function franchise_office()
    {
        return $this->belongsTo(Agents::class, 'franchiseofficeid', 'id');
    }

    public function getDuplicateData()
    {
        return $this->belongsTo(static::class, 'duplicate_id', 'id')->select(['id', 'bname as business_name','baddress as business_address','bcity as city','showcity as city_confidential','bstate as state','bzip as zip_code','bcounty as county','bregion as market','btype as category','burldes as url_description','bkeyword as key_word','bheadlinead as headline_ad','bdetailedad as detailed_ad','bsaleprice as sale_price','bprivatelist as private_listing','bacquiredlist as lead_source','bstatuslist as listing_status','bcommissionamount as commission_amount','bexpiredate as expire_date','bclosingdate as closing_date','bsolddate as sold_date','bcanceldate as cancelled_date','bgradelist as listing_grade','filtertype','bmetadescription as meta_description','footer','isBat as is_listing_BAT','bprequalification as buyer_prequalification_required','bamount as amount','cat_tag', 'daysonmarket', 'comingsoon_date', 'activate', 'olagent', 'franchiseofficeid', 'selling_price', 'commission_payable', 'buyer_email', 'amount_pay', 'date_on_pay', 'lender_attor','loan_amount', 'ref_fee_per', 'vendor_attor', 'another_field', 'key_number', 'cancel_reason', 'escrow_fee', 'escrow_amount', 'amount_fee', 'date_on_fee', 'buyers_id', 'contract_date', 'filtertype','next_step']);
    }

    public static function getTotalUpdate($data, $totalChange)
    {
        $originalData = array_values($data['restaurant']);
        $originalKey=array_keys($data['restaurant']);
        $duplicateData = array_values($data['restaurant']['get_duplicate_data']);
        $duplicateKey = array_keys($data['restaurant']['get_duplicate_data']);
        for ($x = 0; $x < count($duplicateData); $x++) {
            if($originalData[$x] != $duplicateData[$x]){
                $totalChange['originalData'][$originalKey[$x]] = $originalData[$x];
                $totalChange['duplicateData'][$duplicateKey[$x]] = $duplicateData[$x];
            }
        }
        return $totalChange;
    }

    public function getDeletedByData()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    // public function seller()
    // {
    //     return $this->belongsTo(ListingSeller::class, 'id');
    // }
    public function seller()
    {
        return $this->belongsTo(ListingSeller::class, 'id', 'listing_id');
    }

    public function adNumber()
    {
        return $this->hasMany(WebsitePosting::class, 'listing_id');
    }
    // 
    public function office()
    {
        return $this->belongsTo(ListingOffice::class, 'id', 'listing_id');
    }
    // InContractAndLOI
    public function inContractAndLOI()
    {
        return $this->belongsTo(InContractAndLOI::class, 'id', 'listing_id');
    }
    public function listingState()
    {
        return $this->belongsTo(ListingState::class, 'bstate', 'short_code');
    }

    public function listing_ops()
    {
        return $this->belongsTo(ListingOps::class, 'id', 'listing_id');
    }

    public function listing_bat()
    {
        return $this->belongsTo(ListingBat::class, 'id', 'listing_id');
    }

    public function listing_media()
    {
        return $this->belongsTo(ListingMedia::class, 'id', 'listing_id');
    }

    public function listing_sub_media()
    {
        return $this->hasMany(ListingMediaSubImages::class,  'listing_id', 'id');
    }

    public function listing_occupancy_lease()
    {
        return $this->belongsTo(ListingOccupancyLease::class, 'id', 'listing_id');
    }

    public function listing_equipment()
    {
        return $this->belongsTo(ListingEquipment::class, 'id', 'listing_id');
    }

    public function listing_occupancy_real_estates(){
        return $this->belongsTo(ListingOccupancyRealEstate::class, 'id', 'listing_id');
    }

    public function listing_headlines(){
        return $this->belongsTo(ListingHeadlines::class, 'id', 'listing_id');
    }

    public function sold(){
        return $this->belongsTo(InContractAndLOI::class, 'id', 'listing_id');
    }

    public function listing_prices(){
        return $this->hasMany(ListingPrice::class, 'listing_id', 'id');
    }

    public function track_on_listingstatus(){
        return $this->hasMany(TrackOnListingStatus::class, 'listing_id', 'id');
    }

    public function fetchallListingsById($listingId) {
        $result = $this->where('bstatuslist','!=','Expired')->where('bstatuslist' ,'!=','Cancelled')->whereIn('id', explode(',', $listingId))->pluck('olagent');
        return $result;
    }

    public function fetchAllAgentsByids($agentid){
        $sql = "SELECT `firstname`, `lastname`, `username`,email,agentid,franchiseofficeid FROM agents WHERE `agentid` IN (" . $agentid . ")";  
        $result = $this->db_query($sql);

        $result = Agents::whereIn('id', explode(',', $agentid))->pluck('firstname', 'lastname', 'username','email','agentid','franchiseofficeid');
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_object($result)){
                $data['firstname'] = $row->firstname.' '.$row->lastname;
                $data['email'] = $row->email;
                $data['agentid'] = $row->agentid;
                $data['franchiseofficeid'] = $row->franchiseofficeid;
                //$html = '<option >'.$row->firstname.' '.$row->lastname.'</option>';
                $dataArr[] = $data;
            }   
        } 
        return $dataArr;
    }

    // public function fetchAllReviewErrorsById() {
        
    //     $result = count(app('App\Http\Controllers\Api\Listing\ReviewController')->getMinorErrors(5));
               
       
    //     return $result;
    // }
} 
