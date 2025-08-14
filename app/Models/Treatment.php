<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'appointment_id',
        'treatment_date',
        'treatment_type',
        'treatment_procedure',
        'treatment_cost',
        'treatment_status'
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'treatment_type'=>'string',
        'treatment_status'=>'string',
    ];

    /**
     * Relationships
     */
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function doctoNotes(){
        return $this->hasMany(DoctorNote::class);
    }

    public function medicalHistory(){
        return $this->belongsTo(MedicalHistory::class);
    }

    public function getPatientAttribute(){
        return $this->appointment?->patient;
    }

    public function getDentistAttribute(){
        return $this->appointment?->dentist;
    }

    public function scopeVisibleTo(Builder $query, $user): Builder
    {
        if($user->hasRole('dentist')){
            return $query->whereHas('appointment', function ($q) use ($user){
                $q->where('dentist_id', $user->id);
            });
        }

        return $query;
    }
}
