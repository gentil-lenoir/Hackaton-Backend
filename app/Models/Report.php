<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'status',
        'category',
        'location',
        'ai_report',
        'recommended_action',
        'description',
        'user_id',
        'image',
        'priority',
        'user_comments',
        'solving_process',
        'quotation',
        
    ];


    function user()
    {
        return $this->belongsTo(User::class);
    }
}
