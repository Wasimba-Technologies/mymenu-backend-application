<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

    public function subscription()
    {
        $this->belongsTo(Subscription::class);
    }
}
