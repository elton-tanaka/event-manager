<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'city', 'promoted', 'image', 'items'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
