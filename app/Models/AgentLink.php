<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AgentLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'unique_link',
        'name',
        'description',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'full_url',
        "total_enrolled"
    ];

    public function getTotalEnrolledAttribute(): int
    {
        return $this->registrations()->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agentLink) {
            if (empty($agentLink->unique_link)) {
                $agentLink->unique_link = Str::random(32);
            }
        });
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'agent_link_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(DrivingSchoolRegistration::class, 'agent_link_id');
    }

    public function getFullUrlAttribute(): string
    {
        return 'http://localhost:3000/dashboard/application/registration?agent=' . $this->unique_link;
    }
}