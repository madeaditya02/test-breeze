<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['public_id', 'name', 'start_date', 'end_date'];
    /**
     * Get all of the activities for the Plan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->orderBy('time', 'asc');
    }

    /**
     * The users that belong to the Plan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'plan_user', 'plan_id', 'user_id')->withPivot('role', 'accepted_at');
    }

    /**
     * Get all of the stories for the Plan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}