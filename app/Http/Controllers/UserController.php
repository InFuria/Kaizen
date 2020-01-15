<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\UserRequest;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::index The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            if (session('till') === null && auth()->user()->ci != 7424196)
                return redirect()->back()->with('error', 'Seleccione la caja a operar para ver las posibles transacciones');

            $users = User::all();

            return view('users.index', compact('users'));

        } catch (\Exception $e){
            \Log::error('UserController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function create()
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::create The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $branches = Branch::all()->pluck('name', 'id');

            return view('users.create', compact('branches'));

        } catch (\Exception $e){
            \Log::error('UserController::create ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function store(UserRequest $request)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::store The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $request->status = 1;
            $user = User::create($request->except(['_token','_method','pass_confirmation']));
            $user->roles()->attach(Role::where('slug', 'new')->first()->id);

            return redirect()->back()->with('success', "El usuario {$user->username} ha sido creado con exito!");

        } catch (\Exception $e){
            \Log::error('UserController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function show(User $user)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::show The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $roles = $user->roles()->first()->name;

            return view('users.show', compact('user', 'roles'));

        } catch (\Exception $e){
            Log::error('UserController::show ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function edit(User $user)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::edit The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            return view('users.edit', compact('user'));

        } catch (\Exception $e){
            Log::danger('UserController::edit ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function update(UserRequest $request, $id)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::update The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $user = User::where('id', $id)->update($request->except(['_token','_method','pass_confirmation']));

            return redirect()->back()->with('success', "El usuario {$user->username} ha sido actualizado con exito!");

        } catch (\Exception $e){
            Log::error('UserController::update ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function destroy(User $user)
    {
        //

    }

    public function ban(User $user)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                \Log::warning('UserController::ban The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $user->status = !$user->status;
            $user->save();

            return redirect()->back()->with('success', "El estado del usuario $user->username ha sido modificado con exito!");

        } catch (\Exception $e){
            Log::danger('UserController::ban ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }
}
