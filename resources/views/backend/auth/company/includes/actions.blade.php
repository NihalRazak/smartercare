@if ($logged_in_user->hasAllAccess())
    <x-utils.view-button :href="route('admin.auth.company.show', $company)" />
    <x-utils.edit-button :href="route('admin.auth.company.edit', $company)" />
    <x-utils.delete-button :href="route('admin.auth.company.destroy', $company)" />
@endif

@if (! $company->status)
    <x-utils.form-button
        :action="route('admin.auth.company.mark', [$company, 1])"
        method="patch"
        button-class="btn btn-primary btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Reactivate')
    </x-utils.form-button>
@else
    <x-utils.form-button
        :action="route('admin.auth.company.mark', [$company, 0])"
        method="patch"
        name="confirm-item"
        icon="fas fa-sync-alt"
        button-class="btn btn-primary btn-sm"
    >
        @lang('Deactivate')
    </x-utils.form-button>
@endif

