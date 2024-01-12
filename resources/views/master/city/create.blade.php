@extends('admin.layouts.main')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">cities</h4>
                </div>
            </div>
        </div>
        <div class="create-frm-container">

            <form action="{{ route('admin.city.store') }}" method="post" enctype="multipart/form-data" class="" id="store-frm">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-12 col-md-12">
                                    <div class="row">
                                        <div class="form-group col-auto">
                                            <label for="" class="">Country <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="country" id="" class="form-select">
                                                    {!! get_country_options('IN') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="" class="">State <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="state" id="" class="form-select">
                                                    {!! get_state_options('IN') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 ">
                                            <label>Enter City Name <span class="text-danger">*</span></label>
                                            <input type="text" id="city" name="city" class="form-control" placeholder="Enter city Name" maxlength="100" value="{{ old('city') }}">

                                            @error('city')
                                            <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-lg-2 my-2">
                                            <button type="submit" class="btn btn-primary mt-3 waves-light w_100"><i class="fa fa-check"></i> <span id="btn-txt">Create</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- end page title -->

        <!-- edit form starts-->
        <div class="edit-frm-container"></div>
        <!-- edit form ends-->
        <div class="row">
           

        </div>
        <!--end row-->

    </div> <!-- container-fluid -->
</div>
<input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')

<script>
    @foreach($errors-> all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
    @if(Session::has('message'))
    toastr.success("{{ Session::get('message') }}")
    @endif
</script>

<script>
    function isNumber(evt) {

        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-pincode').click(function() {
            var deleteUrl = $(this).data('url');
            $('#deleteCategoryLink').attr('href', deleteUrl);

            $('#deleteModal').modal('show');
        });
    });
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span id="deleteCategoryName"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="#" id="deleteCategoryLink">Delete</a>
            </div>
        </div>
    </div>
</div>
@endpush