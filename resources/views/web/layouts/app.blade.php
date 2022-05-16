<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!!  csrf_token() !!}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('web/css/bootstrap/bootstrap.min.css')}}">
    <!-- fontawsome -->
    <link rel="stylesheet" href="{{asset('web/css/fontawsome/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/fontawsome/solid.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/fontawsome/brands.min.css')}}">
    <!-- plugins -->

    <link rel="stylesheet" href="{{asset('web/css/plugins/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/plugins/owl.theme.default.min.css')}}">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

    <!-- main Styles -->
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('web/css/enStyle.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('web/css/loader/preloader.css') }}">

    @yield('css')

    <link rel = "icon" href = "{{ asset('web/images/sozler.logo.png') }}" type = "image/x-icon">

    <title>SozlerEgypt</title>
</head>
<body style="background-color: #fefcf3!important;">

<!-- ? Preloader Start -->
<!--<div id="preloader-active">-->
<!--    <div class="preloader d-flex align-items-center justify-content-center">-->
<!--        <div class="preloader-inner position-relative">-->
<!--            <div class="preloader-circle"></div>-->
<!--            <div class="preloader-img pere-text ">-->
<!--                <img src="{{asset('web/images/newloader.gif')}}" alt="">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- ? Preloader end -->

@include('web.partials.header')




@yield('content')


@include('web.partials.footer')

@include('dashboard.partials._session')

@include('dashboard.partials._errors')

<!-- bootstrap -->
<script src="{{ asset('web/js/bootstrap/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('web/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('web/js/bootstrap/bootstrap.min.js') }}"></script>
<!-- fontawsome -->
<script src="{{ asset('web/js/fontawsome/fontawesome.min.js') }}"></script>
<script src="{{ asset('web/js/fontawsome/solid.min.js') }}"></script>
<script src="{{ asset('web/js/fontawsome/brands.min.js') }}"></script>
<!-- plugins -->
<script src="{{ asset('web/js/plugins/owl.carousel.min.js') }}"></script>
<!-- main scripts -->
<script src="{{ asset('web/js/custom.js') }}"></script>


<script>

$(document).ready(function(e) {
    'use strict';
    $('.HowCarsoul').owlCarousel({
        @if (app()->getLocale() == 'ar')rtl:true, @endif
        loop: true,
        margin: 2,
        autoplay: true,
        smartSpeed: 500,
        nav: true,
        dots: false,
		// navText: ['<span aria-label="Previous">‹</span>','<span aria-label="Next">›</span>'],
		lazyLoad:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
    });

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),}});

    $(document).on( "click", ".btn-favorite", function() {
        $(this).blur()

        var url = '';
        var method = '';
        var color = '';
        var that = $(this);
        var is_fav = '';

        if ($(this).data('favorite')){
            url = $(this).data('delete-url')
            method = "DELETE"
            color = "rgb(108, 117, 125)"
            is_fav = false
        }else {
            url = $(this).data('add-url')
            method = "POST"
            color = "rgb(255, 0, 0)"
            is_fav = true
        }

        $.ajax({
            "method":method,
            "url": url,
            success:function (res) {
                if (that.data('tr')){
                    that.parentsUntil('tbody').remove();
                }
                that.children('svg').css('color' , color)
                that.data('favorite' , is_fav)
            },
            error:function (xhr,ststus,error) {
                if (xhr.status == 401){
                    $('#loginModal').modal('show')
                }
            }
        });

    });

    $(document).on( "click", ".btn-cart", function() {
        $(this).blur()
        var url = '';
        var method = '';
        var that = $(this);
        var message = ''
        var test = $(this).data('add-url')
        if (!test){
            url = $(this).data('delete-url')
            method = "DELETE"
            message = "@lang('web.successdeleted')"
        }else {
            url = $(this).data('add-url')
            method = "POST"
            message = "@lang('web.successadded')"
        }

        $.ajax({
            "method":method,
            "url": url,
            success:function (res) {
                if (!test){
                    that.parentsUntil('tbody').remove();
                    $('#oder_price').val(res.sum)
                    $('#total_cost').val(res.sum)
                    $('#total_btn').text(`${res.sum}`)
                }

                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    text: message,
                    timeout: 2000,
                    killer: true
                }).show();

            },
            error:function (xhr,ststus,error) {
                if (xhr.status == 401){
                    $('#loginModal').modal('show')
                }
            }
        });

    });


    $(".input-Quantity").each(function () {

        var that = this;

        that.addEventListener('click',function (e) {
            e.preventDefault();
            $(this).removeAttr("readonly")
        });

        that.addEventListener('blur',function (e) {
            e.preventDefault();
            that = $(this)
            $.ajax({
                "method": "POST",
                "data" : {"quantity":that.val()},
                "url": that.data('url'),
                success:function (res) {
                    $('#oder_price').val(res.sum)
                    $('#total_cost').val(res.sum)
                    $('#total_btn').text(`${res.sum}`)
                    that.attr("readonly" , "true")
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "@lang('web.successupdate')",
                        timeout: 2000,
                        killer: true
                    }).show();
                },
                error:function (xhr,ststus,error) {
                    if (xhr.status == 401){
                        $('#loginModal').modal('show')
                    }
                }
            });

        });
    })

    $(document).on('click' , '#showForgetModal', function(e){
        e.preventDefault()
        $('#loginModal').modal('hide')
        $('#ForgetModal').modal('show')

        // var email = $('#ForgetModal input[name="email"]').val()
        // console.log(email)
        // $.ajax({
        //     type: "post",
        //     url: "{{route('web.forget.password')}}",
        //     data: {"word" : word},
        //     success: function (response) {
        //         // <li class="list-group-item p-1">Cras justo odio</li>
        //         var html = '';
        //         var data = response.data
        //         console.log(response)
        //             data.forEach(element => {
        //                 html += `<li class="list-group-item p-1"><a href="{{url('/book/')}}/${element.slug}">${element.name}</a></li>`
        //             });

        //         $('#browsers ul').html(html)
        //     },
        //     error:function (xhr,ststus,error) {
        //         console.log(ststus)
        //     },
        //     complete:function () {
        //         $('#browsers').css('display' , 'block')
        //     }
        // });
    })

    $('#browser-input').blur(()=>{
        $('#browsers').delay(2000).fadeOut(20)
    })

    $('#browser-input').focus(()=>{
        $('#browsers').css('display' , 'block')
    })

    $(document).on('keyup' , '#browser-input', ()=>{
    console.log();
    var word = $('#browser-input').val()
    // $('#browsers').css('display' , 'block')
    // console.log($('#browsers ul').html());
    $.ajax({
        type: "get",
        url: "{{ route('web.search') }}",
        data: {"word" : word},
        success: function (response) {
            // <li class="list-group-item p-1">Cras justo odio</li>
            var html = '';
            var data = response.data
            console.log(response)
                data.forEach(element => {
                    html += `<li class="list-group-item p-1"><a href="{{url('/book/')}}/${element.slug}">${element.name}</a></li>`
                });

            $('#browsers ul').html(html)
        },
        error:function (xhr,ststus,error) {
            console.log(ststus)
        },
        complete:function () {
            $('#browsers').css('display' , 'block')
        }
    });
})


});

</script>


@yield('js')
</body>
</html>









