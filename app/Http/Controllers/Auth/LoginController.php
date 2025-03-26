<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {   
        $email = $request->email;
        $password = $request->password;
        /* $respuesta = Auth::attempt(['email' => $email, 'password' => $password, 'estado'=>1]);
        if ($respuesta) {
            return response()->json([
                'authUser' => Auth::user(),
                'code' => 200
            ]);
        } else {
            return response()->json([
                'code' => 401
            ]);
        }
        return response()->json($respuesta); */
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'code' => 401,
                'message' => 'El usuario no existe.'
            ]);
        }
    
        // Verificar si el usuario está bloqueado
        if ($user->locked_until && Carbon::now()->lt($user->locked_until)) {
            return response()->json([
                'code' => 403,
                'message' => 'Su cuenta está bloqueada. Intente nuevamente en unos minutos.'
            ]);
        }
    
        // Intentar autenticar si eso correcto ingresa
        if (Auth::attempt(['email' => $email, 'password' => $password, 'estado' => 1])) {
            // Resetear intentos fallidos y desbloquear usuario
            $user->login_attempts = 0;
            $user->locked_until = null;
            $user->save();
    
            return response()->json([
                'authUser' => Auth::user(),
                'code' => 200
            ]);
        } else {
            // Aumentar intentos fallidos
            $user->login_attempts += 1;
    
            if ($user->login_attempts >= 3) {
                $user->locked_until = Carbon::now()->addMinutes(1440); // Bloqueo por 1440 minutos (calculado para un dia)
                $user->save();
                return response()->json([
                    'code' => 403,
                    'message' => 'Ha excedido el número de intentos.  Intenté nuevamente dentro de 24 horas o comuníquese con el administrador'
                ]);
            }
    
            $user->save();
    
            // Mensaje de advertencia cuando ya tiene 2 errores
            if ($user->login_attempts == 2) {
                return response()->json([
                    'code' => 402,
                    'message' => 'Último intento disponible antes del bloqueo de su cuenta.'
                ]);
            }
    
            return response()->json([
                'code' => 401,
                'message' => 'Credenciales de acceso incorrectos...!!!'
            ]);
        }

    }

    public function logout(Request $request)
    {   
        Auth::logout();
        return redirect("/");
    }

    public function ver()
    {
        return response()->json([
            'authUser' => Auth::user()->percod,
            'code' => 200
        ]);
    }
}
