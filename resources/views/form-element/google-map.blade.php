<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }} wa-gmap">

    <label for="{{ $name }}" class="control-label">
        {{ $label }}
        @if($required)
            <span class="form-element-required">*</span>
        @endif
    </label>

    <input data-value="{{$value??''}}" type="text" class="form-control address" id="{{ $name }}" name="{{ $name }}" value="{{ $value ?? '49.9808100, 36.2527200' }}">
    <a href="javascript://" class="set-marker-to-address">Установить метку на адресе</a>
    <div id="google-map-container-{{$name}}" style="width: 100%; height:500px;border:1px solid black;" class="gmap-container"></div>

    @include(AdminTemplate::getViewPath('form.element.partials.helptext'))
    @include(AdminTemplate::getViewPath('form.element.partials.errors'))
</div>

