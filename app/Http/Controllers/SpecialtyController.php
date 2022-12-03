<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view ('specialties.create');
    }

    public function sendData(Request $request)
    {
        $rules =
        [
          'name' => 'required|min:4'
        ];

        $messages =
        [
            'name.required' => 'Este campo no debe estar vacio.',
            'name.min' => 'Debe contener al menos 4 caracteres.'
        ];

        $this->validate($request,$rules,$messages);

        $specialty = new Specialty();
        $specialty-> name = $request->input('name');
        $specialty-> description = $request->input('description');
        $specialty->save();

        return redirect('/especialidades');
    }
}
