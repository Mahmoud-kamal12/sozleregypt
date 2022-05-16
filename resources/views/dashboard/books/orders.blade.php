@extends('dashboard.layout.app')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="updatePerson" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('admin.orders')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

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

            <h1>@lang('admin.orders')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.orders')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">@lang('admin.order') <small>{{ $orders->total() }}</small></h3>

                    <form action="{{ route('admin.orders') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('admin.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('admin.search')</button>
                            </div>

                        </div>
                    </form><!-- end of form -->



                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($orders->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.full_name')</th>
                                <th>@lang('admin.email')</th>
                                <th>@lang('admin.amount')</th>
                                <th>@lang('admin.paymob_order_id')</th>
                                <th>@lang('admin.paymob_order_status')</th>
                                <th>@lang('admin.paymob_transaction_id')</th>
                                <th>@lang('admin.phone')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($orders as $index => $product)
                                <tr  @if($product->read_at == null) style="background-color: red" @endif>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->full_name }}</td>
                                    <td>{{ $product->email}}</td>
                                    <td>{{ $product->amount}}</td>
                                    <td>{{ $product->paymob_order_id}}</td>
                                    <td>{{ $product->paymob_order_status}}</td>
                                    <td>{{ $product->paymob_transaction_id}}</td>
                                    <td>{{ $product->phone}}</td>
                                    <td>

                                        <button  onclick="show('{{ route('admin.show.order', $product->id) }}')" class="btn btn-info btn-sm show"><i class="fa fa-edit"></i> @lang('admin.show')</button>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $orders->appends(request()->query())->links() }}

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
