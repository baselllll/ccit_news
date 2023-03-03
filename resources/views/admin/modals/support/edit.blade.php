<div class="modal animated fadeInUp custo-fadeInUp bd-example-modal-lg" id="editSupportModal" tabindex="-1" role="dialog" aria-labelledby="createAboutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="mt-0" action="{{route('admin.support.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input value=""  id="id" type="hidden" name="id">
                    <div class="row">

                        <label for="exampleFormControlTitle">@lang('dashboard.support_name')</label>
                        <div class="col-md-12 mb-4">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value=""
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>

                        <div class="col-md-12 mb-4">

                            <label for="exampleFormControlTextarea3">@lang('dashboard.support_description')</label>
                            <textarea name="description" placeholder=""
                                      id="description" class="form-control"  rows="7"></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="exampleFormControlTitle">@lang('dashboard.support_image')</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            @if(isset($row->media))
                                <img id="support_image"  width="120px" height="120px"  src="" class="img-thumbnail" alt="...">
                            @else
                                not image
                            @endif
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
