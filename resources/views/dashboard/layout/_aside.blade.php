<aside class="main-sidebar" style="position: fixed !important;">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/admin.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href=""><i class="fa fa-th"></i><span>@lang('admin.dashboard')</span></a></li>

            <li><a href="{{route('admin.books.index')}}"><i class="fa fa-book"></i><span>@lang('admin.books')</span></a></li>

            <li><a href="{{route('admin.editions.index')}}"><i class="fa fa-th"></i><span>@lang('admin.editions')</span></a></li>

{{--            <li><a href="{{route('admin.topics.index')}}"><i class="fa fa-th"></i><span>@lang('admin.topics')</span></a></li>--}}

            <li><a href="{{route('admin.classifications.index')}}"><i class="fa fa-th"></i><span>@lang('admin.classifications')</span></a></li>

            <li><a href="{{route('admin.persons.index')}}"><i class="fa fa-th"></i><span>@lang('admin.persons')</span></a></li>

            <li><a href="{{route('admin.sandbox')}}"><i class="fa fa-th"></i><span>@lang('admin.sandbox')</span></a></li>
            <li><a href="{{route('admin.orders')}}"><i class="fa fa-th"></i><span>@lang('admin.orders')</span></a></li>
            <li><a href="{{route('admin.shipping.index')}}"><i class="fa fa-th"></i><span>@lang('admin.shipping')</span></a></li>
        </ul>

    </section>

</aside>

