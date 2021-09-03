@extends('backend.layouts.app')

@section('title', __('Company Management'))

@section('content')
<x-forms.post :action="route('admin.additionalinfo.store')">
    <x-backend.card>
        <x-slot name="header">
            @lang('Additional Information')
        </x-slot>

        <x-slot name="body">
            <div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Age')</label>

                    <div class="col-md-4">
                        <input type="number" name="age" class="form-control" placeholder="{{ __('Age') }}" value="10" required />
                    </div>
                </div><!--form-group-->
                <div class="form-group row">
                    <label for="sex" class="col-md-2 col-form-label">@lang('Sex')</label>

                    <div class="col-md-4">
                        <select class="form-control" name="sex">
                            <option value="female">Female</option>
                            <option value="ftm">Female in Transition to Male</option>
                            <option value="male">Male</option>
                            <option value="mtf">Male in Transition to Female</option>
                        </select>
                    </div>
                </div><!--form-group-->
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Save')</button>
        </x-slot>
    </x-backend.card>
</x-forms.post>
@endsection
