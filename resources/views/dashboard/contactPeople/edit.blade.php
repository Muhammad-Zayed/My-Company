@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('app.contact-people')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">@lang('app.dashboard')</i></a></li>
                <li><a href="{{ route('dashboard.contact-people.index') }}">@lang('app.contact-people')</a></li>
                <li class="active">@lang('app.add')</li>

            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('app.add')</h3>
                </div>

                <form method="POST" action="{{ route('dashboard.contact-people.update' , $contact_person->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="box-body">

                        <div class="form-group">

                            <label>@lang('app.company')</label>
                            <select style="padding:0px" name = "company_id" class="form-control">
                                <option value="">@lang('app.companies')</option>

                                @foreach($companies as $company)
                                    <option {{$contact_person->company->id==$company->id ? 'selected' : ''}} value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label >@lang('app.first_name')</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $contact_person->first_name}}">
                        </div>

                        <div class="form-group">
                            <label >@lang('app.last_name')</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $contact_person->last_name}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('app.email')</label>
                            <input  type="text" name="email" class="form-control" value="{{ $contact_person->email }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('app.phone')</label>
                            <input  type="text" name="phone" class="form-control" value="{{ $contact_person->phone }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('app.linkedin')</label>
                            <input  type="text" name="linkedin" class="form-control" value="{{ $contact_person->linkedin }}">
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('app.add')</button>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection
