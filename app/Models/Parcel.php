<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'user_id',

        'sender_name',
        'sender_phone',
        'sender_address',

        'receiver_name',
        'receiver_phone',
        'receiver_address',

        'parcel_type',
        'weight',
        'current_status',
        'estimated_delivery_date',
    ];

    protected $casts = [
        'estimated_delivery_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(ParcelStatusHistory::class);
    }
}