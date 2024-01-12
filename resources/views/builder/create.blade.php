@extends('admin.layouts.main')
@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- start page title -->

        <div class="row" style="">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">CREATE BUILDER GROUP</h4>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <form action="{{url('admin/builder/store')}}" method="post" id="create-builder-frm" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row border-bottom mb-3">


                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Name </label>
                                    <input type="text" name="name" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Logo </label>
                                    <input type="file" name="group_logo" class="form-control" placeholder="">
                                </div>


                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Address </label>
                                    <input type="text" name="address" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Website </label>
                                    <input type="text" name="website" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Contact No </label>
                                    <input type="text" name="contact_no" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Mail ID </label>
                                    <input type="text" name="mail" class="form-control" placeholder="">
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Builder Group Social Media Connect
                        </div>
                        <div class="card-body">
                            <div class="row border-bottom mb-3">
                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Linked In </label>
                                    <input type="text" name="linked_in" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Facebook </label>
                                    <input type="text" name="facebook" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label">Twitter </label>
                                    <input type="text" name="twitter" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Youtube </label>
                                    <input type="text" name="youtube" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Add Sub Group name
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="" class="form-label"> Add Sub-Group Name </label>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class=" mb-3 d-flex">
                                        <input type="text" name="sub_group_name[]" class="form-control" placeholder="" style="    width: 250px;">
                                        <button id="rowAdder" type="button" class="btn btn-dark">
                                            <span class="bi bi-plus-square-dotted">
                                            </span> Add
                                        </button>
                                    </div>
                                </div>
                                <div class="  mb-3">
                                    <div id="newinput" class="" style=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("#rowAdder").click(function() {
        newRowAdd =
            '<div id="removeInput" class=""><div class="input-group me-3 mb-3">' +
            '<div class="input-group-prepend">' +
            '<input type="text" name="sub_group_name[]" class="form-control m-input" style="width:250px;"> </div>' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Delete</button> </div></div>';
        $('#newinput').append(newRowAdd);
    });
    $("body").on("click", "#DeleteRow", function() {
        $(this).parents("#removeInput").remove();
    })

    $(document).on('submit', '#create-builder-frm', function(e){
        e.preventDefault();
        toggleLoadingAnimation();
        var formData = new FormData($('#create-builder-frm')[0]);
        $.ajax({
                url: $('#create-builder-frm').attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,  // Prevent jQuery from processing the data
                contentType: false,  // Prevent jQuery from setting the content type
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    toggleLoadingAnimation();
                    toastr.success(response.msg);
                    setTimeout(function() {
                        // Replace 'new_url' with the URL you want to redirect to
                        // alert(response.return_url);
                        window.location.href = response.return_url;
                    }, 2000); 
                },
                error: function(xhr) {
                    toggleLoadingAnimation();
                    if (xhr.status === 422) {
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            // $('<span class="input-error flash-errors" style="color: red">' + value[0] +
                            //     '</span>').insertAfter('input[name=' + key + ']');
                            $('input[name=' + key + ']').addClass('is-invalid');
                            console.log(key);
                        });
                    }
                }
                // }
            });
    })
</script>
@endpush