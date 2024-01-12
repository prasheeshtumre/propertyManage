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
                <form action="{{url('admin/builder/update', $id)}}" method="post" id="create-builder-frm" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row border-bottom mb-3">


                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Name </label>
                                    <input type="text" name="name" value="{{$builder->name ?? ''}}" class="form-control" placeholder="">
                                </div>



                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Address </label>
                                    <input type="text" name="address" value="{{$builder->address ?? ''}}" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Website </label>
                                    <input type="text" name="website" value="{{$builder->website ?? ''}}" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Contact No </label>
                                    <input type="text" name="contact_no" value="{{$builder->contact_no ?? ''}}" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Builder Group Mail ID </label>
                                    <input type="text" name="mail" value="{{$builder->mail ?? ''}}" class="form-control" placeholder="">
                                </div>

                                
                            </div>

                            <div class="row">
                                <div class="col-xxl-12 col-md-12 mb-3">
                                    <label for="group-logo" class="form-label border rounded">
                                        <div class="d-flex justify-content-center flex-column">
                                            <img src="{{asset('uploads/builders/'.$builder->group_logo)}}" class="img-fluid" style=" height: 150px;object-fit:contain;   width: 150px;">
                                            <p class="h5 text-center">Builder Group Logo</p>
                                            <p class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i>Change</p>
                                        </div>
                                    </label>
                                    <input type="file" name="group_logo" id="group-logo" class="form-control d-none" placeholder="">
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
                                    <input type="text" name="linked_in" value="{{$builder->linked_in ?? ''}}" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Facebook </label>
                                    <input type="text" name="facebook" value="{{$builder->facebook ?? ''}}" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label">Twitter </label>
                                    <input type="text" name="twitter" value="{{$builder->twitter ?? ''}}" class="form-control" placeholder="">
                                </div>

                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="form-label"> Youtube </label>
                                    <input type="text" name="youtube" value="{{$builder->youtube ?? ''}}" class="form-control" placeholder="">
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
                                <div class="">
                                    @forelse($builder->sub_groups as $sub_group)
                                        <div id="removeInput" class="builder-sub-group">
                                            <div class="input-group me-3 mb-3">
                                                <div class="input-group-prepend">
                                                    <input type="text" name="sub_group_name[]" value="{{$sub_group->name ?? ''}}" class="form-control m-input" style="width:250px;"> 
                                                    <input type="hidden" name="sub_group[]" value="{{$sub_group->id ?? ''}}" class="form-control m-input" style="width:250px;"> 
                                                </div>
                                                <button class="btn btn-danger remove-sub-group sub-group-{{$sub_group->id ?? ''}}" data-id="{{$sub_group->id ?? ''}}" type="button"><i class="bi bi-trash"></i> Delete</button> 
                                            </div>
                                        </div>
                                    @empty 
                                    @endforelse
                                </div>
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
                                    <div id="newinput" class="" style="">
                                        
                                    </div>
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
                    toggleLoadingAnimation();
                    // $('#create-builder-frm').reset();
                    toastr.success(response.msg);
                    setTimeout(function() {
                        // Replace 'new_url' with the URL you want to redirect to
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
    });

    $(document).on('click', '.remove-sub-group', function(){
        let subGroupId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                RemoveSubGroup(subGroupId);
                // User confirmed, perform delete action
            }
        });
    });
    function RemoveSubGroup(subGroupId){
        $.ajax({
            type: "GET",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{ url('admin/builder/sub-group/destroy') }}/"+subGroupId,
            success: function(response) {
                $('.sub-group-'+subGroupId).parent().closest('.builder-sub-group').remove();
            }
        });
        
    }
</script>
@endpush