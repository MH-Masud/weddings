@extends('backend.layout.app')
@section('title')
    {{ $title }}
@endsection
@section('mainContent')
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">{{ $menu }}</li>
            <li class="breadcrumb-item active">{{ $title }}</li>
            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
        </ol>
        <div class="subheader">
            <h1 class="subheader-title">
                <a href="{{ route('happy-story.create')}}" class="edit btn btn-success btn-md">Add New Happy Story</a>
            </h1>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class='subheader-icon fal fa-table'></i>{{ $title }}
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="happy_story_list" class="table table-bordered table-hover table-striped w-100">
                                <thead class="bg-primary-600">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Member Name</th>
                                        <th>Partner Name</th>
                                        <th>Approval Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Member Name</th>
                                        <th>Partner Name</th>
                                        <th>Approval Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- this overlay is activated only when mobile menu is triggered -->
    <script>
        function publish_story(id){
            Swal.fire(
        {
            title: "Are you sure?",
            text: "You want to publish this story!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, publish it!"
        }).then(function(result)
        {
            if (result.value)
            {
                $.ajax({
                    type: "GET",
                    url: '{{ env("BASE_API_URL") }}publish-story/'+id,
                    headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                    },
                    success: function(result){
                        if (result == true)
                        {
                            Swal.fire("Published!", "This story is published.", "success");
                        }location.reload();
                    },
                });
            }else{
                event.preventDefault();
            }
        });
        }
        function unpublish_story(id){
            Swal.fire(
        {
            title: "Are you sure?",
            text: "You want to unpublish this memeber!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, unpublish it!"
        }).then(function(result)
        {
            if (result.value)
            {
                $.ajax({
                    type: "GET",
                    url: '{{ env("BASE_API_URL") }}unpublish-story/'+id,
                    headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                    },
                    success: function(result){
                        if (result == true)
                        {
                            Swal.fire("Unpublished!", "This story is unpublished.", "success");
                        }location.reload();
                    },
                });
            }else{
                event.preventDefault();
            }
        });
        }
    </script>
@endsection
