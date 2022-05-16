<section class="headerSection">


    <div class=" bg-dark text-light  col-lg-12">
        <div class="container">
            <div class="row">

                <div class="dropdown">
                    <button class="dropbtn">{{app()->getLocale()}}</button>
                    <div class="dropdown-content">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="p-0">
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </div>
                </div>
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                @if(auth()->user() || auth('admin')->user())

                    <span class=" co-lg-3 text-left pr-3"> <i class="fa-solid fa-right-from-bracket"></i> <a href="{{ route('admin.logout') }}" class="text-light" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">@lang('admin.logout')</a></span>
                    <form id="logout-form" action="@if(auth('admin')->user()){{ route('admin.logout') }}@elseif(auth('web')->user()){{ route('web.logout')}}@endif" method="POST" style="display: none;">
                        @csrf
                    </form>


                @else

                    <span class=" co-lg-3 text-left pr-3"> <i class="fa fa-lock"></i> <a data-toggle="modal" data-target="#loginModal" class="text-light" href="#"> @lang('web.login') </a></span>
                    <!-- Modal -->
                    <div  class="modal fade " id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('web.login_2')</h5>
                                    <button type="button" class="close position-absolute" style="right: 95%;" data-dismiss="modal" aria-label="Close">
                                        <span class=" " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route('web.login')}}" method = "POST">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('web.email')</label>
                                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('web.password')</label>
                                            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                                        </div>

                                        <div class="form-check ">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label mr-3" for="exampleCheck1">@lang('web.remember')؟</label>
                                        </div>

                                        <a href="" id="showForgetModal">@lang('web.forget_pass')</a>

                                        <button type="submit" class="btn btn-danger w-100">@lang('web.login')</button>


                                    </form>

                                    <div class="text-center mt-3">
                                        <h5 class="">@lang('web.soc_login')</h5>
                                        <a class="bg-transparent pr-3" href="#" style="display: none"> <i class="fab fa-facebook"></i> </a>
                                        <a class="bg-transparent pr-3" href="{{route('web.google')}}"> <img width="35" height="35" class="img-fluid" src="{{asset('web/images/go.png')}}"> </a>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('web.close')</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div  class="modal fade " id="ForgetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('web.enter_email')</h5>
                                    <button type="button" class="close position-absolute" style="right: 95%;" data-dismiss="modal" aria-label="Close">
                                        <span class=" " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{route('web.forget.password')}}" method = "POST">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('web.email')</label>
                                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <button type="submit" class="btn btn-danger w-100">@lang('web.send')</button>


                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span class=" co-lg-3 text-left pr-3"> <i class="fa fa-lock"></i> <a data-toggle="modal" data-target="#registerModal"  class="text-light" href="#">@lang('web.sign_up')</a></span>

                    <div  class="modal fade " id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">>@lang('web.sign_up')</h5>
                                    <button type="button" class="close position-absolute" style="right: 95%;" data-dismiss="modal" aria-label="Close">
                                        <span class=" " aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('web.register')}}" method = "POST">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('web.full_name')</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputPassword1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('web.email')</label>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('web.password')</label>
                                            <input type="password" class="form-control" name="password" placeholder="كلمه السر لابد ان تكون من 6 احرف علي الاقل">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('web.pass_conf')</label>
                                            <input type="password" class="form-control" name="password_confirmation" >
                                        </div>

                                        <a class="" href="#">@lang('web.forget_pass')</a>

                                        <button type="submit" class="btn btn-danger w-100">@lang('web.login')</button>


                                    </form>

                                    <div class="text-center mt-3">
                                        <h5 class="">@lang('web.soc_login')</h5>
                                        <a class="bg-transparent pr-3" href="#" style="display: none"> <i class="fab fa-facebook"></i> </a>
                                        <a class="bg-transparent pr-3" href="{{route('web.google')}}"> <img width="35" height="35" class="img-fluid" src="{{asset('web/images/go.png')}}"> </a>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif


                @if(auth()->user() || auth('admin')->user())
                    <span class=" co-lg-3 text-left pr-3"> <i class="fa fa-user"></i> <a class="text-light" href="{{route('web.profile',['acc' => true])}}">@lang('web.acc')</a></span>

                    <span class=" co-lg-3 text-left pr-3"> <a class="text-light" href="{{route('web.profile' , ['shop' => true])}}"> <i class="fa fa-lock" style="color: gold"></i>@lang('web.shopping_cart')</a></span>

                    <span class=" co-lg-3 text-left pr-3"> <a class="text-light" href="{{route('web.profile' , ['fav' => true])}}">  <i class="fa fa-lock" style="color: red"></i>@lang('web.fav')</a></span>

                @endif

                @if(auth('admin')->user())
                    <span class=" co-lg-3 text-left pr-3"> <i class="fa fa-dashboard"></i> <a class="text-light" href="{{route('admin.home')}}">@lang('web.dash')</a></span>
                @endif


            </div>
        </div>
    </div>

    <div class="  col-lg-12 data-bar ">
        <div class="container ">
            <div class="row ">


                <a href="{{route('web.home')}}"><img class="ml-auto img-fluid" src="{{ asset('web/images/sozler.logo.png') }}" width="80px" height="50px" alt=""></a>
                <!-- <span  class=" basmala text-left pr-3 mt-3 "> <a class="data-Text" href="#">  بسم الله الرحمن الرحيم</a> </span> -->

                <!-- <img src="images/Capture-removebg-preview.png" width="150" height="50"  alt=""> -->

                <form class=" m-auto text-left pr-5 mt-4">

                    <input type="text" autocomplete="off" name="browser" id="browser-input" placeholder="@lang('web.search_txt')">

                    <div id="browsers"  class="hiddenlist position-absolute">
                        <ul class="bg-light">

                          </ul>
                    </div>


                    <select hidden class=" border border-0  ">
                        <option> اسم الكتاب</option>
                        <option> اسم الكتاب</option>
                        <option> اسم الكتاب</option>
                        <option> اسم الكتاب</option>
                    </select>

                    <i hidden class="fa fa-search "></i>
                </form>


                <div class="text-right mt-4 mr-auto ">
                    <a class="bg-transparent pr-3" href="https://www.facebook.com/SozlerEgypt-102455479056227"> <i class="fab fa-facebook"></i> </a>
{{--                    <a class="bg-transparent pr-3" href="#"> <i class="fab fa-twitter"></i> </a>--}}
                    <a class="bg-transparent pr-3" href="https://www.youtube.com/channel/UCarGcgnO9ZmLKcIM0fs38rQ"> <i class="fab fa-youtube"></i> </a>
{{--                    <a class="bg-transparent pr-3" href="#"> <i class="fab fa-google"></i> </a>--}}
                </div>



            </div>
        </div>
    </div>

    <nav class=" col-lg-12 navbar navbar-expand-lg position-relative navbar-dark ftco_navbar p-2  ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">Kahwa</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> <i class="fa fa-bars"></i> </span>
            </button>
            <div class="collapse navbar-collapse ml-auto" id="ftco-nav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item active "><a href="{{route('web.home')}}" class="nav-link active"> <i class=" fas fa-home"></i></a></li>

                    @foreach(App\Classification::all() as $class)
                        @if($class->id == 8)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="room.html" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">{{$class->classification}}</a>
                                <div  class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item text-light" data-toggle="modal" data-target="#flashModal3"   href="#" >@lang('web.flash')</a>
                                    <a class="dropdown-item text-light" href="https://www.youtube.com/channel/UCarGcgnO9ZmLKcIM0fs38rQ">@lang('web.audible_books')</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item active "><a href="{{route('web.getBbyC' , $class->id)}}" class="nav-link ">{{$class->classification}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div  class="modal fade " id="flashModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('web.flash')</h5>
                    <button type="button" class="close position-absolute" style="left: 95%;" data-dismiss="modal" aria-label="Close">
                        <span class=" " aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">

                    <div class="col-lg-12">
                        <div class=" flash-data text-dark">
                            <h3 class = 'mb-3 text-center text-danger text-bold'>@lang('web.Risale-Memory')</h3>
                            <p class = 'my-3 text-center text-danger text-bold'>@lang('web.In-the-voice')</p>
                            <p>@lang('web.Code')</p>
                            <p>@lang('web.AL-KALIMAT')</p>
                            <p>@lang('web.AL-MAKTUBAT')</p>
                            <p>@lang('web.AL-LAMAAT')</p>
                            <p>@lang('web.AL-SHUAAT')</p>
                            <p>@lang('web.ISHARAT-AL-ICAZ')</p>
                            <p>@lang('web.AL-MASNAVI-AL-ARABI-AL-NURI')</p>
                            <p>@lang('web.AL-MALAHIK')</p>
                            <p>@lang('web.SAYKAL-AL-ISLAM')</p>
                            <p>@lang('web.SIYRA-ZATIYYE')</p>
                            <p class="text-danger">@lang('web.FLSH-PRICY')</p>
                            <p class = "text-center text-bold">@lang('web.Whole-Collection')</p>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('web.close')</button>
                </div>
            </div>
        </div>
    </div>
</section>
