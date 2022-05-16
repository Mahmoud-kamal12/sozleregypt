<footer class="text-center text-lg-start p-3 mt-5">

    <section class="" style="color: #fff !important;">
        <div class="container">
            <div class="row">

                <!-- //////////////////////////////////////////////////////////////////////// -->
                <div class="col-lg-2">
                    <a href="https://apps.apple.com/tr/app/sozler/id1565188005"><img class="img-fluid" src="{{asset('web/images/app.png')}}"    ></a>
                    <a href="https://play.google.com/store/apps/details?id=com.sozlernesriyat"><img class="img-fluid" src="{{asset('web/images/google.png')}}" ></a>

                </div>
                <!-- //////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////// -->
                <div class="col-lg-2">
                    <ul>
                        <li class="text-dark bg-light ">@lang('web.Releases_Of_SoZler')</li>
                        <li><a href="#">@lang('web.Our_new_releases')</a></li>
                        <li><a href="#">@lang('web.best_seller')</a></li>
                        <li><a href="#">@lang('web.audible_books')</a></li>
                        <li class="mt-4" style="color: #d1bff"><a href="{{ route('web.ReplacementCases')}}">@lang('web.return_and_exchange_policy')</a></li>


                    </ul>
                </div>
                <!-- //////////////////////////////////////////////////////////////////////// -->


                <!-- //////////////////////////////////////////////////////////////////////// -->
                <div class="col-lg-2">
                    <ul>
                        <li class="text-dark bg-light ">@lang('web.contact_us')</li>
                        <li><a href="#">@lang('web.address') : @lang('web.address_details')</a></li>
                        @if (app()->getLocale() == 'en')
                            <li><a href="#">@lang('web.phone') : (+20)1006585047 <br> (+20)1271521252  <br> (+202)23812098</a></li>
                        @else
                            <li><a href="#">@lang('web.phone') : 1006585047(20+) <br> 1271521252(20+)  <br> 23812098(202+)</a></li>
                        @endif
                        <li><a href="#">@lang('web.mail') : @lang('web.mail_details')</a></li>
                    </ul>
                </div>
                <!-- //////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////// -->
                <div class="col-lg-2">
                    <ul>
                        <li class="text-dark bg-light "> @lang('web.about_us')</li>
                        <p>@lang('web.about_footer')</p>
                    </ul>
                </div>
                <!-- //////////////////////////////////////////////////////////////////////// -->
                <!-- //////////////////////////////////////////////////////////////////////// -->
                <div class="col-lg-4" >
                    <h3 class="text-dark bg-light ">@lang('web.In_order_to_continue_building')</h3>
                    <form action="{{ route('web.sandbox') }}" method="get">
                        <input name="name" class="mt-3 bg-light  " style="border-radius: 10px;" type="text" placeholder="@lang('web.full_name')" required>
                        <input name="email" class="mt-3 bg-light  " style="border-radius: 10px;" type="email" placeholder="@lang('web.email')" required>
                        <textarea name="message" class="mt-3 bg-light  " style="border-radius: 10px;" name="" id="" cols="20" rows="3" ></textarea>
                        <br>
                        <button class="mt-3 btn btn-danger p-1" type="submit">@lang('web.send')</button>
                    </form>
                </div>
                <!-- //////////////////////////////////////////////////////////////////////// -->
            </div>
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div style="background-color:#be1a1e; color: #fff;" class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">

        <a class="text-reset fw-bold" href="#">@lang('web.lic')</a>
    </div>
</footer>
