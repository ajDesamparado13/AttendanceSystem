<?php

namespace App\Entities;

use App\Scopes\Timelogs\UserScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Timelog.
 *
 * @package namespace App\Entities;
 */
class Timelog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'timelogs';
    protected $fillable = [
        'causer_type', 'causer_id', 'action',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }

    public function getCreatedAtAttribute($val)
    {

        return Carbon::parse($val)->toDayDateTimeString();
    }
}