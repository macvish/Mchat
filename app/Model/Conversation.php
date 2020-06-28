<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Conversation extends Model
{
    use Notifiable;
    
    protected $table = 'conversations';

    protected $fillable = [
        'user_id',
        'to'
    ];

    protected $primaryKey = 'id';

    public function messages()
    {
        $this->hasMany(Message::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
