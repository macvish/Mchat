<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'conversation_id',
        'message'
    ];

    protected $primaryKey = 'id';

    public function convo()
    {
        $this->belongsTo(Conversation::class);
    }
}
