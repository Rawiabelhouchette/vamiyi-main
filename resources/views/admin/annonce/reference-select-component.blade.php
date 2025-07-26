@props(['title', 'name', 'options', 'required' => false])

<div class="row" wire:ignore>
    <div class="col-md-12" style="margin-top: 10px; padding-bottom: 10px; padding-left: 40px;padding-right: 40px;">
        <label class="">{{ $title }}
            @if ($required)
                <b style="color: red; font-size: 100%;">*</b>
            @endif
        </label> <br>
        <select class="form-control select2" multiple style="width: 100%;" wire:model.defer='{{ $name }}' data-nom="{{ $name }}" @if ($required) required @endif>
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->valeur }}</option>
            @endforeach
        </select>
    </div>
</div>
