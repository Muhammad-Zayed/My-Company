<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::with('contactPeople')->get();
        return response()->json([
            'status'    => true,
            'companies' => $companies
        ] , 200);
    }


    public function store(CompanyRequest $request)
    {
        // Get Validated Data From Form Request => CompanyRequest
        $data = $request->safe()->except('logo');

        // Logo Upload
        if($request->hasFile('logo')){
            $data['logo'] = uploader($request , 'logo');
        }

        // Create Company //
        $company = Company::create($data);
        return response()->json([
            'status'    => true,
            'message'   =>'Created Successfully',
            'companies' => $company
        ] , 200);
    }


    public function update(CompanyRequest $request, Company $company)
    {
        // Get Validated Data From Form Request => CompanyRequest
        $data = $request->safe()->except('logo');

        // Logo Upload
        if($request->hasFile('logo')){
            $data['logo'] = uploader($request , 'logo');
        }

        // Update Company //
        $company->update($data);
        return response()->json([
            'status'    => true,
            'message'   =>'Updated Successfully',
            'companies' => $company
        ] , 200);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([
            'status'    => true,
            'message'   =>'Deleted Successfully',
        ] , 200);
    }
}
