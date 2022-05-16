@foreach (config('translatable.locales') as $locale)
    <div class="form-group">
        <label>@lang('admin.' . $locale . '.topic')</label>
        <input type="text" name="{{ $locale }}[topic]" class="form-control" value="{{ $topic->translate($locale)->topic }}">
    </div>
@endforeach
