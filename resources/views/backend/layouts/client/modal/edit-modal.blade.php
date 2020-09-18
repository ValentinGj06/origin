<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-info">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Client Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-client" method="POST">
                    <div id="errors" class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    @csrf
                    @method('PATCH')
                    <input hidden type="text" class="form-control" id="id" name="id">
                    <div id="edit-form" class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name"></label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       aria-describedby="firstNameHelp" value="" placeholder="e.g. Frodo">
                                <small id="firstNameHelp" class="form-text text-muted">First Name e.g.
                                    Frodo</small>
                            </div>
                            <div class="form-group">
                                <label for="last_name"></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       aria-describedby="lastNameHelp" value="" placeholder="e.g. Baggins">
                                <small id="lastNameHelp" class="form-text text-muted">Last Name e.g.
                                    Baggins</small>
                            </div>
                            <div class="form-group">
                                <label for="email"></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       aria-describedby="emailHelp" value=""
                                       placeholder="e.g. clark.kent@mail.com">
                                <small id="emailHelp" class="form-text text-muted">Email e.g.
                                    clark.kent@mail.com</small>
                            </div>
                            <div class="form-group">
                                <label for="birth_date"></label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                       aria-describedby="birthDateHelp" value=""
                                       placeholder="e.g. 29.02.1993">
                                <small id="birthDateHelp" class="form-text text-muted">Birth Date e.g.
                                    29.02.1993</small>
                            </div>
                            <div class="form-group">
                                <label for="phone_number"></label>
                                <input type="text" class="form-control" id="phone_number"
                                       name="phone_number" aria-describedby="phoneNumberHelp" value=""
                                       placeholder="e.g. +XXX XX XXX XXX">
                                <small id="phoneNumberHelp" class="form-text text-muted">Phone Number e.g.
                                    +XXX XX XXX XXX</small>
                            </div>
                            <div class="form-group">
                                <label for="is_valid_phone_number"></label>
                                <select class="form-control" id="is_valid_phone_number"
                                        name="is_valid_phone_number"
                                        aria-describedby="isValidPhoneNumberHelp">
                                    <option value="" disabled selected hidden>-- Please Choose --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <small id="isValidPhoneNumberHelp" class="form-text text-muted">Valid Phone
                                    Number e.g. Yes</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="street"></label>
                                <input type="text" class="form-control" id="street" name="street"
                                       aria-describedby="streetHelp" value=""
                                       placeholder="e.g. Diagon Alley">
                                <small id="streetHelp" class="form-text text-muted">Street e.g. Diagon
                                    Alley</small>
                            </div>
                            <div class="form-group">
                                <label for="street_number"></label>
                                <input type="text" class="form-control" id="street_number"
                                       name="street_number" aria-describedby="streetNumberHelp" value=""
                                       placeholder="e.g. 13">
                                <small id="streetNumberHelp" class="form-text text-muted">Street Number e.g.
                                    13</small>
                            </div>
                            <div class="form-group">
                                <label for="city"></label>
                                <input type="text" class="form-control" id="city" name="city"
                                       aria-describedby="cityHelp" value="" placeholder="e.g. Asgard">
                                <small id="cityHelp" class="form-text text-muted">City or Place e.g.
                                    Asgard</small>
                            </div>
                            <div class="form-group">
                                <label for="registered_on_location"></label>
                                <input type="text" class="form-control" id="registered_on_location"
                                       name="registered_on_location"
                                       aria-describedby="registeredOnLocationHelp" value=""
                                       placeholder="e.g. 55007">
                                <small id="registeredOnLocationHelp" class="form-text text-muted">Location
                                    Number e.g. 55007</small>
                            </div>
                            <div class="form-group">
                                <label for="registration_date"></label>
                                <input type="date" class="form-control" id="registration_date"
                                       name="registration_date" aria-describedby="registrationDateHelp"
                                       value="" placeholder="e.g. dd/mm/yyyy">
                                <small id="registrationDateHelp" class="form-text text-muted">Registration
                                    Date e.g. dd/mm/yyyy</small>
                            </div>
                            <div class="form-group">
                                <label for="gender"></label>
                                <select class="form-control" id="gender" name="gender"
                                        aria-describedby="genderHelp">
                                    <option value="" disabled selected hidden>-- Please Choose M - male or F - female --</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                                <small id="genderHelp" class="form-text text-muted">Gender e.g. 'M' for male</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="code"></label>
                                <input type="number" class="form-control" id="code" name="code"
                                       aria-describedby="codeHelp" value="" placeholder="e.g. 2121">
                                <small id="codeHelp" class="form-text text-muted">Code e.g. 2121</small>
                            </div>
                            <div class="form-group">
                                <label for="card_number"></label>
                                <input type="text" class="form-control" id="card_number" name="card_number"
                                       aria-describedby="cardNumberHelp" value=""
                                       placeholder="e.g. 02015007">
                                <small id="cardNumberHelp" class="form-text text-muted">Card Number e.g.
                                    02015007</small>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <vue-tags ref="tags" :tags="{{ json_encode($existing_tags) }}">
                                </vue-tags>
                                <small id="tagsHelp" class="form-text text-muted">Tags e.g. basketball</small>
                            </div>
                                <label for="addCategory">Categories</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="addCategory" placeholder="Add New Category">
                                <div class="input-group-append">
                                <button type="button" id="createCategory" class="btn btn-secondary">Create</button></div>
                            </div>
                            <small id="categoriesHelp" class="form-text text-muted">Create Category e.g. Football gambler</small>
                            <div id="allCategories" class="form-group">
                                @foreach($existing_categories as $category)
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="{{ $category->name }}" name="categories[]" value="{{ $category->name }}">
                                        <label class="custom-control-label" for="{{ $category->name }}">{{ strtoupper(str_replace('_', ' ', $category->name)) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="update-data" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
