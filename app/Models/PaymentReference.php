<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_id',
        'user_id',
        'amount',
        'description',
        'status',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($paymentReference) {
            if (empty($paymentReference->reference_id)) {
                $paymentReference->reference_id = 'REF-' . strtoupper(Str::random(12));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'reference_id', 'reference_id');
    }

    public function isExpired()
    {
        if ($this->status === 'expired') {
            return true;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            if ($this->status === 'pending') {
                $this->update(['status' => 'expired']);
            }
            return true;
        }

        return false;
    }

    public function isUsed()
    {
        return $this->status === 'used';
    }
}