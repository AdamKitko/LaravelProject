<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255']
        ]);
        Company::create($request->all());

        return to_route('welcome');
    }

    public function delete($id)
    {
        $company = Company::find($id);
        $company->delete();

        return to_route('welcome');
    }

    public function getCities()
    {
        $cities = Company::select('city')->get();
        return view('welcome', compact('cities'));
    }
}
