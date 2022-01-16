<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ContactPerson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactPersonController extends Controller
{

    public function index()
    {
        $companies = Company::all();
        $contactPeople = ContactPerson::Search()->Filter()->with('company')->latest()->paginate(10);
        return view('dashboard.contactPeople.index',compact('contactPeople' , 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('dashboard.contactPeople.create' , compact('companies'));
    }


    public function store(Request $request)
    {
        // Validation  //
        $data = $request->validate([
            'first_name'      => ['required' , 'max:191' , 'string'],
            'last_name'      => ['required' , 'max:191' , 'string'],
            'email'     => ['required' , 'email' , 'unique:contact-people'],
            'phone'     => ['required' , 'regex:/^([0-9\s\-\+\(\)]*)$/' , 'unique:contact-people'],
            'linkedin'     => ['nullable' , 'url'],
            'company_id'    => ['required' ,'exists:companies,id']
        ]);
        // Create Person //
        ContactPerson::create($data);


        session()->flash('success' , __('app.added_successfully'));
        return redirect()->route('dashboard.contact-people.index');
    }


    public function edit(ContactPerson $contact_person)
    {
        $companies = Company::all();
        $contact_person->load(['company']);
        return view('dashboard.contactPeople.edit' , compact('companies' , 'contact_person'));
    }


    public function update(Request $request, ContactPerson $contact_person)
    {
        // Validation  //
        $data = $request->validate([
            'first_name'      => ['required' , 'max:191' , 'string'],
            'last_name'      => ['required' , 'max:191' , 'string'],
            'email'     => ['required' , 'email' , Rule::unique('contact-people')->ignore($contact_person->id)],
            'phone'     => ['required' , 'regex:/^([0-9\s\-\+\(\)]*)$/' , Rule::unique('contact-people')->ignore($contact_person->id)],
            'linkedin'     => ['nullable' , 'url'],
            'company_id'    => ['required' ,'exists:companies,id']
        ]);

        // Update Person //
        $contact_person->update($data);

        session()->flash('success' , __('app.updated_successfully'));
        return redirect()->route('dashboard.contact-people.index');
    }

    public function destroy(ContactPerson $contact_person)
    {
        $contact_person->delete();
        session()->flash('success' , __('app.deleted_successfully'));
        return redirect()->route('dashboard.contact-people.index');
    }
}
