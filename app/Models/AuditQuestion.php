<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditQuestion extends Model
{

    protected $fillable = [

        'question',
        'type',
        'options',
        'risk_answer',
        'risk_title',
        'risk_description',
        'status',
        'sort_order'

    ];

}