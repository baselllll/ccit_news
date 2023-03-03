<div class="modal animated fadeInUp custo-fadeInUp bd-example-modal-lg" id="editAboutModal" tabindex="-1" role="dialog" aria-labelledby="createAboutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="saveUrl" value="{{ route('admin.admins.store') }}">
            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">@lang('dashboard.add_admin')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <form class="mt-0" action="{{route('admin.about.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input value="" type="hidden" id="id" name="id">
                    <div class="row">
                        <label for="exampleFormControlTitle">@lang('dashboard.about_title')</label>
                        <div class="col-md-12 mb-4">
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value=""
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">

                            <label for="exampleFormControlTextarea3">@lang('dashboard.about_description')</label>
                            <textarea name="description" placeholder=""
                                      id="description" class="form-control"  rows="7"></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="exampleFormControlTitle">@lang('dashboard.about_image')</label>
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
                            <img id="about_image" width="120px" height="120px"  src="" class="img-thumbnail" alt="...">
                            <div/>
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
