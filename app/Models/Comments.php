<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;


    protected $fillable = [
        'body',
        'articles_id',
        'user_id',

    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function articles()
    {
        return $this->belongsTo(Articles::class);
    }
}
