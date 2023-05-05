<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmployeeProfile extends Model
{
    use HasFactory;

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    // fillable
    protected $fillable = [
        'uuid',
        'user_id',
        'employee_tier',
        'employee_stats',
        'institution',
        'join_date',
        'stop_date',
    ];

    // function relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $appends = [
        'length_of_work'
    ];

    public function getLengthOfWorkAttribute()
    {
        // format date
        $join_date = \Carbon\Carbon::parse($this->join_date);
        $stop_date = \Carbon\Carbon::parse($this->stop_date);

        if ($stop_date == null) {
            $stop_date = now();
        }

        // return length of work to diffForHumans

        return $join_date->diffForHumans($stop_date);
    }

    public function attendances()
    {
        return $this->hasMany(Attendances::class, 'employee_id', 'id');
    }
}
