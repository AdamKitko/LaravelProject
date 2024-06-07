<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('welcome', ['cities'=>$cities]);
    }

    public function getCompany($city, $name)
    {
        $company = Company::where('name', $name)->where('city', $city)->with('services')->first();

        if ($company) {
            return view('company', [
                'company' => $company,
                'services' => $company->services,
                'companies' => Company::all()
            ]);
        } else {
            abort(404, 'Company not found');
        }
    }
}
