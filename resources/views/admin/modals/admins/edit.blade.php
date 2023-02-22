<div class="modal animated fadeInUp custo-fadeInUp bd-example-modal-lg" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="showUrl" value="{{ route('admin.admins.show',':adminUUID') }}">
            <input type="hidden" id="updateUrl" value="{{ route('admin.admins.update') }}">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">@lang('dashboard.edit_admin')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>

            <form id="editAdminForm" class="mt-0" action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="uuid" id="uuid">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <input
                                type="text"
                                name="full_name"
                                id="full_name_edit"
                                class="form-control"
                                placeholder="@lang('dashboard.full_name')">
                            <span class="invalid-feedback" role="alert">
                                <strong id="full_name_edit_error"></strong>
                            </span>
                        </div>

                        <div class="col-md-4 mb-4">
                            <input
                                type="text"
                                name="phone"
                                id="phone_edit"
                                class="form-control"
                                placeholder="@lang('dashboard.phone')">
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_edit_error"></strong>
                            </span>
                        </div>


                        <div class="col-md-12 mb-4">
                            <select
                                id="roles_edit"
                                name="roles[]"
                                multiple
                                placeholder="@lang('dashboard.select_roles')"
                                autocomplete="on">
                                @foreach($roles as $key => $value)
                                    <option id="selected_{{ $value }}" value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <input
                                type="text"
                                name="email"
                                id="email_edit"
                                class="form-control"
                                placeholder="@lang('dashboard.username')">
                            <span class="invalid-feedback" role="alert">
                                <strong id="email_edit_error"></strong>
                            </span>
                        </div>

                        <div class="col-md-6 mb-4">
                            <input
                                id="email_address_edit"
                                type="email"
                                name="email_address"
                                class="form-control"
                                style="direction: rtl;"
                                placeholder="@lang('dashboard.email')">
                            <span class="invalid-feedback" role="alert">
                                <strong id="email_address_edit_error"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-edit-close" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">@lang('dashboard.back')</button>
                    <button id="btn-save" class="btn btn-primary mt-2 mb-2 btn-no-effect"><i class="far fa-check-circle"></i> @lang('dashboard.saveChanges')</button>
                </div>
            </form>
        </div>
    </div>
</div>
