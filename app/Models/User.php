<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\{ Action, ActionUser, GoalUser, RewardUser, Team };

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'point_total',
        'penalties_total',
        'scores_total',
    ];

    /**
     * Actions that are explicitly designed for this user
     *
     */
    public function assignments() {
        return $this->hasMany(Action::class)->withTimestamps();
    }

    /**
     * Things this user did that were worth points or negative points.
     */
    public function actions() {
        return $this->belongsToMany(Action::class, 'action_user')
            ->withTimestamps()
            ->using(ActionUser::class)
            ->withPivot('created_at', 'multiplier', 'id')
            ->orderBy('action_user.created_at');
    }

    /**
     * Rewards this user has claimed.
     */
    public function rewards() {
        return $this->belongsToMany(Reward::class, 'reward_user')
            ->withTimestamps()
            ->using(RewardUser::class)
            ->withPivot('created_at', 'multiplier', 'id')
            ->orderBy('reward_user.created_at');
    }

    /**
     * Rewards this user has claimed.
     */
    public function goals() {
        return $this->belongsToMany(Goal::class, 'goal_user')
            ->withTimestamps()
            ->using(GoalUser::class)
            ->orderBy('goal_user.created_at');
    }

    public function teams() {
        return $this->belongsToMany(Team::class);
    }

    public function getPointTotalAttribute() {
        $actionsTotal = 0;
        $rewardsTotal = 0;
        forEach($this->actions as $action) {
            $actionsTotal += $action->value * $action->pivot->multiplier;
        }
        forEach($this->rewards as $reward) {
            $rewardsTotal += $reward->cost * $reward->pivot->multiplier;
        }
        return $actionsTotal - $rewardsTotal;
    }

    public function getPenaltiesTotalAttribute() {
        $penaltiesTotal = 0;
        forEach($this->actions as $action) {
            if($action->value < 0) {
                $penaltiesTotal += $action->value * $action->pivot->multiplier;
            }
        }
        return $penaltiesTotal;
    }

    public function getScoresTotalAttribute() {
        $scoresTotal = 0;
        forEach($this->actions as $action) {
            if($action->value > 0) {
                $scoresTotal += $action->value * $action->pivot->multiplier;
            }
        }
        return $scoresTotal;
    }
}
