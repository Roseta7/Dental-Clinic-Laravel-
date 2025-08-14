<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Radiograph extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'appointment_id',
        'dateTaken',
        'imageDescription',
        'image_path'
    ];

    /**
     * Relationships
     */
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function getDentistAttribute(){
        return $this->appointment?->dentist;
    }

    public function getPatientAttribute(){
        return $this->appointment?->patient;
    }

    public function scopeVisibleTo(Builder $query, $user): Builder
    {
        if ($user->hasRole('dentist')){
            return $query->whereHas('appointment', function ($q) use ($user) {
                $q->where('dentist_id', $user->id);
            });
        }

        return $query;
    }
}
