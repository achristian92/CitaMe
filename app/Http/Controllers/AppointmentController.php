<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create(HorarioServiceInterface $horarioServiceInterface)
    {
        $specialties = Specialty::all();

        $specialtyId = old('specialty_id');
        if ($specialtyId)
        {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }

        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId)
        {
            $intervals = $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
        }else {
            $intervals = null;
        }

        return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(Request $request)
    {

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id'=> 'exists:specialties,id'
        ];

        $messages = [
            'scheduled_time.required' => 'Debe Seleccionar una Hora Valida para su Cita.',
            'type.required' => 'Debe Seleccionar el Tipo de Consulta.',
            'description.required' => 'Debe poner sus sintomas.'
        ];

        $this->validate($request, $rules, $messages);

        $data = $request->only([
            'scheduled_time',
            'scheduled_date',
            'type',
            'description',
            'doctor_id',
            'specialty_id'
        ]);

        $data['patient_id'] = auth()->id();

        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        Appointment::create($data);

        $notification = 'La Cita se ha Realizado Exitosamente.';

        return back()->with(compact('notification'));
    }
}
