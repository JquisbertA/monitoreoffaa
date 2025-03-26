<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function ListarUsuarios(Request $request){
        $buscar = $request->buscar;

        if ($request->buscar == ''){
            $data = DB::table('users')->orderBy('id')->get();
        }
        else{
            $data = DB::table('users')
            ->orderBy('id')
            ->where(function ($q) use ($buscar){
                $q->where('name','like','%'.$buscar.'%')
                ->orwhere('email','like','%'.$buscar.'%');
            })->get();
            /* ->where('descripcion','like','%'.$request->buscar.'%')
            ->get(); */
        }

        return response()->json($data);
    }

    public function CrearUsuario(Request $request)
    {
        //dd(Auth::user()->id);
        // Generador de Contraseña aleatoria
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i=0; $i < 10; $i++) {
            $randomString .= $characters[rand(0,$charactersLength - 1)];
        }
        
        $verificacion = User::where('email',$request->email)->exists();
        if ($verificacion) {
            return response()->json(['code' => $verificacion, 'mensaje' => 'El correo ya fue registrado revise sus datos.','tipo'=>'error', 'titulo'=>'Error']);
        } else {
            try {
                DB::beginTransaction();
                $user = User::create([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'password'  => '$2y$10$2Oc2eL0YYJRc0dI0GUUB3.molpf6GUlxLJtL4UptOnm7f8fmvSlSy', //Hash::make($request->password),
                    'estado'    => '1',
                    'sysuser'   => Auth::user()->id,
                    /* 'rol'       => $request->rol */
                ]);

                //$user->assignRole($request->rol);
                DB::commit();

                // Mail::to($request->email)
                // ->send(new AccesoUsuarios($request, $randomString));
                return response()->json(200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(400);
            }
            return response()->json("200");
        }
        // return response()->json($request);
    }

    public function DatosUsuarios(Request $request){
        $id = $request->id;
        /* $usuarios = DB::table('users as u')
        ->join('personals as p','u.percod','p.per_codigo')
        ->select('u.id','u.estado','p.per_nombre as nombre','p.per_paterno as paterno',
                'p.per_materno as materno','p.per_foto as foto', 'p.per_ci as ci','p.per_expedido as expedido','p.per_mail'
                )

            ->where('u.id',$id)
            ->first(); */
        $usuarios = DB::table('users as u')
            ->select('u.id','u.estado','u.name','u.email'
                    )
                ->where('u.id',$id)
                ->first();
        /* $rol = DB::table('model_has_roles as mr')
            ->join('roles as r','mr.role_id','r.id')
            ->select('r.id','r.name')
            ->where('mr.model_id',$id)
            ->first(); */
        return response()->json($usuarios/*, 'role'=>$rol */);
    }

    public function EditarUsuario(Request $request){
        $id = $request->id;
        $password = $request->password;
        $user = User::find($id);
        DB::table('users')
        ->where('id',$id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            /* 'rol' => '1', */
        ]);

        if ($password != '') {
            DB::table('users')
            ->where('id',$id)
            ->update([
                'password' => Hash::make($password)
            ]);
        }

        /* $user->removeRole($request->rolAn);
        $user->assignRole($request->rolNu); */

        return response()->json($request);
    }

    public function DesactivarUsuario(Request $request){
        $usuario = User::findOrFail($request->id);
        $usuario->estado = '0';
        $usuario->save();
    }
}
