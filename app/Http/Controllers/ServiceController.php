<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServiceController extends Controller
{
    public function getServices()
    {
        $services = Service::all();
        return view('company', ['services' => $services]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'length' => 'required|integer',
            'company_id' => 'required|exists:companies,id',
        ]);

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'length' => $request->length,
            'company_id' => $request->company_id,
        ]);

        $company = Company::find($request->company_id);
        return redirect()->route('company', [
            'city' => $company->city,
            'name' => $company->name,
            'id' => $company->id,
        ]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $services = Service::all();
        $company = $service->company;
        $loggedInUserId = auth()->check() ? auth()->user()->id : null;

        if (auth()->id() !== $company->user_id) {
            return redirect()->route('company.show', ['city' => $company->city, 'name' => $company->name, 'id' => $company->id])
                ->with('error', 'You are not authorized to edit this service.');
        }

        return view('company', compact('service', 'company', 'services', 'loggedInUserId'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'length' => 'required|integer',
        ]);

        $service = Service::findOrFail($id);
        $company = $service->company;

        // Ensure the authenticated user is the owner of the company
        if (auth()->id() !== $company->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'length' => $request->length,
        ]);

        return response()->json(['success' => 'Service updated successfully.']);
    }


}
