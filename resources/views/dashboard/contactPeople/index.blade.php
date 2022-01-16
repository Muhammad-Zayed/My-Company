@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('app.contact-people')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">@lang('app.dashboard')</i></a></li>
                <li class="active"><i >@lang('app.contact-people')</i></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('app.contact-people') <small>({{ $contactPeople->total() }})</small></h3>

                    <form action="{{ route('dashboard.contact-people.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('app.search')">
                            </div>


                            <div class="col-md-4">
                                <select name="company_id" style="padding: 0px" class="form-control">
                                    <option value="">@lang('app.companies')</option>
                                    @foreach($companies as $company)
                                        <option {{request()->company_id == $company->id ? 'selected' : ''}} value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>@lang('app.search')</button>

                                <a class="btn btn-primary btn-sm" href="{{ route('dashboard.contact-people.create') }}"><i class="fa fa-plus"></i> @lang('app.add')</a>
                            </div>

                        </div>

                    </form>

                </div>


                <div class="box-body">
                    @if($contactPeople->count())

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('app.first_name')</th>
                                <th>@lang('app.last_name')</th>
                                <th>@lang('app.email')</th>
                                <th>@lang('app.phone')</th>
                                <th>@lang('app.linkedin')</th>
                                <th>@lang('app.company')</th>
                                <th>@lang('app.action')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($contactPeople as $contactPerson)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contactPerson->first_name }}</td>
                                    <td>{{ $contactPerson->last_name }}</td>
                                    <td>{{ $contactPerson->email }}</td>
                                    <td>{{ $contactPerson->phone}}</td>
                                    <td>{{ $contactPerson->linkedin}}</td>
                                    <td>{{ $contactPerson->company->name}}</td>

                                    <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('dashboard.contact-people.edit' , $contactPerson->id) }}"><i class="fa fa-edit"></i>@lang('app.edit')</a>

                                            <form style="display: inline-block" method="POST" action="{{ route('dashboard.contact-people.destroy', $contactPerson->id) }}">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>@lang('app.delete')</button>
                                            </form>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $contactPeople->appends(request()->query())->links() }}
                    @else
                        <h2>@lang('app.no_data')</h2>
                    @endif

                </div>
            </div>
        </section>
    </div>
@endsection
