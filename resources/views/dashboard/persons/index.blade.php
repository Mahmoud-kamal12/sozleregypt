@extends('dashboard.layout.app')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="addPerson" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.persons.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.add_person')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.person')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.person') }}">
                            </div>
                        @endforeach


                            <div class="form-group">
                                <label>@lang('admin.type')</label>
                                <select name="type" class="form-control">
                                    <option value="" disabled selected>@lang('admin.select')</option>
                                    @foreach(App\Character::getEnumValues() as $ky => $person)
                                        <option value="{{$person}}" {{ old('type') == $person ? 'selected' : '' }} >@lang('admin.'.$person)</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('admin.add')</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="modal fade" id="updatePerson" tabindex="-1" role="dialog" aria-labelledby="updatePersonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.edit_person')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('admin.edit')</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('admin.persons')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.persons')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">@lang('admin.persons') <small>{{ $persons->total() }}</small></h3>

                    <form action="{{ route('admin.persons.index') }}" method="get">

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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPerson">
                                    <i class="fa fa-plus"></i> @lang('admin.add')
                                </button>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($persons->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.'.app()->getLocale().'.person')</th>
                                <th>@lang('admin.type')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($persons as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>@lang('admin.'.$product->type)</td>
                                    <td>

                                            <button data-url="{{ route('admin.persons.edit', $product->id) }}" data-next="{{ route('admin.persons.update' , $product->id) }}" class="btn btn-info btn-sm edit"><i class="fa fa-edit"></i> @lang('admin.edit')</button>

                                            <form action="{{ route('admin.persons.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                            </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $persons->appends(request()->query())->links() }}

                    @else

                        <h2 class="text-center">@lang('admin.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection

@section('scripts')
    <script>


        function edit(){
            var href = $(this).data('next')
            $.ajax({
                type: "get",
                url: $(this).data('url'),
                success: function (res) {
                    var html = res.html
                    $('#updatePerson form').attr('action' , href)
                    $('#updatePerson .modal-body').html(html)
                    $("#updatePerson").modal('show');
                }
            });
        }

        $(document).on('click' ,'.edit' , edit )
    </script>
@endsection
