@if ($user->isAdmin())
    @lang('Administrator')
@elseif ($user->isCompanyAdmin())
    @lang('Company Administrator')
@elseif ($user->isUser())
    @lang('User')
@else
    @lang('N/A')
@endif
