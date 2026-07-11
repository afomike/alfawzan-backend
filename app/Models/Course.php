<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'description',
        'target_audience',
        'base_price',
        'duration',
        'pricing_tiers',
        'is_active',
    ];

 
    protected $casts = [
        'base_price'    => 'decimal:2',
        'pricing_tiers' => 'array',   
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(DrivingSchoolRegistration::class, 'course_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}