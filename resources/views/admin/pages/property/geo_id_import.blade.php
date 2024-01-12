@extends('admin.layouts.main')
@section('content')
<link href="https://survey.proper-t.co/public/assets/css/show-property-details.css?v=34563353" rel="stylesheet" type="text/css" />
<div class="page-content">
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <form action="{{ route('surveyor.gis-id-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                @foreach($errors->all() as $error)
                                {{ $error }} <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (Session::has('success'))
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5>{!! Session::get('success') !!}</h5>
                            </div>
                        </div>
                    </div>
                    @endif

                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-9 le-pimg-o-body">
                        <div class="product d-flex justify-content-center shadow-sm rounded">
                            <a data-fancybox="gallery" class="w-100" href="https://survey.proper-t.co/public/uploads/property/images/64ec41c052cfc.jpg">
                                <img src="https://survey.proper-t.co/public/uploads/property/images/64ec41c052cfc.jpg" class="img-fluid le-pimg">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 ri-pimg-o-body" style="">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">
                                    <a data-fancybox="gallery" href="https://survey.proper-t.co/public/uploads/property/images/64ec41c071a67.jpg">
                                        <img src="https://survey.proper-t.co/public/uploads/property/images/64ec41c071a67.jpg" class="img-fluid ri-pimg">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="product shadow-sm rounded">
                                    <a data-fancybox="gallery" href="https://survey.proper-t.co/public/uploads/property/images/64ec41c11e02c.jpg">
                                        <img src="https://survey.proper-t.co/public/uploads/property/images/64ec41c11e02c.jpg" class="img-fluid ri-pimg">
                                    </a>
                                    <div class="InlinePhotoPreview--RightButtons">
                                        <button type="button" class="btn btn-outline-dark bg-light" id="photo-preview-button" tabindex="0">
                                            <span class="mdi mdi-image-multiple text-dark"></span>
                                            <span class="text-dark">4 photos</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="">
                            <div class="">
                                <div class="row ">
                                    <div class="keyDetailsList col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <span class="w-50">Latitude</span><strong class="px-1 ">:</strong>  17.4563197
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-50">Longitude</span><strong class="px-1 ">:</strong>  78.3728344
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="keyDetailsList col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <span class="w-50">GIS ID</span><strong class="px-1">:</strong>  15910422-de
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-50">Category of the property</span><strong class="px-1">:</strong>  Commercial
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h2 class="h4 inline-block heading-medium">About this Property</h2>
                                </div>
                                <div class="row ">
                                    <div class="keyDetailsList col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <span class="w-md-25">Building Name</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">House No</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Plot No</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Street Name/No/Road No</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Colony/Locality Name</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Owner Full Name</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Contact No</span><strong class="px-1 atp-title--seperator">:</strong>  N/A
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">No of Floors</span><strong class="px-1 atp-title--seperator">:</strong>  1
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="keyDetailsList col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <span class="w-md-25">Building Name</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">House No</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Plot No</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Street Name/No/Road No</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Colony/Locality Name</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Owner Full Name</span><strong class="px-1 atp-title--seperator">:</strong>  Design
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">Contact No</span><strong class="px-1 atp-title--seperator">:</strong>  N/A
                                            </li>
                                            <li class="list-group-item">
                                                <span class="w-md-25">No of Floors</span><strong class="px-1 atp-title--seperator">:</strong>  1
                                            </li>
                                        </ul>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12" id="view-blocks--floors" style="height:500px;">

                    </div>
                    <div class="col-sm-12 col-md-12" id="view-property-status" >

                    </div>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
   $(document).ready(function() {
    // Define an array of elements to track
    var elementsToTrack = ['#view-blocks--floors', '#view-property-status', '#element3']; // Add your element IDs here

    // Function to check if an element is in the viewport
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= $(window).height() &&
            rect.right <= $(window).width()
        );
    }

    // Function to handle the scroll event and check element visibility
    function handleScroll() {
        for (var i = 0; i < elementsToTrack.length; i++) {
            var element = $(elementsToTrack[i]);
            if(element.hasClass('data-cached') == false) {
                if (isElementInViewport(element[0])) {
                    // The element is visible on scroll
                    element.addClass('data-cached');
                    alert(`now element ${i} is visible and data-cached status is: ${element.hasClass('data-cached')}`)
                    // You can add any other actions you want to perform here
                }
            }
        }
    }

    // Add a scroll event listener to the window using jQuery
    $(window).on('scroll', handleScroll);
});

</script>
@endpush