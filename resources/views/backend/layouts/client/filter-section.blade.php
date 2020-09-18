<div class="row">
    <div class="col-sm-5">
        <h4 class="card-title mb-0">
            {{ __('labels.backend.access.clients.list') }} <small
                class="text-muted">{{ __('labels.backend.access.clients.active') }}</small>
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
            <div class="span5 col-md-2">
                <filter-reg-date></filter-reg-date>
            </div>
            <div class="span5 col-md-2">
            <!-- <filter-location :city="{{ $city }}"></filter-location> -->
                <div class="input-group">
                    <select multiple data-placeholder="Add location" id="from_city" name="from_city[]"
                            ref="from_city">
                        @foreach ($city as $location)
                            <option>{{ $location->city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="span5 col-md-1">
                <filter-pay-in :max_pay_in="{{ $max_pay_in }}"></filter-pay-in>
            </div>
            <div class="span5 col-md-1">
                <filter-win :max_win="{{ $max_win }}"></filter-win>
            </div>
            <div class="span5 col-md-1 custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="valid_phone_number"
                       name="valid_phone_number">
                <label class="custom-control-label" for="valid_phone_number">Valid Phone Number Only</label>
            </div>
            <div class="span5 col-md-1 custom-control custom-checkbox my-1 mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="today-birthday" name="today-birthday">
                <label class="custom-control-label" for="today-birthday">Today's Birthday</label>
            </div>
            <div class="span5 col-md-2">
                <div class="input-group categoriesDrop">
                    <select class="selectpicker" multiple data-size="5" data-selected-text-format="count > 2" data-style="btn-info" data-live-search="true" data-actions-box="true" title="Select Categories" data-placeholder="Select Categories" id="filter-categories" name="categories[]">
                        @foreach ($existing_categories as $category)
                            <option value="{{ $category->name }}">{{ ucwords(str_replace('_', ' ', $category->name)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="span5 col-md-2 mb-3">
                <div class="input-group tags">
                    <select class="selectpicker" multiple data-size="5" data-selected-text-format="count > 2" data-style="btn-primary" data-live-search="true" data-actions-box="true" title="Select Tags" data-placeholder="Chose Tags" id="filter-tags" name="tags[]">
                        @foreach ($existing_tags as $tags)
                            <option>{{ $tags['value'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- <div class="span5 col-md-1 mb-3">
                <div class="input-group age">
                    <select class="selectpicker" data-size="5" data-style="btn-danger" title="Select Age" data-placeholder="Chose Tags" id="filter-age" name="age">
                        <option hidden></option>
                        <option value="0;19">Под 20г</option>
                        <option value="20;29">20 - 29г</option>
                        <option value="30;39">30 - 39г</option>
                        <option value="40;49">40 - 49г</option>
                        <option value="50;59">50 - 59г</option>
                        <option value="60;69">60 - 69г</option>
                        <option value="70;79">70 - 79г</option>
                        <option value="80;100">Над 80г</option>
                    </select>
                </div>
            </div> -->
            <div class="span5 col-md-3 mb-3">
                <div class="input-group mb-3">
                <label class="input-group-text justify-content-center">Години</label>
                    <div class="input-group-prepend">
                        <span class="input-group-text">од</span>
                    </div>
                    <input type="number" aria-label="age_from" min="0" max="80" id="age_from" name="age_from" class="form-control datefilter">
                    <div class="input-group-prepend">
                        <span class="input-group-text">до</span>
                    </div>
                    <input type="number" aria-label="age_to" min="18" max="100" id="age_to" name="age_to" class="form-control datefilter">
                </div>
            </div>
        </div>
    </div>
    <div class="span5 col-md-1">
        <div class="input-group">
            <button id="search" class="btn btn-primary m-1">Search</button>
        </div>
    </div>
</div>
<div id="toolbar" class="select">
    <select class="form-control search-input">
        <option value="selected">Export Selected</option>
        <option value="all">Export All</option>
    </select>
</div>
<div id="filter_message">

</div>
