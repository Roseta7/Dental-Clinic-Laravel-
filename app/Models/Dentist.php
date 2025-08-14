<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dentist extends Model
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = false; // because the primary key is not auto-incrementing.

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'specialty',
        'years_of_experience',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'years_of_experience'=> 'integer',
    ];

    /**
     * Relationship to the User (1 to 1)
     */
    public function user(){
        return $this->belongsTo(User::class ,'id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'dentist_id');
    }
}
