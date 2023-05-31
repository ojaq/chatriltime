<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'last_time_message'
    ];

    // protected $guarded = [];

    public function message() {
        return $this->hasMany(Message::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
