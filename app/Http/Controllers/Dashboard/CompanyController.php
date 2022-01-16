<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // Search => Local Scope
        $companies = Company::Search()->latest()->Paginate(10);
        return view('dashboard.companies.index',compact('companies'));
    }


    public function create()
    {
        return view('dashboard.companies.create');
    }

    public function store(Request $request)
    {
        // Validation //
        $data = $request->validate([
            'name'      => ['required' , 'max:191' , 'string'],
            'email'     => ['required' , 'email' , 'unique:companies'],
            'website_url'  => ['required' , 'url'],
            'logo'     => ['nullable' , 'mimes:jpg,png,jpeg' , 'dimensions:min_width=100,min_height=100']
        ]);
        // Image Upload //
        if($request->hasFile('logo')){
            $data['logo'] = uploader($request , 'logo');
        }

        // Create Company //
        Company::create($data);

        session()->flash('success' , __('app.added_successfully'));
        return redirect()->route('dashboard.companies.index');
    }

    public function edit(Company $company)
    {
        return view('dashboard.companies.edit' , compact('company'));
    }


    public function update(Request $request, Company $company)
    {
        // Validation  //
        $data = $request->validate([
            'name'      => ['required' , 'max:191' , 'string'],
            'email'     => ['required' , 'email' , Rule::unique('companies')->ignore($company->id)],
            'website_url'  => ['required' , 'url'],
            'logo'     => ['nullable' , 'mimes:jpg,png,jpeg' , 'dimensions:min_width=100,min_height=100']
        ]);

        // Image Upload //
        if($request->hasFile('logo')){
            $data['logo'] = uploader($request , 'logo');
        }

        // Create Company //
        $company->update($data);

        session()->flash('success' , __('app.updated_successfully'));
        return redirect()->route('dashboard.companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        session()->flash('success' , __('app.deleted_successfully'));
        return redirect()->route('dashboard.companies.index');
    }
}
