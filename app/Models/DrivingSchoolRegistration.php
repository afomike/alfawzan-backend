<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DrivingSchoolRegistration extends Model
{
    use HasFactory;

    protected $table = 'driving_school_registrations';

    protected $fillable = [
        'user_id', 'course_id', 'agent_link_id', 'selected_tier_key', 'final_amount', 'first_name', 
        'surname', 'othername', 'full_name', 'email', 'phone', 'date_of_birth', 
        'gender', 'marital_status', 'mothers_maiden_name', 'blood_group', 'height', 
        'facial_mark', 'requires_glasses', 'has_disability', 'disability_details', 
        'state_of_origin', 'local_govt', 'address', 'nin_number', 'next_of_kin_phone', 
        'license_type', 'additional_info', 'status', 
        'passport_photo'
    ];

    protected $casts = [
        'date_of_birth'   => 'date',
        'facial_mark'     => 'boolean',
        'requires_glasses' => 'boolean',
        'has_disability'  => 'boolean',
        'final_amount'    => 'decimal:2',
    ];

    protected $appends = ['passport_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getFullNameAttribute($value)
    {
        if ($this->first_name && $this->surname) {
            return trim("{$this->first_name} {$this->othername} {$this->surname}");
        }
        return $value;
    }

    public function getPassportUrlAttribute()
    {
        $filePath = $this->passport_photo; 

        if (!$filePath) {
            return null;
        }

        if (filter_var($filePath, FILTER_VALIDATE_URL)) {
            return $filePath;
        }

        return asset(Storage::url($filePath));
    }
}