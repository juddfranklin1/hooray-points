<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\{ Reward, User };
use Illuminate\Database\Eloquent\Relations\Pivot;

class RewardUser extends Pivot {
    protected $appends = ['human_date', 'total_cost'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reward() {
        return $this->belongsTo(Reward::class);
    }

    public function getTotalCostAttribute() {
        return $this->reward->cost * $this->multiplier;
    }

    public function getHumanDateAttribute() {
        $createdDate = new Carbon($this->created_at);

        return $createdDate->toDayDateTimeString();
    }
}
