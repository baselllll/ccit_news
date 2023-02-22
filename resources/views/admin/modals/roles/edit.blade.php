<div class="modal animated fadeInUp custo-fadeInUp bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="showUrl" value="{{ route('admin.roles.show',':id') }}">
            <input type="hidden" id="updateUrl" value="{{ route('admin.roles.update') }}">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">@lang('dashboard.edit_role')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>

            <form id="editForm" class="mt-0" action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <input
                                type="text"
                                name="name"
                                id="name_edit"
                                class="form-control"
                                placeholder="@lang('dashboard.role_name')">
                            <span class="invalid-feedback" role="alert">
                                <strong id="name_edit_error"></strong>
                            </span>
                        </div>


                        <div class="col-md-12 mb-4">
                            <select
                                id="permissions_edit"
                                name="permissions[]"
                                multiple
                                placeholder="@lang('dashboard.select_permission')"
                                autocomplete="on">
                                @foreach($permissions as $key => $value)
                                    <option id="selected_{{ $value->id }}" value="{{ $value->id }}">{{ $value->name_ar }}</option>
                                @endforeach
                            </select>
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
