@foreach (config('translatable.locales') as $locale)
    <div class="form-group">
        <label>@lang('admin.' . $locale . '.classification')</label>
        <input type="text" name="{{ $locale }}[classification]" class="form-control" value="{{ $classification->translate($locale)->classification }}">
    </div>
@endforeach
