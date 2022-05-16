@extends('web.layouts.app')

@section('content')

    <section class=" imgBox  position-relative">
        <div class=" position-absolute"></div>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (1).png') }}" alt="First slide">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (2).png') }}" alt="Second slide">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (3).png') }}" alt="Third slide">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (4).png') }}" alt="Third slide">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (5).png') }}" alt="Third slide">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (6).png') }}" alt="Third slide">
                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('web/images/bacs/book (7).png') }}" alt="Third slide">
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <!-- <span class="sr-only">Previous</span> -->
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </section>

    <section class="  books-carsouls  mt-5 ">
        <div class="container mt-5">


            <div class="text-center">
                <h1 class="mainTxt">@lang('web.Our_new_releases')</h1>
            </div>

            <div class="row m-auto p-2">
                <div  class="  w-100 owl-carousel owl-theme HowCarsoul mt-5">

                    @if(count(App\Book::all()) > 0)
                        @foreach(App\Book::limit(3)->get()->random()->get() as $book)
                            <div  class="owl-item p-3" >
                                <div class="item">
                                    <div class="h-100  p-3 shadow">
                                        <p class=" nameBook">{{$book->name}}</p>
                                        <img class="card-img-top h-75" src="{{$book->image_path[0]}}" alt="Card image cap">
                                        <div class="text-center">
                                            <p>@lang('web.price_lg')<span> {{$book->price_le_after_discount}} ج.م</span></p>
                                            <p>@lang('web.price_usd')<span> {{$book->price_usd_after_discount}} $</span></p>

                                            <a data-add-url = "{{route('web.addcart',$book->id)}}" data-toggle="modal" data-target="#loginModal" class="btn btn-danger bg-transparent text-primary w-50 btn-cart">@lang('web.buy_now')</a>

                                            <button @if($book->is_fav) style="color: red!important;" @endif data-delete-url = "{{route('web.deletefavorite' , $book->id)}}" data-add-url = "{{route('web.addfavorite',$book->id)}}" data-favorite="{{$book->is_fav}}" class="btn text-muted btn-danger bg-transparent text-danger w-20 btn-favorite"> <i  class="fa fa-heart"></i> </button>

                                            <a class="btn btn-danger bg-transparent text-primary" href="{{route('web.getBook' , $book->slug)}}">@lang('web.details')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>

            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


            <div class="text-center ">
                <h1 class="mainTxt mt-3">@lang('web.best_seller')</h1>
            </div>

            <div class="row m-auto p-2">
                <div  class="  w-100 owl-carousel owl-theme HowCarsoul mt-5">

                    @if(count(App\Book::all()) > 0)
                        @foreach(App\Book::limit(3)->get()->random()->get() as $book)
                            <div  class="owl-item p-3" >
                                <div class="item">
                                    <div class="h-100  p-3 shadow">
                                        <p class=" nameBook">{{$book->name}}</p>
                                        <img class="card-img-top h-75" src="{{$book->image_path[0]}}" alt="Card image cap">
                                        <div class="text-center">
                                            <p>@lang('web.price_lg')<span> {{$book->price_le_after_discount}} ج.م</span></p>
                                            <p>@lang('web.price_usd')<span> {{$book->price_usd_after_discount}} $</span></p>

                                            <a data-add-url = "{{route('web.addcart',$book->id)}}" data-toggle="modal" data-target="#loginModal" class="btn btn-danger bg-transparent text-primary w-50 btn-cart">@lang('web.buy_now')</a>

                                            <button @if($book->is_fav) style="color: red!important;" @endif data-delete-url = "{{route('web.deletefavorite' , $book->id)}}" data-add-url = "{{route('web.addfavorite',$book->id)}}" data-favorite="{{$book->is_fav}}" class="btn text-muted btn-danger bg-transparent text-danger w-20 btn-favorite"> <i  class="fa fa-heart"></i> </button>

                                            <a class="btn btn-danger bg-transparent text-primary" href="{{route('web.getBook' , $book->slug)}}">@lang('web.details')</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>

            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





        </div>
    </section>

@endsection
