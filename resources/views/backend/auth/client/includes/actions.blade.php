@if ($client->trashed())
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.clients.client_actions')">
        <a href="{{ route('admin.auth.client.restore', $client) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.clients.restore_client')">
            <i class="fas fa-sync"></i>
        </a>

        <a href="{{ route('admin.auth.client.delete-permanently', $client) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.clients.delete_permanently')">
            <i class="fas fa-trash"></i>
        </a>
    </div>
@else
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.clients.client_actions')">
        <a href="{{ route('admin.auth.client.show', $client) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </a>

        <a href="{{ route('admin.auth.client.edit', $client) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>

        <div class="btn-group btn-group-sm" role="group">
            <button id="clientActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('labels.general.more')
            </button>
            <div class="dropdown-menu" aria-labelledby="clientActions">
                @if ($client->id !== auth()->id())
                    <a href="{{ route('admin.auth.client.clear-session', $client) }}"
                       data-trans-button-cancel="@lang('buttons.general.cancel')"
                       data-trans-button-confirm="@lang('buttons.general.continue')"
                       data-trans-title="@lang('strings.backend.general.are_you_sure')"
                       class="dropdown-item" name="confirm_item">@lang('buttons.backend.access.clients.clear_session')</a>
                @endif

                @canBeImpersonated($client)
                    <a href="{{ route('impersonate', $client->id) }}" class="dropdown-item">@lang('buttons.backend.access.clients.login_as', ['client' => $client->full_name])</a>
                @endCanBeImpersonated

                <a href="{{ route('admin.auth.client.change-password', $client) }}" class="dropdown-item">@lang('buttons.backend.access.clients.change_password')</a>

                @if ($client->id !== auth()->id())
                    @switch($client->active)
                        @case(0)
                            <a href="{{ route('admin.auth.client.mark', [$client, 1,]) }}" class="dropdown-item">@lang('buttons.backend.access.clients.activate')</a>
                        @break

                        @case(1)
                            <a href="{{ route('admin.auth.client.mark', [$client, 0]) }}" class="dropdown-item">@lang('buttons.backend.access.clients.deactivate')</a>
                        @break
                    @endswitch
                @endif

                @if (! $client->isConfirmed() && ! config('access.clients.requires_approval'))
                    <a href="{{ route('admin.auth.client.account.confirm.resend', $client) }}" class="dropdown-item">@lang('buttons.backend.access.clients.resend_email')</a>
                @endif

                @if ($client->id !== 1 && $client->id !== auth()->id())
                    <a href="{{ route('admin.auth.client.destroy', $client) }}"
                       data-method="delete"
                       data-trans-button-cancel="@lang('buttons.general.cancel')"
                       data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                       data-trans-title="@lang('strings.backend.general.are_you_sure')"
                       class="dropdown-item">@lang('buttons.general.crud.delete')</a>
                @endif
            </div>
        </div>
    </div>
@endif
