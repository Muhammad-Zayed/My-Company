@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('app.users')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">@lang('app.dashboard')</i></a></li>
                <li class="active"><i >@lang('app.users')</i></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('app.users') <small>({{ $users->total() }})</small></h3>

                    <form action="{{ route('dashboard.users.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('app.search')">
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>@lang('app.search')</button>
                                <a class="btn btn-primary btn-sm" href="{{ route('dashboard.users.create') }}"><i class="fa fa-plus"></i> @lang('app.add')</a>
                        </div>

                    </form>

                </div>

                <!-- Start Users Table-->
                <div class="box-body">
                    @if($users->count())

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('app.image')</th>
                                <th>@lang('app.name')</th>
                                <th>@lang('app.email')</th>
                                <th>@lang('app.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img style="width:50px; height:50px;" class=" img-thumbnail img-rounded" src="{{get_image($user->image)}}" ></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('dashboard.users.edit' , $user->id) }}"><i class="fa fa-edit"></i>@lang('app.edit')</a>
                                            <form style="display: inline-block" method="POST" action="{{ route('dashboard.users.destroy', $user->id) }}">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>@lang('app.delete')</button>
                                            </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->appends(request()->query())->links() }}
                    @else
                        <h2>@lang('app.no_data')</h2>
                    @endif

                </div>
            </div>
        </section>
    </div>
@endsection
