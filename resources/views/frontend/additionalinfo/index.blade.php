@extends('backend.layouts.app')

@section('title', __('Company Management'))

@section('content')
<x-forms.post :action="route('frontend.additionalinfo.store')">
    <x-backend.card>
        <x-slot name="header">
            @lang('Additional Information')
        </x-slot>

        <x-slot name="body">
            <div>
                <div class="form-group row">
                    <label for="ads_tracking" class="col-md-2 col-form-label">@lang('Ads Tracking')</label>

                    <div class="col-md-4">
                        <select class="form-control" name="ads">
                            <option>Marriage Counselor</option>
                            <option>Soccer Moms</option>
                            <option>Stunt Man</option>
                            <option>Tough Guy</option>
                        </select>
                    </div>
                </div><!--form-group-->
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Age')</label>

                    <div class="col-md-4">
                        <input type="number" name="age" class="form-control" placeholder="{{ __('Age') }}" value="10" required />
                    </div>
                </div><!--form-group-->
                <div class="form-group row">
                    <label for="sex" class="col-md-2 col-form-label">@lang('Sex')</label>

                    <div class="col-md-4">
                        <select class="form-control" name="sex" required>
                            <option value="">Please select sex</option>
                            <option value="Female">Female</option>
                            <option value="Female in Transition to Male">Female in Transition to Male</option>
                            <option value="Male">Male</option>
                            <option value="Male in Transition to Female">Male in Transition to Female</option>
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
