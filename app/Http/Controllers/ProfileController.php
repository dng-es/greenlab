<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('users.profile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();
        return redirect()->back()->with('status', 'Perfil actualizado correctamente');
    } 


    public function changePassword(UpdatePasswordRequest $request){
        dd("Hola");
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            $status = "Tu contraseña actual no coincide con la facilitada. Por favor inténtalo de nuevo.";
        }
        elseif(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            $status = "La nueva contraseña no puede ser igual a la actual. Por favor elige una contraseña distinta.";
        }
        else{     
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            $status = "¡Contraseña cambiada correctamente!";
        }
 
        return redirect('profile')->with('status', $status);
    }    
}
