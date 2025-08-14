<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'treatment_id',
        'procedure_Summary',
        'diagnosis',
        'previous_Treatments',
        'medical_treat_date',
        'medications',
    ];

    /**
     * Relationships
     */
    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }

        public function getDentistAttribute(){
        return $this->treatment?->appointment?->dentist;
    }

    public function getPatientAttribute(){
        return $this->treatment?->appointment?->patient;
    }

    public function getAppointmentAttribute(){
        return $this->treatment?->appointment;
    }

    public function scopeVisibleTo(Builder $query, $user): Builder
    {
        if ($user->hasRole('dentist')){
            return $query->whereHas('treatment.appointment', function ($q) use ($user) {
                $q->where('dentist_id', $user->id);
            });
        }

        return $query;
    }
}
