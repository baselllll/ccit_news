<div class="modal animated fadeInUp custo-fadeInUp bd-example-modal-xl" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <input type="hidden" id="saveUrl" value="{{ route('admin.roles.store') }}">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">@lang('dashboard.add_role')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>

            <form id="addForm" class="mt-0" action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                placeholder="@lang('dashboard.role_name')">
                            <span class="invalid-feedback" role="alert">
                                <strong id="name_error"></strong>
                            </span>
                        </div>

                        <div class="col-md-12 mb-4">
                            <select
                                id="permissions"
                                name="permissions[]"
                                multiple
                                placeholder="@lang('dashboard.select_permission')"
                                autocomplete="off">
                                @foreach($permissions as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-add-close" class="btn btn-light-danger mt-2 mb-2 btn-no-effect">@lang('dashboard.back')</button>
                    <button id="btn-save" class="btn btn-primary mt-2 mb-2 btn-no-effect"><i class="far fa-check-circle"></i> @lang('dashboard.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
