<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:600',
            'color'       => 'nullable|string|max:20',
            'icon'        => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['color']      = $data['color']      ?? '#3B82F6';
        $data['icon']       = $data['icon']        ?? 'heart';
        $data['sort_order'] = $data['sort_order']  ?? Service::max('sort_order') + 1;

        Service::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'services'])
            ->with('success', 'Service added successfully.');
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:600',
            'color'       => 'nullable|string|max:20',
            'icon'        => 'nullable|string|max:50',
        ]);

        $service->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'services'])
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'services'])
            ->with('success', 'Service deleted.');
    }
}
