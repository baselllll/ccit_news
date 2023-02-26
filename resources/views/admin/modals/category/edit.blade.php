<div class="modal animated fadeInUp custo-fadeInUp bd-example-modal-lg" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createAboutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="mt-0" action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input value="{{$category_data->id}}" type="hidden" name="id">
                    <div class="row">

                        <label for="exampleFormControlTitle">@lang('dashboard.category_title')</label>
                        <div class="col-md-12 mb-4">
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{$category_data->title}}"
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>

                        <div class="col-md-12 mb-4">

                            <label for="exampleFormControlTextarea3">@lang('dashboard.category_content')</label>
                            <textarea name="content" placeholder="{{$category_data->content}}"
                                      id="content" class="form-control"  rows="7"
                            style="width: 749px;margin-right: 3px;"
                            ></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="exampleFormControlTitle">@lang('dashboard.category_type')</label>
                            <input
                                type="text"
                                name="type"
                                value="{{$category_data->type}}"
                                id="type"
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="exampleFormControlTitle">@lang('dashboard.category_image')</label>
                            <input
                                type="file"
                                name="image_link"
                                id="image_link"
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <img width="120px" height="120px"  src="{{$row->getMedia('category_images')[0]->getUrl()}}" class="img-thumbnail" alt="...">
                            <div/>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="exampleFormControlTitle">@lang('dashboard.category_video')</label>
                            <input
                                type="text"
                                value="{{$category_data->video_link}}"
                                name="video_link"
                                id="video_link"
                                class="form-control"
                            >
                            <span class="invalid-feedback" role="alert">
                                <strong id="phone_error"></strong>
                            </span>
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
