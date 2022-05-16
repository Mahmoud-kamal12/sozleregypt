@extends('dashboard.layout.app')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="addtopic" tabindex="-1" role="dialog" aria-labelledby="addtopicModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.topics.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.add_topic')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.topic')</label>
                                <input type="text" name="{{ $locale }}[topic]" class="form-control" value="{{ old($locale . '.topic') }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('admin.add')</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="modal fade" id="updatetopic" tabindex="-1" role="dialog" aria-labelledby="updatetopicModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.edit_topic')</h5>
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

            <h1>@lang('admin.topics')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.topics')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">@lang('admin.topics') <small>{{ $topics->total() }}</small></h3>

                    <form action="{{ route('admin.topics.index') }}" method="get">

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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtopic">
                                    <i class="fa fa-plus"></i> @lang('admin.add')
                                </button>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($topics->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.'.app()->getLocale().'.topic')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($topics as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->topic }}</td>
                                    <td>

                                            <button data-url="{{ route('admin.topics.edit', $product->id) }}" data-next="{{ route('admin.topics.update' , $product->id) }}" class="btn btn-info btn-sm edit"><i class="fa fa-edit"></i> @lang('admin.edit')</button>

                                            <form action="{{ route('admin.topics.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                            </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $topics->appends(request()->query())->links() }}

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
                    $('#updatetopic form').attr('action' , href)
                    $('#updatetopic .modal-body').html(html)
                    $("#updatetopic").modal('show');
                }
            });
        }

        $(document).on('click' ,'.edit' , edit )
    </script>
@endsection
