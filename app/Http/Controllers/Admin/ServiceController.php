<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:600',
        ]);

        $service->update($data);

        return redirect()->route('admin.dashboard', ['panel' => 'services'])
            ->with('success', 'Service updated successfully.');
    }
}
