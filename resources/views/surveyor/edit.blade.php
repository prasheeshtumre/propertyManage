@extends('admin.layouts.main')
@section('content')
    <style>
        #activate-account:checked {
            background-color: green !important;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit User Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('admin.surveyor.update', encrypt($surveyor->id)) }}" method="post" id="create_property"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-xl-12 col-md-12">
                                <div class="card">

                                    <div class="card-body">

                                        <div class="row">


                                            <div class="col-xxl-3 col-md-3 mt-3 d-none">
                                                <label for="" class="form-label"> Role </label>
                                                <select class="form-select" name="status">
                                                    <option value="">-Select-</option>
                                                    <option value="1"> item</option>
                                                    <option value="0"> item </option>

                                                </select>
                                            </div>


                                            <div class="col-xxl-3 col-md-3 mt-3">
                                                <div>
                                                    <label for="" class="form-label">Name <span
                                                            style="color:red;">*</span> </label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder=" " value="{{ $surveyor->name }}">
                                                    @error('name')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-md-3 mt-3">
                                                <div>
                                                    <label for="" class="form-label">Mobile Number <span
                                                            style="color:red;">*</span></label>
                                                    <input type="text" name="mobile" class="form-control"
                                                        placeholder=" " value="{{ $surveyor->mobile }}">
                                                    @error('mobile')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-md-3 mt-3">
                                                <div>
                                                    <label for="" class="form-label">Email ID <span
                                                            style="color:red;">*</span></label>
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder=" " value="{{ $surveyor->email }}">
                                                    @error('email')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-xxl-3 col-md-3 mt-3">
                                                <div>
                                                    <label for="" class="form-label">Username <span
                                                            style="color:red;">*</span></label>
                                                    <input type="text" name="username" class="form-control"
                                                        placeholder=" " value="{{ $surveyor->username }}">
                                                    @error('username')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-md-3 mt-3 d-none">
                                                <div>
                                                    <label for="" class="form-label">Password <span
                                                            style="color:red;">*</span></label>
                                                    <input type="text" name="password" class="form-control"
                                                        placeholder=" ">
                                                    @error('password')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-xxl-3 col-md-3 mt-3">
                                                <div>
                                                    <label for="" class="form-label"> Activate/Deactivate Account
                                                        <span style="color:red;">*</span></label>
                                                    <div class="form-check form-switch h3">
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            id="activate-account"
                                                            {{ $surveyor->status == 0 ? '' : 'checked' }}>
                                                        <label class="form-check-label" for="activate-account"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-primary   waves-light w_100"><i
                                                    class="fa fa-check"></i> Update</button>
                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>



                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
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
@endpush
