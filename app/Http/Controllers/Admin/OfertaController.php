<?php

namespace App\Http\Controllers\Admin;

use App\Models\Oferta;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Oferta\StoreOfertaRequest;
use App\Http\Requests\Admin\Oferta\UpdateOfertaRequest;

class OfertaController extends Controller
{
    public function index()
    {
        $ofertas = Oferta::with('producto')->latest()->paginate(10);

        return view('admin.ofertas.index', [
            'ofertas' => $ofertas,
            'title' => 'Ofertas',
            'header' => 'Ofertas',
            'subheader' => 'Gestioná descuentos y promociones',
        ]);
    }

    public function create()
    {
        return view('admin.ofertas.create', [
            'productos' => Producto::orderBy('nombre')->get(),
            'title' => 'Nueva oferta',
            'header' => 'Nueva oferta',
            'subheader' => 'Creá una nueva promoción',
        ]);
    }

    public function store(StoreOfertaRequest $request)
    {
        Oferta::create([
            'producto_id' => $request->producto_id,
            'tipo' => $request->tipo,
            'valor' => $request->valor,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->boolean('activa'),
        ]);

        return redirect()
            ->route('admin.ofertas.index')
            ->with('success', 'Oferta creada correctamente.');
    }

    public function edit(Oferta $oferta)
    {
        return view('admin.ofertas.edit', [
            'oferta' => $oferta,
            'productos' => Producto::orderBy('nombre')->get(),
            'title' => 'Editar oferta',
            'header' => 'Editar oferta',
            'subheader' => 'Actualizá la promoción',
        ]);
    }

    public function update(UpdateOfertaRequest $request, Oferta $oferta)
    {
        $oferta->update([
            'producto_id' => $request->producto_id,
            'tipo' => $request->tipo,
            'valor' => $request->valor,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->boolean('activa'),
        ]);

        return redirect()
            ->route('admin.ofertas.index')
            ->with('success', 'Oferta actualizada correctamente.');
    }

    public function destroy(Oferta $oferta)
    {
        $oferta->delete();

        return redirect()
            ->route('admin.ofertas.index')
            ->with('success', 'Oferta eliminada correctamente.');
    }
    public function __construct()
    {
        $this->middleware('permission:ofertas.ver')->only('index');
        $this->middleware('permission:ofertas.crear')->only(['create', 'store']);
        $this->middleware('permission:ofertas.editar')->only(['edit', 'update']);
        $this->middleware('permission:ofertas.eliminar')->only('destroy');
    }

    
}