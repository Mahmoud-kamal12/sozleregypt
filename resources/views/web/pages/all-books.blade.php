@extends('web.layouts.app')

@section('content')

    <section class="allbooks">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 text-center  mt-3">

                    <h4 class="data-Text "> @lang('web.name') </h4>

                    <form method = "get" action="">
                        <div class="form-group">
                            <input name="word" type="search" class="form-control "  placeholder="الاسم">
                            <select name="character" class="form-control mt-3 border border-1">
                                <option value="">@lang('web.nothing')</option>
                                <option value="Author">@lang('web.author')</option>
                                <option value="Translator">@lang('web.translator')</option>
                                <option value="Investigator">@lang('web.investigation')</option>
                            </select>
                            <p class="mt-3">@lang('web.price_lg')</p>
                            <div class="form-row ">
                                <div class="col-lg-6 col-sm-6">
                                    <span>@lang('web.from')</span> <input name="from"class="form-control mt-3 col-lg-12  " type="number">
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <span>@lang('web.to')</span> <input name="to" class="form-control mt-3 col-lg-12  " type="number">
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-50 m-auto">@lang('web.search')</button>
                    </form>

                </div>

                <div class="col-lg-9  row p-3 mt-3">
                    @if(count($books))
                        @foreach($books as $book)


                                <div class="col-lg-5 col-md-6 col-sm-12  ">
                                    <img class="img-fluid float-right book p-3"  src="{{$book->image_path[0]}}" alt="">
                                </div>
                                <div class="col-lg-7 col-md-6 col-sm-12 p-3 Book-data">
                                    <h4><a href="{{route('web.getBook' , $book->slug)}}">{{$book->name}}</a></h4>
                                    <p>@lang('web.author'): <a href="#">{{$book->author_name}}</a></p>
                                    <p>@lang('web.translator'): <a href="#">{{$book->translator_name}}</a></p>
                                    <p>@lang('web.investigation'): <a href="#">{{$book->investigator_name}}</a></p>
                                    <p>@lang('web.classification'): <a href="#">{{$book->classification}}</a></p>
                                    <p>@lang('web.paper_type'): <a href="#">{{$book->paper_type}}</a></p>
                                    <p>@lang('web.price_lg'): <a href="#">{{$book->price_le_after_discount}}</a></p>
                                    <p>@lang('web.price_usd'): <a href="#">{{$book->price_usd_after_discount}}</a></p>
                                    <p>@lang('web.ISBN'): <a href="#">{{$book->ISBN}}</a></p>


                                    <a data-add-url = "{{route('web.addcart',$book->id)}}" data-toggle="modal" data-target="#loginModal" class="btn btn-danger bg-transparent text-primary w-50 btn-cart">@lang('web.buy_now')</a>

                                    <button @if($book->is_fav) style="color: red!important;" @endif data-delete-url = "{{route('web.deletefavorite' , $book->id)}}" data-add-url = "{{route('web.addfavorite',$book->id)}}" data-favorite="{{$book->is_fav}}" class="btn text-muted btn-danger bg-transparent text-danger w-20 btn-favorite"> <i  class="fa fa-heart"></i> </button>

                                    <a class="btn btn-danger bg-transparent text-primary" href="{{route('web.getBook' , $book->slug)}}">@lang('web.details')</a>
                                </div>

                        @endforeach
                    @else
                        <h1 class = "h1" style="margin: 0 auto">@lang('web.no_books')</h1>
                    @endif

                </div>

            </div>
            <div class="position-relative">
                <div class ="row  d-flex   text-center">
                    <div class = 'col-sm-6 m-auto  text-center'>
                        {{ $books->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
