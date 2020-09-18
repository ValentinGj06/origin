<div class="row">
    <div class="col-sm-5">
        <h4 class="card-title mb-0">
            {{ __('labels.backend.access.locations.estimates') }} <small
                class="text-muted">{{ __('menus.backend.locations.location') }}</small>
        </h4>
    </div>
    <div class="col-sm-7 text-right">
        <span class="filter-text">Filters</span>
        <span class="show-filters">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect class="fltr-line1" x="7" y="10" width="18" height="1" fill="black"/>
                <rect class="fltr-line2" x="7" y="20" width="18" height="1" fill="black"/>
                <circle class="fltr-crcl1" cx="13" cy="20.5" r="2.5" fill="white" stroke="black"/>
                <circle class="fltr-crcl2" cx="19" cy="10.5" r="2.5" fill="white" stroke="black"/>
            </svg>
        </span>
    </div>

</div><!--row-->

<br>
<div style="display: none" class="row filter-panel">
    <div class="col-md-11">
        <div class="row">
            <form style="display: contents;" method="GET" action="/locations">    
                <div class="span5 col-md-2">
                    <div class="input-group input-daterange">
                        <span class="datefilter-prepend input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        <input autocomplete="off" id="datefilter" class="datefilter" type="text" placeholder="Date Between" name="datefilter"/>
                    </div>
                </div>
                <div class="span5 col-md-2 mb-3">
                    <div class="input-group years">
                        <select class="selectpicker" multiple data-size="5" data-selected-text-format="count > 2" data-style="btn-primary" data-live-search="true" data-actions-box="true" title="Select Years" data-placeholder="Chose Years" id="filter-years" name="years[]">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                        </select>
                    </div>
                </div>
                <div class="span5 col-md-2 mb-3">
                    <div class="input-group regions">
                        <select class="selectpicker" multiple data-size="5" data-selected-text-format="count > 2" data-style="btn-primary" data-live-search="true" data-actions-box="true" title="Select Regions" data-placeholder="Chose Regions" id="filter-regions" name="regions[]">
                            <option value="Битолски:1">Битолски Регион</option>
                            <option value="Прилепски:2">Прилепски Регион</option>
                            <option value="Кавадаречки:3">Кавадаречки Регион</option>
                            <option value="Кичевски:4">Кичевски Регион</option>
                            <option value="Скопски:5">Скопски Регион</option>
                            <option value="Велешки:6">Велешки Регион</option>
                            <option value="Струмички:7">Струмички Регион</option>
                            <option value="Валандовски:8">Валандовски Регион</option>
                            <option value="Штипско-Кочански:9">Штипско-Кочански Регион</option>
                            <option value="Радовишки:10">Радовишки Регион</option>
                            <option value="Гевгелиски:11">Гевгелиски Регион</option>
                            <option value="Кумановски:12">Кумановски Регион</option>
                            <option value="Охридски:13">Охридски Регион</option>
                            <option value="Струшки:14">Струшки Регион</option>
                            <option value="Дебарски:15">Дебарски Регион</option>
                            <option value="Тетовски:16">Тетовски Регион</option>
                            <option value="Гостиварски:17">Гостиварски Регион</option>
                            <option value="Останати:18">Останати</option>
                        </select>
                    </div>
                </div>
                <div class="span5 col-md-1">
                    <div class="input-group">
                        <button type="submit" id="search" class="btn btn-primary m-1">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row" id="filter_message">
    @if (request()->datefilter)
        <div class="col-md-2">Датум:&nbsp;
            <span id="datefilter" type="button" class="btn badge badge-pill badge-danger mr-1">{{ request()->datefilter }}</span>
        </div>
    @else
        <div class="col-md-2">Датум:&nbsp;
            <span id="datefilter" type="button" class="btn badge badge-pill badge-danger mr-1">Денес</span>
        </div>
    @endif
    @if (request()->years)
        <div class="col-md-2">Години:&nbsp;
            @foreach(request()->years as $key => $value)
                <span id="{{ $key }}" type="button" class="btn badge badge-pill badge-danger mr-1">{{ $value }}</span>
            @endforeach
        </div>
    @endif
    @if (request()->regions)
        @php
        foreach (request()->regions as $key => $value) {
            $regions [] = explode(':', $value);
        }
        @endphp
        <div class="col-md-8">Региони:&nbsp;
            @if (count($regions) === 18)
                <span id="regions" type="button" class="btn badge badge-pill badge-danger mr-1">
                Сите
                </span>
            @else
                @foreach ($regions as $region)
                    <span id="regions" type="button" class="btn badge badge-pill badge-danger mr-1">
                    {{ $region[0] }}
                    </span>
                @endforeach
            @endif
        </div>
    @endif    
</div>

