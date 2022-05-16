@foreach (config('translatable.locales') as $locale)
    <div class="form-group">
        <label>@lang('admin.' . $locale . '.edition')</label>
        <input type="text" name="{{ $locale }}[edition]" class="form-control" value="{{ $edition->translate($locale)->edition }}">
    </div>
@endforeach
