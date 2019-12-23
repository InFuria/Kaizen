<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::index The user ' . auth()->user()->name . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $products = Product::all();

            return view('products.index', compact('products'));

        } catch (\Exception $e){
            Log::error('ProductController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function create()
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::create The user ' . auth()->user()->name . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            return view('products.create');

        } catch (\Exception $e){
            Log::error('ProductController::create ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function store(ProductRequest $request)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::store The user ' . auth()->user()->name . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $product = Product::create($request->except(['_token','_method']));

            return redirect()->back()->with('success', "El producto {$request->name} ha sido creado con exito!");

        } catch (\Exception $e){
            Log::error('ProductController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function show(Product $product)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::show The user ' . $this->user . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('products.show', compact('product'));

        } catch (\Exception $e){
            Log::danger('ProductController::show ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function edit(Product $product)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::index The user ' . auth()->user()->name . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            return view('products.edit', compact('product'));

        } catch (\Exception $e){
            Log::danger('ProductController::edit ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function update(ProductRequest $request, $id)
    {
        try{
            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::update The user ' . auth()->user()->name . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $product = Product::where('id', $id)->update($request->except(['_token','_method']));

            return redirect()->back()->with('success', "El producto ha sido actualizado con exito!");

        } catch (\Exception $e){
            Log::error('ProductController::update ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function destroy(Product $product)
    {
        try{

            if (! auth()->user()->isRole('superuser')){
                Log::warning('ProductController::destroy The user ' . auth()->user()->name . ' no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }

            $product->delete();

            return redirect()->back()->with('success', "El producto ha sido eliminado con exito!");

        } catch (\Exception $e){
            Log::error('ProductController::destroy ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }
}
