@extends('dashboard.layout.app')

@section('content')



    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('admin.books')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.books')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">@lang('admin.books') <small>{{ $books->total() }}</small></h3>

                    <form action="{{ route('admin.books.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('admin.search')" value="{{ request()->search }}">
                            </div>

{{--                            <div class="col-md-4">--}}
{{--                                <select name="category_id" class="form-control">--}}
{{--                                    <option value="">@lang('admin.all_categories')</option>--}}
{{--                                    @foreach ($categories as $category)--}}
{{--                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('admin.search')</button>
                                <a href="{{ route('admin.books.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add')</a>                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($books->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.'.app()->getLocale().'.name')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($books as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>

{{--                                    <td>--}}
{{--                                        @if (auth()->user()->hasPermission('products_update'))--}}
{{--                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('admin.edit')</a>--}}
{{--                                        @else--}}
{{--                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('admin.edit')</a>--}}
{{--                                        @endif--}}
{{--                                        @if (auth()->user()->hasPermission('products_delete'))--}}
{{--                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display: inline-block">--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                {{ method_field('delete') }}--}}
{{--                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('admin.delete')</button>--}}
{{--                                            </form><!-- end of form -->--}}
{{--                                        @else--}}
{{--                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('admin.delete')</button>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                <td>


                                    <form action="{{ route('admin.books.destroy', $product->id) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                    </form><!-- end of form -->

                                    <form action="{{ route('admin.books.edit', $product->id) }}" method="GET" style="display: inline-block">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-info btn-sm edit"><i class="fa fa-trash"></i> @lang('admin.edit')</button>
                                    </form><!-- end of form -->

                                </td>

                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $books->appends(request()->query())->links() }}

                    @else

                        <h2 class="text-center">@lang('admin.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
