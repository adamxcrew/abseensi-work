<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attendances extends Model
{
    use HasFactory;

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

    protected $fillable = [
        'employee_id',
        'presence_date',
        'presence_status',
        'presence_desc',
        'clock_in',
        'clock_out',
        'location_in',
        'location_out',
        'presence_pict_in',
        'presence_pict_out',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'presence_date' => 'date',
    ];

    /**
     * Get the employee that owns the attendance.
     */
    public function employee()
    {
        return $this->belongsTo(EmployeeProfile::class, 'employee_id', 'id');
    }

    protected $appends = [
        'date',
    ];

    public function getDateAttribute()
    {
        return date('t', strtotime($this->presence_date));
    }

}
