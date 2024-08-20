<?php

namespace App\Models;

use App\Models\PropertyAuction;
use App\Models\PropertyAuctionBid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function propertyAuctionBids()
    {
        return $this->hasOne(PropertyAuctionBid::class,'notification_id','id');
    }

}
