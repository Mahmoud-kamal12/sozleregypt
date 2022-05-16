@extends('dashboard.layout.app')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="updatePerson" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.message')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>@lang('admin.name')</label>
                            <input type="text" value="">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.email')</label>
                            <input type="text" value="">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.email')</label>
                            <textarea name="" id="" cols="30" rows="10"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('admin.add')</button>
                    </div>
                </div>

        </div>
    </div>

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('admin.sandbox')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.sandbox')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">@lang('admin.sandbox') <small>{{ $sandboxes->total() }}</small></h3>



                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($sandboxes->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.name')</th>
                                <th>@lang('admin.email')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($sandboxes as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{$product->email}}</td>
                                    <td>

                                        <button onclick="show('{{ route('admin.show.sandbox', $product->id) }}')"  class="btn btn-info btn-sm show"><i class="fa fa-edit"></i> @lang('admin.show')</button>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $sandboxes->appends(request()->query())->links() }}

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


        function show(url){
            $.ajax({
                type: "get",
                url: url,
                success: function (res) {
                    var html = res.html
                    $('#updatePerson .modal-body').html(html)
                    $("#updatePerson").modal('show');
                }
            });
        }

        $(document).on('click' ,'.show' , show )
    </script>
@endsection
