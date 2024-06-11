<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:tenants',
            'name' => 'required',
            'name_fantasy' => 'required',
            'email' => 'required|email',
            'ruc' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'timbrado' => 'required'
        ]);

        $tenant = new Tenant();
        $tenant->name = $request->name;
        $tenant->name_fantasy = $request->name_fantasy;
        $tenant->email = $request->email;
        $tenant->ruc = $request->ruc;
        $tenant->phone = $request->phone;
        $tenant->address = $request->address;
        $tenant->timbrado = $request->timbrado;
        $tenant->created_at = now();
        $tenant->save();

        // Obtener el dominio central desde la configuración
        $centralDomains = config('tenancy.central_domains');
        $centralDomain = is_array($centralDomains) ? $centralDomains[0] : $centralDomains;

        // Crear el dominio asociado al tenant
        $tenant->domains()->create([
            'domain' => $tenant->name_fantasy . '.' . $centralDomain,
        ]);

        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenant = Tenant::find($id);
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenant = Tenant::find($id);
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id' => 'required|unique:tenants,id,' . $id,
            'name' => 'required',
            'name_fantasy' => 'required',
            'email' => 'required|email',
            'ruc' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'timbrado' => 'required'
        ]);

        $tenant = Tenant::find($id);
        $tenant->name = $request->name;
        $tenant->name_fantasy = $request->name_fantasy;
        $tenant->email = $request->email;
        $tenant->ruc = $request->ruc;
        $tenant->phone = $request->phone;
        $tenant->address = $request->address;
        $tenant->timbrado = $request->timbrado;
        $tenant->updated_at = now();
        $tenant->save();

        // Actualizar el dominio asociado al tenant
        $centralDomains = config('tenancy.central_domains');
        $centralDomain = is_array($centralDomains) ? $centralDomains[0] : $centralDomains;

        $tenant->domains()->update([
            'domain' => $tenant->name_fantasy . '.' . $centralDomain,
        ]);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tenant = Tenant::findOrFail($id);
            $tenant->delete();
        } catch (\Exception $e) {
            // Manejo de excepciones si es necesario
        }
        return redirect()->route('tenants.index');
    }
}
