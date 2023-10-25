<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\BuyerUserHot;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Models\Buyers;

class ExportHotReport implements FromCollection, WithHeadings
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //$query = BuyerUserHot::select('buyer_user_hot.buyer_id', 'buyer_user_hot.agent_id', DB::raw('CONCAT(agents.firstname, " ", agents.lastname) as agent_name'), DB::raw('CONCAT(buyer_users.firstname, " ", buyer_users.lastname) as buyer_name'));
        
        /* 16-AUG-2023
        $query = BuyerUserHot::select(DB::raw('CONCAT(agents.firstname, " ", agents.lastname) as agent_name'), DB::raw('CONCAT(buyer_users.firstname, " ", buyer_users.lastname) as buyer_name'), 'willlistingno');
        $query->leftJoin('agents', 'agents.id','=','buyer_user_hot.agent_id');
        $query->leftJoin('buyer_users', 'buyer_users.id','=','buyer_user_hot.buyer_id');

        $buyer_user_hot = $query->get();

        return $buyer_user_hot;   */

        $query = Buyers::select('buyer_users.firstname', 'buyer_users.lastname', 'buyer_users.email', 'buyer_users.phoneno', 'buyer_users.cellno', 'buyer_users.willlistingno')->with('hot')->whereHas('hot');

        //$query->leftJoin('listing', 'listing.id','=','buyer_users.willlistingno');

        //DB::raw('DATE_FORMAT(buyer_user_notes.created_at, "%d-%b-%Y") as date_note_created'),
        //$query->leftJoin('buyer_user_notes', 'buyer_user_notes.listing_id','=','buyer_users.willlistingno');

        // $query->with(['listing' => function($listing) {
        //     $listing->select('id', 'bname', 'bstatuslist', 'bamount');
        // }]);

        $buyers = $query->get();

        return $buyers;
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Contact Phone',
            'Cell Phone',
            'Listing Number',
            // 'Latest Note',
            // 'Date of Note',
            //'POF',
        ];


        /* 16-AUG-2023
        return [
            'BuyerName',
            'AgentName',
            'ListingID'
        ]; */

        // return [
        //     'BuyerID',
        //     'AgentID'
        // ];
    } 
}
