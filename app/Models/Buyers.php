<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyers extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'buyer_users';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];
    
//     protected $fillable = ['id','email','password','firstname','lastname','staddress','city','state','country','postalcode','phoneno','cellno','islicestate',
// 'experince','isown','cashinhand','desiredrestaurant','lookingstates','sourcehear','helptxt'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];


    public function agent()
    {
        return $this->belongsTo(Agents::class, 'agentid', 'id')->withDefault('');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'willlistingno', 'id')->withDefault('');
    }

    public function ca()
    {
        return $this->belongsTo(CaBuyers::class, 'id', 'buyer_id')->withDefault('');
    }

    public function hot()
    {
        return $this->belongsTo(BuyerUserHot::class, 'id', 'buyer_id')->withDefault('');
    }


    // $query = CaBuyers::select('id', 'buyer_id', 'listing_id', 'lastviewdate', 'nosigned')->where('buyer_id', $id)
    //         ->with(['listing' => function($listing) {
    //             $listing->select('id', 'bname');
    //         }]);

}
