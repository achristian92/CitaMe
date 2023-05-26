<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_time',
        'scheduled_date',
        'type',
        'description',
        'doctor_id',
        'patient_id',
        'specialty_id'
    ];
}
