@extends('web.layouts.app')

@section('content')
    <section class="profileTaps">
        <div class="container">
            <div  class="row">
                <div  class=" col-lg-3 col-md-4 mt-5 Tabs-nav">
                    <!-- Tabs nav -->
                    <div class="nav flex-column  nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <a class="  nav-link py-2 p-2 {{!$acc && !$fav && !$shop  ? "active":""}} {{$acc ? "active":""}}" id="v-pills-home-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="v-pills-home" aria-selected="false">
                            <span class=" font-weight-bold small text-uppercase">@lang('web.my_acc')</span></a>
                        <hr class="p-0 m-0">

                        <a class="  nav-link py-2 p-2  {{$shop ? "active":""}} " id="v-pills-shoplist-tab" data-toggle="pill" href="#shoplist" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                            <span class=" font-weight-bold small text-uppercase">@lang('web.shopping_cart')</span></a>
                        <hr class="p-0 m-0">

                        <a class="  nav-link py-2 p-2 {{$fav ? "active":""}} " id="v-pills-favourits-tab" data-toggle="pill" href="#favourits" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            <span class="  font-weight-bold small text-uppercase"> @lang('web.fav') </span></a>
                        <hr class="p-0 m-0">

                    </div>
                </div>

                <div  class="col-lg-9 col-md-8 mt-5">

                    <!-- Tabs content -->

                    <div class="tab-content" id="v-pills-tabContent mb-5">

                        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->

                        <div class="tab-pane fade shadow {{!$acc && !$fav && !$shop  ? "active":""}} {{$acc ? "active":""}} rounded bg-white show  p-5" id="profile" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row tab-text">
                                <div  class="col-lg-12 ml-auto  m-auto dashbord-bac  text-white ">

                                    <form class="col-lg-12" action="{{route('web.reset')}}" method = "get">
                                        @method('get')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputname">@lang('web.name')</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputname"  placeholder="الاسم" value="{{auth()->user()->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">@lang('web.email')</label>
                                            <input type="email" name="email" class="form-control" id="" value="{{auth()->user()->email}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('web.change_pass')</label>
                                            <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="@lang('web.old_pass')">
                                            <input type="password" name="password" class="form-control mt-2" id="exampleInputPassword2" placeholder="@lang('web.new_pass')">
                                            <input type="password" name="password_confirmation" class="form-control mt-2" id="exampleInputPassword2" placeholder="@lang('web.new_pass')">
                                        </div>

                                        <div class="m-auto w-100 text-center">
                                            <button type="submit" class="btn btn-danger  col-lg-6 ">@lang('web.save')</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->

                        <div class="tab-pane fade shadow {{$shop ? "active":""}} rounded bg-white show  p-5" id="shoplist" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row tab-text">
                                <div  class="col-lg-12 ml-auto tabalawy m-auto dashbord-bac  text-white ">
                                    <table class="table text-center">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">@lang('web.book_pic')</th>
                                            <th scope="col">@lang('web.book-name')</th>
                                            <th scope="col">@lang('web.price_lg')</th>
                                            <th scope="col">@lang('web.quantity')</th>
                                            <th scope="col">@lang('web.delete')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($cart) > 0)
                                            @foreach($cart as $book)
                                                <tr class="bg-light border border-2">

                                                    <td class="img-fluid">
                                                        <img src="{{ $book->image_path[0] }}" width="100px" height="120px" alt="">
                                                    </td>

                                                    <td>{{ $book->name }}</td>


                                                    <td>{{$book->price_le_after_discount}}</td>

                                                    <td>
                                                        <input data-url="{{route('web.addcart' , $book->id)}}" class="input-Quantity form-control w-75 d-inline" type="number" value = "{{ $book->pivot->quantity }}" name= "quantity" readonly>
                                                    </td>

                                                    <td>
                                                        <i  data-delete-url = "{{route('web.deletecart' , $book->id)}}" class="fa fa-window-close btn-cart" aria-hidden="true"></i>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="bg-light border border-2">
                                                <td colspan="6"><h1>@lang('web.no_books')</h1></td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>



                                    <!-- Button trigger modal -->
                                    @if(count($cart) > 0)
                                        <button type="button" class="btn btn-danger detailsModal" data-toggle="modal" data-target="#detqailsmodal">
                                            @lang('web.create_order')
                                        </button>

                                        <div  class="btn btn-dark " disabled>
                                            @lang('web.total_btn') :  <span id="total_btn">{{$sum}}</span> @lang('web.lg')
                                        </div>
                                @endif
                                <!-- Modal -->
                                    <div class="modal fade" id="detqailsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">@lang('web.create_order')</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="col-lg-12" action="{{route('web.paymob')}}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="form-group">
                                                            <label for="exampleInputname">@lang('web.f_name')</label>
                                                            <input type="text" class="form-control" id="exampleInputname" name="firstname" placeholder="@lang('web.f_name')" value="{{auth()->user()->name}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputname">@lang('web.l_name')</label>
                                                            <input type="text" class="form-control" id="exampleInputname" name="lastname" placeholder="@lang('web.l_name')" value="{{auth()->user()->name}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">@lang('web.email')</label>
                                                            <input type="email" class="form-control" id="" name="email" value="{{auth()->user()->email}}" placeholder="@lang('web.email')" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="exampleInputname">@lang('web.phone_num')</label>
                                                            <input type="tel" class="form-control" id="exampleInputname" name="phone" placeholder="@lang('web.phone_num')" value="" required>
                                                        </div>

                                                        <div class="form-group row">

                                                            <div class="col-6">
                                                                <label for="exampleInputname">@lang('web.country')</label>
                                                                <select name="country" id="country" class="form-control select2" required>
                                                                    <option value="@lang('admin.egypt')" selected>@lang('admin.egypt')</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="zip">@lang('web.zip')</label>
                                                                <input type="text" class="form-control" id="zip" name="zip" placeholder="@lang('web.zip')" value="" required>
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-6">
                                                                <label for="exampleInputname">@lang('web.city')</label>
                                                                <select name="city" id="city" class="form-control select2" required>
                                                                    <option value="" selected disabled>@lang('web.choose_city')</option>
                                                                    @foreach(\App\Shipping::all() as $city)
                                                                        <option value="{{$city->id}}" data-cost="{{$city->cost}}">{{$city->city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="exampleInputname">@lang('admin.cost')</label>
                                                                <input type="number" step="0.01" class="form-control" id="shipping_cost" value="0" disabled>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="exampleInputname">@lang('web.oder_price')</label>
                                                                <input type="number" step="0.01" id="oder_price" class="form-control"  value="{{$sum}}" disabled>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="exampleInputname">@lang('web.cost_after_shipping')</label>
                                                                <input type="number" step="0.01" id="total_cost" class="form-control"  value="{{$sum}}" disabled>
                                                            </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputname">@lang('web.address')</label>
                                                            <input type="text" class="form-control" id="exampleInputname" name="address" placeholder="@lang('web.address')" value="" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="">@lang('web.card_number')</label>
                                                            <input type="text" class="form-control" id="card_number" name="card_number" value="" placeholder="@lang('web.card_number')" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">@lang('web.card_holdername')</label>
                                                            <input type="text" class="form-control" id="card_holdername" name="card_holdername" value="" placeholder="@lang('web.card_holdername')" required>
                                                        </div>

                                                        <div class="form-group row">

                                                            <div class="col-4">
                                                                <label for="">@lang('web.card_expiry_mm')</label>
                                                                <input type="number" maxlength="2" class="form-control" id="card_expiry_mm" name="card_expiry_mm" value="" placeholder="Exp.Month" required maxlength="2" min="1"     oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                >
                                                            </div>

                                                            <div class="col-4">
                                                                <label for="">@lang('web.card_expiry_yy')</label>
                                                                <input type="number" class="form-control" id="card_expiry_yy" name="card_expiry_yy" value="" placeholder="Exp.Year" required maxlength="2" min="2"     oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                >
                                                            </div>

                                                            <div class="col-4">
                                                                <label for="">CVV</label>
                                                                <input type="number"  class="form-control" id="card_cvv" name="card_cvv" value="" placeholder="CCV" required min="3" maxlength="4"
                                                                       oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <div class="col-12">
                                                                <input type="checkbox" style="display: inline" id="ReplacementCases"  required>
                                                                <label for="ReplacementCases" style="display: inline">@lang('web.ReplacementCases')</label>
                                                                <span><a href="{{ route('web.ReplacementCases') }}">المزيد</a></span>
                                                            </div>
                                                        </div>



                                                        <div class="m-auto w-100 text-center">
                                                            <button type="submit" class="btn btn-danger  col-lg-6 ">@lang('web.save')</button>
                                                        </div>


                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->

                        <div class="tab-pane fade shadow {{$fav ? "active":""}} rounded bg-white show p-5" id="favourits" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row tab-text">
                                <div  class="col-lg-12 ml-auto tabalawy m-auto dashbord-bac  text-white ">
                                    <table class="table text-center">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">@lang('web.book_pic')</th>
                                            <th scope="col">@lang('web.book-name')</th>
                                            <th scope="col">@lang('web.price_lg')</th>
                                            <th scope="col">@lang('web.price_usd')</th>
                                            <th scope="col">@lang('web.delete')</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(count($favorite) > 0)
                                            @foreach($favorite as $book)
                                                <tr class="bg-light border border-2">

                                                    <td class="img-fluid">
                                                        <img src="{{ $book->image_path[0] }}" width="100px" height="120px" alt="">
                                                    </td>

                                                    <td>{{ $book->name }}</td>


                                                    <td>{{$book->price_le_after_discount}}</td>

                                                    <td>{{$book->price_usd_after_discount}}</td>

                                                    <td>
                                                        <i  data-tr="tr" data-delete-url = "{{route('web.deletefavorite' , $book->id)}}" data-add-url = "{{route('web.addfavorite',$book->id)}}" data-favorite="{{$book->is_fav}}" class="fa fa-window-close btn-favorite" aria-hidden="true"></i>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="bg-light border border-2">
                                                <td colspan="6"><h1>@lang('web.no_books')</h1></td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

                    @if (app()->getLocale() == 'ar')
                        <div class="tab-pane fade shadow active rounded bg-white show  p-5 mt-5 " style="text-align: right">

                            - بعد وصول إشعار التحويل إلينا من البنك بدفع القيمة سنقوم بتجهيز طلبكم للشحن وموافاتكم خلال فترة وجيزة ببوليصة الشحن للمتابعة .
                            <br><br>
                            - ونود منكم التأكد أن بطاقتكم صالحة للاستخدام عبر الإنترنت بالرجوع إلى البنك وأن الرصيد يسمح.
                            <br><br>
                            - بعد إتمام عملية الدفع سيتم التواصل معكم عبر البريد الالكتروني المسجل أو رقم الهاتف التأكيد عليكم بإستلام رقم الطلب
                            <br><br>
                            - في حال وجود إختلاف في الكمية أو القيمة المذكورة في عرض السعر سيتم التواصل معكم عبر البريد الإلكتروني المسجل أو رقم الهاتف.

                        </div>
                    @else
                        <div class="tab-pane fade shadow active rounded bg-white show  p-5 mt-5 " style="text-align: left">

                            - After the transfer notice arrives at us from the bank to pay the value, we will process your order for shipment and provide you with a shipping policy for follow-up.
                            <br><br>
                            - We would like you to ensure that your card is usable online by reference to the bank and that the balance is allowed.
                            <br><br>
                            - After the payment is completed, you will be contacted by registered email or phone number to confirm that you have received the order number                                                  <br><br>
                            - in the event of a difference in the quantity or value mentioned in the bid, you will be contacted by registered email or phone number.
                        </div>
                    @endif


                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>

        $('#city').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            let cost = optionSelected.data('cost')
            $('#shipping_cost').val(cost)
            let q = $('#oder_price').val()
            let total = Number(q) + Number(cost)
            $('#total_cost').val(total)
            $('#total_btn').text(`${total}`)

        });

    </script>
@endsection
