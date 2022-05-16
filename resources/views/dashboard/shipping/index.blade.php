@extends('dashboard.layout.app')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="addEdition" tabindex="-1" role="dialog" aria-labelledby="addEditionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.shipping.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.add_city')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.city')</label>
                                <input type="text" name="{{ $locale }}[city]" class="form-control" value="{{ old($locale . '.city') }}">
                            </div>
                        @endforeach

                            <div class="form-group">
                                <label>@lang('admin.cost')</label>
                                <input type="number" step="0.01" name="cost" class="form-control" value="{{ old('cost') }}">
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

    <div class="modal fade" id="updateEdition" tabindex="-1" role="dialog" aria-labelledby="updateEditionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.edit_edtion')</h5>
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

            <h1>@lang('admin.shipping')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.shipping')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">@lang('admin.shipping') <small>{{ $shipping->total() }}</small></h3>

                    <form action="{{ route('admin.shipping.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('admin.search')" value="{{ request()->search }}">
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('admin.search')</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEdition">
                                    <i class="fa fa-plus"></i> @lang('admin.add')
                                </button>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($shipping->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.'.app()->getLocale().'.city')</th>
                                <th>@lang('admin.cost')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($shipping as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->city }}</td>
                                    <td>{{ $product->cost }}</td>
                                    <td>

                                            <button data-url="{{ route('admin.shipping.edit', $product->id) }}" data-next="{{ route('admin.shipping.update' , $product->id) }}" class="btn btn-info btn-sm edit"><i class="fa fa-edit"></i> @lang('admin.edit')</button>

                                            <form action="{{ route('admin.shipping.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                            </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $shipping->appends(request()->query())->links() }}

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
                    $('#updateEdition form').attr('action' , href)
                    $('#updateEdition .modal-body').html(html)
                    $("#updateEdition").modal('show');
                }
            });
        }

        $(document).on('click' ,'.edit' , edit )
    </script>
@endsection
