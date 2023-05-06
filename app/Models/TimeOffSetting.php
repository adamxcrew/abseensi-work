<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffSetting extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    // fillable
    protected $fillable = [
        'jenis_timeoff',
        'description_timeoff',
        'code_timeoff',
        'durasi_timeoff',
    ];

    public function getCodeTimeoffAttribute($value)
    {
        return strtoupper($value);
    }
}
