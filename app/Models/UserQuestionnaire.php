<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestionnaire extends Model
{
    use HasFactory;

    protected $table = 'user_questionnaires';

    protected $fillable = [
        'user_id',
        'client_name',
        'date',
        'practice_manager',
        'clinicians',
        'answers',
        'payment_status',
        'certificate_data',
        'audit_result',
        'status',
        'file_status'
        
    ];

    protected $casts = [
        'answers' => 'array',
        'certificate_data' => 'array',
        'audit_result' => 'array',
        'date' => 'date',
    ];

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(UserQuestionnaire::class)->orderByDesc('created_at');
    }

    // Latest questionnaire helper
    public function latestQuestionnaire()
    {
        return $this->hasOne(UserQuestionnaire::class)->latestOfMany();
    }

    public function vaultPayment()
    {
        // Use the correct foreign key 'questionnaire_id'
        return $this->hasOne(VaultPayment::class, 'questionnaire_id');
    }
    
    public function vaultPayments()
    {
        return $this->hasMany(VaultPayment::class, 'questionnaire_id')->orderByDesc('created_at');
    }
    
    public function phases()
    {
        return $this->hasMany(VaultPhase::class,'questionnaire_id');
    }

}