<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'priority',
        'department',
        'description',
        'image',
    ];

    public function users(){
      return $this->belongsTo(User::class);
    }

    public function ticket_replies(){
      return $this->hasMany(TicketReply::class);
    }
}
