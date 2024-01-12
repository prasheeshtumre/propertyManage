@extends('admin.layouts.main')
@section('content')


<style>
    .sc_bg{
        background-color: #FAF3F0;
    }
    
    .lock_ic i{
        background-color: #fff;
    padding: 27px;
    border-radius: 50px;
    font-size: 18px;
    }
    
</style>



    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Change Password</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form name="submitForm" id="submitForm" method="post"
                action="{{ route('admin.surveyor.change-password', encrypt($id)) }}">
                @csrf
                <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder=""
                    value="{{ encrypt($id) }}">

                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">

                            <div class="card-body show_main sc_bg"> 
                                <div class="row ">
                                    <div class=" col-md-1 mb-3">
                                       <div class="lock_ic">
                                           <i class="fa fa-lock shadow"></i>
                                       </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <label for="" class="label_show"> New Password </label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="">
                                        @error('password')
                                            <span class="input-error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mb-3">
                                        <label for="" class="label_show"> Confirm Password </label>
                                        <input type="text" class="form-control" id="confirm_password"
                                            name="confirm_password" placeholder="">
                                        @error('confirm_password')
                                            <span class="input-error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="col-xxl-12 col-md-12 ">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!--end row-->
                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>
@endsection
