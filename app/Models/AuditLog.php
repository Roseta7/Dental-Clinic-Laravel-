<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLog extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'action_type',
        'table_name',
        'record_id',
        'action_details',
        'action_time',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'action_type'=> 'string',
        'record_id'=> 'integer',
        'action_time'=> 'datetime',
    ];

    /**
     * Relationships
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
