@extends('web.layouts.app')

@section('content')

    <section class="allbooks">
        <div class="container">
            <div class="row text-center">
                <div class="col col-6">
                    <form action="{{route('web.reset.password.post')}}" method = "POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" value="{{ $token }}" class="form-control" name="token" placeholder="">

                        <div class="form-group">
                            <label for="exampleInputPassword1">@lang('web.password')</label>
                            <input type="password" class="form-control" name="password" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">@lang('web.pass_conf')</label>
                            <input type="password" class="form-control" name="password_confirmation" >
                        </div>


                        <button type="submit" class="btn btn-danger w-100">@lang('web.login')</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
