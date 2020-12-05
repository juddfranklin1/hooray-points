<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ Action, Reward, Team, User };

class Goal extends Model
{
    use HasFactory;

    protected $with = ['users', 'rewards', 'actions'];

    /**
    * A goal is a model for describing things that a person or team is trying to accomplish.
     *
     * Here are some types of goals:
     * 1. Earn enough points to get a specific reward
     * 2. Earn enough points to get a specific reward by a given date
     * 3. Achieve an arbitrary point total
     * 4. Complete an action daily/weekly/monthly/yearly
     * 5. Complete an action daily/weekly/monthly/yearly until a given date
     * 6. Avoid doing an action
     * 7. Avoid doing an action until a given date
     * 8. Complete an action X number of times
     * 9. Complete a set of actions
     */

    public function actions(){
        return $this->belongsToMany(Action::class);
    }

    public function rewards(){
        return $this->belongsToMany(Reward::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
