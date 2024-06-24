<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Company;

class CompanyController extends Controller
{
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function create()
    {
        return view('company-form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'url'],
        ]);

        $company = new Company();
        $company->user_id = Auth::id();
        $company->name = $request->name;
        $company->city = $request->city;
        $company->address = $request->address;
        $company->description = $request->description;
        $company->active = 1;

        if ($request->image) {
            $company->image = $request->image;
        }

        $company->save();

        return redirect()->route('welcome');
    }


    public function delete($id)
    {
        $company = Company::find($id);
        $company->delete();

        return redirect()->route('welcome');
    }

    public function getCompaniesByCity($city)
    {
        $companies = Company::where('city', $city)->get();
        $cities = DB::table('companies')
            ->select('city')
            ->distinct()
            ->get();
        return view('city-companies', ['companies' => $companies, 'city' => $city, 'cities' => $cities]);
    }

    public function getCities()
    {
        $cities = DB::table('companies')
            ->select('city')
            ->distinct()
            ->get();
        return view('welcome', ['cities' => $cities]);
    }

    public function getCompany($city, $name)
    {
        $company = Company::where('name', $name)->where('city', $city)->with('services')->first();

        if ($company) {
            return view('company', [
                'company' => $company,
                'services' => $company->services,
                'companies' => Company::all(),
                'loggedInUserId' => auth()->check() ? auth()->user()->id : null
            ]);
        } else {
            abort(404, 'Company not found');
        }
    }
}
