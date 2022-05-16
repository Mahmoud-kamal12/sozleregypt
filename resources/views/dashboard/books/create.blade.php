@extends('dashboard.layout.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('admin.books')</h1>

            <ol class="breadcrumb">
                <li ><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> @lang('admin.dashboard')</a></li>
                <li class="active">@lang('admin.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('admin.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('dashboard.partials._errors')
                    <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>@lang('admin.author')</label>
                            <select name="author[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($authors as $person)
                                    <option value="{{ $person->id }}" {{ old('author') == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.translator')</label>
                            <select name="translator[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($translators as $person)
                                    <option value="{{ $person->id }}" {{ old('translator') == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.publisher')</label>
                            <select name="publisher[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($publishers as $person)
                                    <option value="{{ $person->id }}" {{ old('publisher') == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.Investigator')</label>
                            <select name="investigator[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($investigators as $person)
                                    <option value="{{ $person->id }}" {{ old('publisher') == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.edition')</label>
                            <select name="edition_id" class="form-control select2">
                                <option value="" disabled selected>@lang('admin.select')</option>
                                @foreach ($editions as $edition)
                                    <option value="{{ $edition->id }}" {{ old('edition') == $edition->id ? 'selected' : '' }}>{{ $edition->edition }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.classification')</label>
                            <select name="classification_id" class="form-control select2">
                                <option value="" disabled selected>@lang('admin.select')</option>
                                @foreach ($classifications as $classification)
                                    <option value="{{ $classification->id }}" {{ old('author') == $classification->id ? 'selected' : '' }} >{{ $classification->classification }}</option>
                                @endforeach
                            </select>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>@lang('admin.topic')</label>--}}
{{--                            <select name="topic_id" class="form-control select2">--}}
{{--                                <option value="" disabled selected>@lang('admin.select')</option>--}}
{{--                                @foreach ($topics as $topic)--}}
{{--                                    <option value="{{ $topic->id }}" {{ old('author') == $topic->id ? 'selected' : '' }} >{{ $topic->topic }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        @foreach (config('translatable.locales') as $locale)

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.binding_type')</label>
                                <input type="text" name="{{ $locale }}[binding_type]" class="form-control" value="{{ old($locale . '.binding_type') }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.paper_type')</label>
                                <input type="text" name="{{ $locale }}[paper_type]" class="form-control" value="{{ old($locale . '.paper_type') }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.printing_colors')</label>
                                <input type="text" name="{{ $locale }}[printing_colors]" class="form-control" value="{{ old($locale . '.printing_colors') }}">
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label>@lang('admin.' . $locale . '.paper_version_is_available_at')</label>--}}
{{--                                <input type="text" name="{{ $locale }}[paper_version_is_available_at]" class="form-control" value="{{ old($locale . '.paper_version_is_available_at') }}">--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.about')</label>
                                <input type="text" name="{{ $locale }}[about]" class="form-control" value="{{ old($locale . '.about') }}">
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label>@lang('admin.' . $locale . '.book_description')</label>--}}
{{--                                <textarea name="{{ $locale }}[description]" class="form-control ckeditor">{{ old($locale . '.description') }}</textarea>--}}
{{--                            </div>--}}

                        @endforeach

                        <div class="form-group">
                            <label>@lang('admin.number_pages')</label>
                            <input type="number" name="number_pages" class="form-control" value="{{ old($locale . '.number_pages') }}">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>@lang('admin.year_publication')</label>--}}
{{--                            <input type="number" name="year_publication" class="form-control" value="{{ old($locale . '.year_publication') }}">--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label>@lang('admin.year_release')</label>
                            <input type="number" name="year_release" class="form-control" value="{{ old($locale . '.year_release') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.size')</label>
                            <input type="text" name="size" class="form-control" value="{{ old($locale . '.size') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.weight')</label>
                            <input type="text" name="weight" class="form-control" value="{{ old($locale . '.weight') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.ISBN')</label>
                            <input type="text" name="ISBN" class="form-control" value="{{ old($locale . '.ISBN') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.code')</label>
                            <input type="text" name="code" class="form-control" value="{{ old($locale . '.code') }}">
                        </div>

                        <div class="form-group">

                            <label>@lang('admin.price_usd_after_discount')</label>
                            <input type="number" step="0.01" name="price_usd_after_discount" class="form-control" value="{{ old($locale . '.price_usd_after_discount') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.price_le_after_discount')</label>
                            <input type="number" name="price_le_after_discount" step="0.01" class="form-control" value="{{ old($locale . '.price_le_after_discount') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.images')</label>
                            <input type="file" name="images[]" class="form-control image" multiple>
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/products_images/defualt_product.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@section('scripts')

@endsection

