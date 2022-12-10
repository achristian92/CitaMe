<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horarios;
use Carbon\Carbon;

class HorarioController extends Controller
{
    private $days = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];

    public function edit()
    {
        $days = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
        return view('horario', compact('days'));

    }

    public function store(Request $request){

        dd($request->all());

        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for($i=0; $i<7; ++$i)

            if($morning_start[$i] > $morning_end[$i])
            {
                $errors[] = 'El intervalo de las horas del turno de la mañana del dia'. $this->days[$i].'.';
            }

            if($afternoon_start[$i] > $afternoon_end[$i])
            {
                $errors[] = 'El intervalo de las horas del turno de la tarde del dia'. $this->days[$i].'.';
            }

            Horarios::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->id()

                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end' => $afternoon_end[$i],
                ]
            );

            if(count($errors) > 0)
                return back()->with(compact('err'));

            else

            $notification = 'Los cambios se han guardado correctamente.';
            return back()->with(compact('notification'));
        }
}
