<div class="form-group">
    <label>@lang('admin.name')</label>
    <input class="form-control" type="text" value="{{$sandbox->name}}">
</div>

<div class="form-group">
    <label>@lang('admin.email')</label>
    <input class="form-control" type="text" value="{{$sandbox->email}}">
</div>

<div class="form-group">
    <label>@lang('admin.message')</label>
    <textarea class="form-control" name="" id="" cols="30" rows="10">{{$sandbox->message}}</textarea>
</div>
