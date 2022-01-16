<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{get_image(auth()->user()->image)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href=""><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>@lang('app.dashboard')</span></a></li>
            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-user"></i><span>@lang('app.users')</span></a></li>
            <li><a href="{{ route('dashboard.companies.index') }}"><i class="fa fa-building"></i><span>@lang('app.companies')</span></a></li>
            <li><a href="{{ route('dashboard.contact-people.index') }}"><i class="fa fa-building"></i><span>@lang('app.contact-people')</span></a></li>s
        </ul>

    </section>

</aside>

