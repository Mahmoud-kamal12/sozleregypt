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
                    <h3 class="box-title">@lang('admin.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('dashboard.partials._errors')
                    <form action="{{ route('admin.books.update' , $book->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>@lang('admin.author')</label>
                            <select name="author[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($authors as $person)
                                    <option value="{{ $person->id }}" {{ old('author') == $person->id || in_array( $person->id, $book->author) ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.translator')</label>
                            <select name="translator[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($translators as $person)
                                    <option value="{{ $person->id }}" {{ old('translator') == $person->id || in_array( $person->id, $book->translator) ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.publisher')</label>
                            <select name="publisher[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($publishers as $person)
                                    <option value="{{ $person->id }}" {{ old('publisher') == $person->id || in_array( $person->id, $book->publisher) ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.Investigator')</label>
                            <select name="investigator[]" class="form-control select2" multiple>
                                <option value="" disabled >@lang('admin.select')</option>
                                @foreach ($investigators as $person)
                                    <option value="{{ $person->id }}" {{ old('publisher') == $person->id || in_array( $person->id, $book->investigator) ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.edition')</label>
                            <select name="edition_id" class="form-control select2">
                                <option value="" disabled selected>@lang('admin.select')</option>
                                @foreach ($editions as $edition)
                                    <option value="{{ $edition->id }}" {{ old('edition') == $edition->id || $book->edition_id == $edition->id ? 'selected' : '' }}>{{ $edition->edition }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.classification')</label>
                            <select name="classification_id" class="form-control select2">
                                <option value="" disabled selected>@lang('admin.select')</option>
                                @foreach ($classifications as $classification)
                                    <option value="{{ $classification->id }}" {{ old('author') == $classification->id || $book->classification_id == $classification->id ? 'selected' : '' }} >{{ $classification->classification }}</option>
                                @endforeach
                            </select>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>@lang('admin.topic')</label>--}}
{{--                            <select name="topic_id" class="form-control select2">--}}
{{--                                <option value="" disabled selected>@lang('admin.select')</option>--}}
{{--                                @foreach ($topics as $topic)--}}
{{--                                    <option value="{{ $topic->id }}" {{ old('author') == $topic->id || $book->topic_id == $topic->id ? 'selected' : '' }} >{{ $topic->topic }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        @foreach (config('translatable.locales') as $locale)

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $book->translate($locale)->name }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.binding_type')</label>
                                <input type="text" name="{{ $locale }}[binding_type]" class="form-control" value="{{ $book->translate($locale)->binding_type }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.paper_type')</label>
                                <input type="text" name="{{ $locale }}[paper_type]" class="form-control" value="{{ $book->translate($locale)->paper_type }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.printing_colors')</label>
                                <input type="text" name="{{ $locale }}[printing_colors]" class="form-control" value="{{ $book->translate($locale)->printing_colors }}">
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label>@lang('admin.' . $locale . '.paper_version_is_available_at')</label>--}}
{{--                                <input type="text" name="{{ $locale }}[paper_version_is_available_at]" class="form-control" value="{{ $book->translate($locale)->paper_version_is_available_at }}">--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label>@lang('admin.' . $locale . '.about')</label>
                                <input type="text" name="{{ $locale }}[about]" class="form-control" value="{{ $book->translate($locale)->about }}">
                            </div>


                        @endforeach

                        <div class="form-group">
                            <label>@lang('admin.number_pages')</label>
                            <input type="number" name="number_pages" class="form-control" value="{{ $book->number_pages }}">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>@lang('admin.year_publication')</label>--}}
{{--                            <input type="number" name="year_publication" class="form-control" value="{{ $book->year_publication }}">--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label>@lang('admin.year_release')</label>
                            <input type="number" name="year_release" class="form-control" value="{{ $book->year_release }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.size')</label>
                            <input type="text" name="size" class="form-control" value="{{ $book->size }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.weight')</label>
                            <input type="text" name="weight" class="form-control" value="{{ $book->weight }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.ISBN')</label>
                            <input type="text" name="ISBN" class="form-control" value="{{ $book->ISBN }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.code')</label>
                            <input type="text" name="code" class="form-control" value="{{ $book->code }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.price_usd_after_discount')</label>
                            <input type="number" step="0.01" name="price_usd_after_discount" class="form-control" value="{{ $book->price_usd_after_discount }}">
                        </div>


                        <div class="form-group">
                            <label>@lang('admin.price_le_after_discount')</label>
                            <input type="number" step="0.01" name="price_le_after_discount" class="form-control" value="{{$book->price_le_after_discount }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('admin.images')</label>
                            <input type="file" name="images[]" class="form-control image" multiple>
                        </div>

                        <div class="form-group">
                            @foreach($book->image_path as $img)
                                <img src="{{$img}}" style="width: 100px" class="img-thumbnail image-preview-test" alt="">
                            @endforeach
                                <img src="$img" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('admin.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@section('scripts')
    <script >



    </script>
@endsection

