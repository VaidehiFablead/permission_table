<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $table='chat_messages';
    protected $fillable = ['user_id','role','content','meta'];
    protected $casts = [
        'meta' => 'array',
    ];
}
