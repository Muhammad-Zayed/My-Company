@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('app.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('app.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">
{{--                <div class="col-lg-3 col-xs-6">--}}
{{--                    <div class="small-box bg-aqua">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>{{ $categories_count }}</h3>--}}

{{--                            <p>@lang('site.categories')</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-bag"></i>--}}
{{--                        </div>--}}
{{--                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

        </section>

    </div>


@endsection

@push('scripts')
@endpush
