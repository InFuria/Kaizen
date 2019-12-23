<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index()
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('RoleController::index The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $roles = Role::all();

            return view('roles.index', compact('roles'));

        } catch (\Exception $e){
            Log::error('RoleController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function create()
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('RoleController::create The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            return view('roles.create');

        } catch (\Exception $e){
            Log::error('RoleController::create ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function store(RoleRequest $request)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('RoleController::store The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $role = Role::create($request->except(['_token','_method']));

            return redirect()->back()->with('success', "El rol {$role->name} ha sido creado con exito!");

        } catch (\Exception $e){
            Log::error('RoleController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit(Role $role)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('RoleController::index The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            return view('roles.edit', compact('role'));

        } catch (\Exception $e){
            Log::danger('RoleController::edit ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function update(RoleRequest $request, $id)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('RoleController::update The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $role = Role::where('id', $id)->update($request->except(['_token','_method']));

            return redirect()->back()->with('success', "El rol ha sido actualizado con exito!");

        } catch (\Exception $e){
            Log::error('RoleController::update ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function destroy($id)
    {
        //
    }
}
