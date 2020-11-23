<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\{ Action, User };
use Illuminate\Database\Eloquent\Relations\Pivot;

class ActionUser extends Pivot {
    protected $appends = ['human_date', 'total_value'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function action() {
        return $this->belongsTo(Action::class);
    }

    public function getTotalValueAttribute() {
        return $this->action->value * $this->multiplier;
    }

    public function getHumanDateAttribute() {
        $createdDate = new Carbon($this->created_at);

        return $createdDate->toDayDateTimeString();
    }
}
