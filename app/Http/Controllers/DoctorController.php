<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(15);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =
        [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'identity_card' => 'required',
            'address' => 'nullable|min:6',
            'phone' => 'required'
        ];
        $messages =
        [
            'name.required' => 'El campo Nombre es obligatorio',
            'name.min' => 'Nombre debe contener al menos 4 carateres',
            'email.requited' => 'EL Correo no debe estar vacio',
            'email.email' => 'La Direccion de Correo es Invalida',
            'identity_card.required' => 'La cedula es requerida',
            'address.min' => 'La direcion debe contener al menos 6 caracteres'
        ];

        $this->validate($request,$rules,$messages);

        User::create
        (
            $request->only('name','email','identity_card','address','phone')
            + [
                'role' => 'doctor',
                'password' => 'bcrypt'($request->input('password'))
              ]
        );
        $notification = 'Medico creado Correctamente';
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);

        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules =
        [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'identity_card' => 'required',
            'address' => 'nullable|min:6',
            'phone' => 'required'
        ];
        $messages =
        [
            'name.required' => 'El campo Nombre es obligatorio',
            'name.min' => 'Nombre debe contener al menos 4 carateres',
            'email.requited' => 'EL Correo no debe estar vacio',
            'email.email' => 'La Direccion de Correo es Invalida',
            'identity_card.required' => 'La cedula es requerida',
            'address.min' => 'La direcion debe contener al menos 6 caracteres'
        ];

        $this->validate($request,$rules,$messages);
        $user = User::doctors()->findOrFail($id);
        $data = $request->only('name','email','identity_card','address','phone');
        $password = $request->input('password');

        if ($password)
            $data['password'] = bcrypt($password);
        $user->fill($data);

        $user->save();

        $NombreMedico = $user->name;
        $notification = 'Los datos del medico '.$NombreMedico.' se han cambiado correctamente';
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::doctors()->findOrFail($id);
        $NombreMedico = $user->name;
        $user->delete();

        $notification = "El medico $NombreMedico se elimino correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }
}
