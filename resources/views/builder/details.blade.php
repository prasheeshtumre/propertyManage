@extends('admin.layouts.main')
@section('content')
<style>
    .titleView {
        color: #662e93;
        font-size: 28px;
        font-weight: 600;
        font-style: italic;
    }

    .viewbuider label {
        margin-bottom: 0.5rem;
        font-size: 14px;
        color: #c1c1c1;
    }

    .viewbuider p {
        font-size: 14px;
        font-weight: 400;

    }

    .viewbuider a {
        /*color: #9b60cb !important;*/
        text-decoration: underline;
    }

    .subHead {
        font-size: 16px;
        font-weight: 600;
    }

    .relianceheader {
        background: #fff3e4;
        padding: 2rem;
        box-shadow: 0 1px 2px rgba(56, 65, 74, .15) !important;
        border-radius: 3px 3px 0px 0px !important;
    }

    .cardViewBuilder {
        border-radius: 0px 0px 3px 3px !important;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                <h4 class="mb-sm-0"> BUILDER DETAILS</h4>
            </div>
        </div>
        <div class="text-center relianceheader">
            <img src="{{asset('uploads/builders/'.$builder->group_logo)}}" class="img-fluid" style="    width: 150px;">
            <h4 class="titleView">{{$builder->name}}</h4>
        </div>
        <div class="card cardViewBuilder">
            <div class="card-body">
                <div class="row viewbuider">
                    <div class="col-md-4 ">
                        <div class="form-group mb-3">
                            <label>Builder Group Name</label>
                            <p>{{$builder->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Builder Group Address</label>
                            <p>{{$builder->address}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Builder Group Website</label>

                            <p><a href="{{$builder->website ?? ''}}">{{$builder->website}}</a> </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Builder Group Mail ID</label>
                            <p>
                                <a href="mailto:{{$builder->mail ?? ''}}">{{$builder->mail ?? ''}}</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Builder Group Contact No</label>
                            <p><a href="tel:{{$builder->contact_no ?? ''}}">{{$builder->contact_no ?? ''}}</a></p>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group mb-3">
                            <h4 class="subHead">Builder Group Social Media Connect</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Linked In</label>
                            <p>
                                <a href="{{$builder->linked_in ?? ''}}"> {{$builder->linked_in ?? ''}}</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Facebook</label>
                            <p>
                                <a href="{{$builder->facebook ?? ''}}"> {{$builder->facebook ?? ''}}</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Twitter</label>
                            <p>
                                <a href="{{$builder->twitter ?? ''}}">  {{$builder->twitter ?? ''}}</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Youtube</label>
                            <p>
                                <a href="{{$builder->youtube ?? ''}}"> {{$builder->youtube ?? ''}}</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group mb-3">
                            <h4 class="subHead"> Sub-Group Names</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            @forelse($builder->sub_groups as $sub_group)
                                <p>
                                    {{$sub_group->name ?? ''}}
                                </p>
                            @empty 
                                <p>
                                    No Sub-Groups Found.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
            <a class="btn btn-secondary" href="{{url('admin/builder/edit', $builder->id)}}"> 
            Edit
                        </a>
            </div>
        </div>

    </div>
</div>
@endsection