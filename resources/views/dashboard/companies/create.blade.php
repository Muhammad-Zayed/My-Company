@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('app.users')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">@lang('app.dashboard')</i></a></li>
                <li><a href="{{ route('dashboard.companies.index') }}">@lang('app.companies')</a></li>
                <li class="active">@lang('app.add')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('app.add')</h3>
                </div>
                <form method="POST" action="{{ route('dashboard.companies.store') }}"  role="form" enctype="multipart/form-data" >
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>@lang('app.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ old('first_name') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('app.email')</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('app.website_url')</label>
                            <input type="text" name="website_url" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>@lang('app.logo')</label>
                            <input type="file" name="logo" class="form-control image-preview">
                        </div>

                        <div class="form-group">
                            <img style="width:100px; height:100px;" class=" img-thumbnail img-rounded image-preview-box" src="/storage/no_image.png" >
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
