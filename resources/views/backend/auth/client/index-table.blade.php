<div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.clients.table.id')</th>
                            <th>@lang('labels.backend.access.clients.table.username')</th>
                            <th>@lang('labels.backend.access.clients.table.first_name')</th>
                            <th>@lang('labels.backend.access.clients.table.last_name')</th>
                            <th>@lang('labels.backend.access.clients.table.code')</th>
                            <th>@lang('labels.backend.access.clients.table.phone_number')</th>
                            <th>@lang('labels.backend.access.clients.table.status')</th>
                            <th>@lang('labels.backend.access.clients.table.status')</th>
                            <th>@lang('labels.backend.access.clients.table.birth_date')</th>
                            <th>@lang('labels.backend.access.clients.table.card_number')</th>
                            <th>@lang('labels.backend.access.clients.table.pay_in')</th>
                            <th>@lang('labels.backend.access.clients.table.win')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="client in clients.data">
                            <td>@{{ client.id }}</td>
                            <td>@{{ client.username }}</td>
                            <td>@{{ client.client_info.first_name }}</td>
                            <td>@{{ client.client_info.last_name }}</td>
                            <td>@{{ client.client_detail.code }}</td>
                            <td>@{{ client.client_info.phone_number }}</td>
                            <td><span class="badge badge-warning">@{{ client.status }}</span></td>
                            <td><span class="badge badge-warning">@{{ client.client_info.is_valid_phone_number }}</span></td>
                            <td>@{{ client.client_info.birth_date }}</td>
                            <td>@{{ client.client_detail.card_number }}</td>
                            <td>@{{ client.client_detail.pay_in }}</td>
                            <td>@{{ client.client_detail.win }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    @{{ clients.total }}
                    {{ trans_choice('labels.backend.access.clients.table.total', 2) }}
                </div>
            </div><!--col-->
            <div class="col-5">
                <div class="float-right">
                    <nav>
                    <vue-pagination  :pagination="clients"
                     @paginate="getClients()"
                     :offset="4">
                    </vue-pagination>
                </nav>
                </div>
            </div><!--col-->
        </div><!--row