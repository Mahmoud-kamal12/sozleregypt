@foreach (config('translatable.locales') as $locale)
    <div class="form-group">
        <label>@lang('admin.' . $locale . '.person')</label>
        <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $person->translate($locale)->name }}">
    </div>
@endforeach

<div class="form-group">
    <label>@lang('admin.type')</label>
    <select name="type" class="form-control select2">
        @foreach(App\Character::getEnumValues() as $type)
            <option value="{{$type}}" {{ $person->type == $type ? 'selected' : '' }} id="selectType">@lang('admin.'.$type)</option>
        @endforeach
    </select>
</div>
