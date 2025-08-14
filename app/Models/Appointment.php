<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'dentist_id',
        'appointment_date',
        'appointment_time',
        'appointment_cost',
        'appointment_status',
        'visit_type',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'appointment_cost'=>'decimal:2',
        'appointment_status'=>'string',
        'visit_type'=>'string',
    ];

    /**
     * Relationships
     */
    public function dentist(){
        return $this->belongsTo(Dentist::class, 'dentist_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function treatments(){
        return $this->hasMany(Treatment::class, 'appointment_id');
    }

    public function invoice(){
        return $this->hasOne(Invoice::class, 'appointment_id');
    }

    public function radiographs(){
        return $this->hasMany(Radiograph::class, 'appointment_id');
    }

    public function doctorNotes(){
        return $this->hasManyThrough(DoctorNote::class, Treatment::class, 'appointment_id', 'treatment_id', 'id', 'id');
    }

    public function scopeVisibleTo(Builder $query, $user): Builder
    {
        if($user->hasRole('dentist')){
            return $query->where('dentist_id', $user->id);
        }
        return $query;
    }
}
