<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaultPayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'questionnaire_id',
        'plan',
        'amount',
        'payment_method',
        'payment_type',
        'transaction_id',
        'payment_status',
        'paid_at',
        'billing_start',
        'billing_end'
    ];

    protected $dates = [
        'paid_at',
        'deleted_at'
    ];
}