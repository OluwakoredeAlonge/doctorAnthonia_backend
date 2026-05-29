<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:600',
            'icon'        => 'nullable|string|max:50',
            'color'       => 'nullable|string|max:20',
            'website_url' => 'nullable|string|max:500',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['icon']       = $data['icon']       ?? 'building-2';
        $data['color']      = $data['color']       ?? '#C9922A';
        $data['sort_order'] = $data['sort_order']  ?? Organization::max('sort_order') + 1;

        Organization::create($data);

        return redirect()->route('admin.dashboard', ['panel' => 'organizations'])
            ->with('success', 'Organization added successfully.');
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:600',
            'icon'        => 'nullable|string|max:50',
            'color'       => 'nullable|string|max:20',
            'website_url' => 'nullable|string|max:500',
        ]);

        $organization->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'organizations'])
            ->with('success', 'Organization updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return redirect()->route('admin.dashboard', ['panel' => 'organizations'])
            ->with('success', 'Organization deleted.');
    }
}
