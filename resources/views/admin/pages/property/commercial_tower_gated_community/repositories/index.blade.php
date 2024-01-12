@if ($block_id == 'project-repositories')
    <form id="ProjectRepositoryForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="files" class="form-label">
                        Project Brochure</label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="brochure_file[]" id="brochure_file" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="brochure_file" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Project
                                Brochure</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr brochure_file_err"></span>

                </div>

            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['brochure']))
                    @forelse($project_repository_files['brochure'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                        width="80" height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>
        </div>

        <div class="row file-input-wrapper">
            <div class="col-xxl-4 col-md-4 mb-3">
                <div>
                    <label for="files" class="form-label"> Project Promotional Video</label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="video_files[]" id="video_files" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="video_files" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Project Promotional
                                Video </span></span>
                        </label>
                    </div>
                    <span class="clr_err text-danger othe_errr video_files_err"></span>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['video_files']))
                    @forelse($project_repository_files['video_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                        width="80" height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>

        </div>
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="files" class="form-label">
                        Images</label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="image_files[]" id="image_files" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="image_files" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Images</span>
                            </span>
                        </label>
                        <span class="clr_err text-danger othe_errr image_files_err"></span>
                    </div>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['image_files']))
                    @forelse($project_repository_files['image_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                        width="80" height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>

        </div>
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="files" class="form-label">
                        3D View Video
                    </label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="3dvideo_files[]" id="3dvideo_files"
                            class="form-control file-input" multiple="" placeholder=" " style="display:none;">
                        <label for="3dvideo_files" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add 3D View
                                Video</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr 3dvideo_files_err"></span>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['3dvideo_files']))
                    @forelse($project_repository_files['3dvideo_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>

        </div>
        <div class="row file-input-wrapper">

            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="files" class="form-label">
                        All Floor Plans
                    </label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="floor_file[]" id="floor_file" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="floor_file" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add All Floor
                                Plans</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr floor_file_err"></span>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['floor_file']))
                    @forelse($project_repository_files['floor_file'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xxl-3 col-md-3 mb-3">
                <label for="" class="form-label"> Youtube Link </label>
                <div class="">
                    <input type="text" name="youtube_link" id="" class="form-control" multiple=""
                        placeholder="" value="{{ $project_repository->youtube_link ?? '' }}">
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-2">
            <h4 id="add-btn" class="mb-3"> Others </h4>
            <div class="" id="container1">
                <div class=" row align-items-end original-div file-input-wrapper">
                    <div class="col-xxl-2 col-md-2 mb-3 ">
                        <div class="form-group">
                            <label for="files" class="form-label"> Enter the Name </label>
                            <input type="text" name="name[]" class="form-control " id=""
                                placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label for="files" class="form-label"> Upload (PDF, Images)
                            </label>
                            <div class="d-flex justify-content-center  ">
                                <div>
                                    <input type="file" name="addFloor[]" id="addFloor"
                                        class="form-control file-input" placeholder=" " style="display:none;">
                                    <label for="addFloor" class="form-label btn-anima btn-hover hoverfEffect ">
                                        <span><i class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Files </span></label>
                                </div>
                                <div>
                                    <span class="addpuls" onclick="clone_div()"> <i class="fa-solid fa-plus"></i>
                                    </span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div id="app_div"> </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_other_files))
                    @forelse($project_repository_other_files as $key=>$file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                        <span class="card-text">{{ ucwords($project_repository_other_file_name[$key]) }}</span>
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-md-12">
                <div class="text-end">
                    {{-- <input type="submit" class="btn btn-md btn-primary" value="Save & Proceed" /> --}}
                    <input type="submit" class="btn btn-md btn-primary" value="Save" />
                    <button type="button" class="btn btn-md btn-primary repositories-next-btn">Proceed</button>
                </div>
            </div>
        </div>
        </div>
    </form>
@endif