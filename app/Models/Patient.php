<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_name',
        'patient_gender',
        'patient_phone',
        'patient_email',
        'date_of_birth',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'patient_gender'=>'string',
    ];

    /**
     * Relationships
     */
    public function appointments(){
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function treatments(){
        return $this->hasManyThrough(Treatment::class, Appointment::class, 'patient_id', 'appointment_id', 'id', 'id');
    }

    public function invoices(){
        return $this->hasManyThrough(Invoice::class, Appointment::class, 'patient_id', 'appointment_id', 'id', 'id');
    }

    public function radiographs(){
        return $this->hasManyThrough(Radiograph::class, Appointment::class, 'patient_id', 'appointment_id', 'id', 'id');
    }

    public function scopeVisibleTo(Builder $query, User $user){

        if($user->hasRole('dentist')){
            return $query->whereHas('appointments', function($q) use ($user){
                $q->where('dentist_id', $user->id);
            });
        }

        return $query;
    }

    /**
     * Scope: To facilitate the search for a patient by name.
     * EX: Patient::searchByName('Ali')->get();
     */
    public function scopeSearchByName($query, $name){
        return $query->where('patient_name','like', "%{$name}%");
    } 
}
