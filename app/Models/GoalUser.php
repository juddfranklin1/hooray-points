<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\{ Goal, User };
use Illuminate\Database\Eloquent\Relations\Pivot;

class GoalUser extends Pivot {
    protected $appends = ['human_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function goal() {
        return $this->belongsTo(Goal::class);
    }

    public function getHumanDateAttribute() {
        $createdDate = new Carbon($this->created_at);

        return $createdDate->toDayDateTimeString();
    }
}
