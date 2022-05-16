@extends('web.layouts.app')

@section('content')

    <section class="allbooks">
        <div class="container">
            <div class="row">

                    <div class="col-lg-10 m-auto  row p-3 mt-3">

                        <div class="col-lg-6 col-md-6 col-sm-12 ">
                            <img class="img-fluid float-right book" width="300" height="400" src="{{ $book->image_path[0] }}" alt="">
                        </div>
                        <!-- ////////////////////////////////////////////////////// -->
                        <!-- ////////////////////////////////////////////////////// -->
                        <div class="col-lg-6 col-md-6 col-sm-12 Book-data">

                            <h4>{{ $book->name}}</h4>
                            <p>@lang('web.author'): <a href="#">{{$book->author_name}}</a></p>
                            <p>@lang('web.translator'): <a href="#">{{$book->translator_name}}</a></p>
                            <p>@lang('web.investigation'): <a href="#">{{$book->investigator_name}}</a></p>
                            <p>@lang('web.classification'): <a href="#">{{$book->classification}}</a></p>
                            <p>@lang('web.paper_type'): <a href="#">{{$book->paper_type}}</a></p>
                            <p>@lang('web.printing_colors'): <a href="#">{{$book->printing_colors}}</a></p>
                            <p>@lang('web.number_pages'): <a href="#">{{$book->number_pages}}</a></p>
                            <p>@lang('web.year_release'): <a href="#">{{$book->year_release}}</a></p>
                            <p>@lang('web.edition'): <a href="#"></a>{{$book->edition}}</p>
                            <p>@lang('web.size'): <a href="#">{{$book->size}}</a></p>
                            <p>@lang('web.weight'): <a href="#">{{$book->weight}}</a></p>
                            <p>@lang('web.ISBN'): <a href="#">{{$book->ISBN}}</a></p>
                            <p>@lang('web.code'): <a href="#">{{$book->code}}</a></p>
                            <p>@lang('web.price_lg'): <a href="#">{{$book->price_le_after_discount}}</a></p>
                            <p>@lang('web.price_usd'): <a href="#">{{$book->price_usd_after_discount}}</a></p>
                            <p>@lang('web.about'): <a href="#">{{$book->about}}</a></p>

                            @if(isset($book->publisher_name))
                                <p>@lang('web.publisher'): <a href="#"></a>{{$book->publisher_name}}</p>
                            @endif

                            <a data-add-url = "{{route('web.addcart',$book->id)}}" data-toggle="modal" data-target="#loginModal" class="btn btn-danger bg-transparent text-primary w-50 btn-cart">@lang('web.buy_now')</a>

                            <button @if($book->is_fav) style="color: red!important;" @endif data-delete-url = "{{route('web.deletefavorite' , $book->id)}}" data-add-url = "{{route('web.addfavorite',$book->id)}}" data-favorite="{{$book->is_fav}}" class="btn text-muted btn-danger bg-transparent text-danger w-20 btn-favorite"> <i  class="fa fa-heart"></i> </button>

                        </div>



                    </div>

            </div>
        </div>
    </section>

@endsection
