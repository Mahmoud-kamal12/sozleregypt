@foreach (config('translatable.locales') as $locale)
    <div class="form-group">
        <label>@lang('admin.' . $locale . '.city')</label>
        <input type="text" name="{{ $locale }}[city]" class="form-control" value="{{ $shipping->translate($locale)->city }}">
    </div>
@endforeach

<div class="form-group">
    <label>@lang('admin.cost')</label>
    <input type="number" step="0.01" name="cost" class="form-control" value="{{ $shipping->cost }}">
</div>
