@extends('backend.layout.app')
@section('title')
    {{ $title }}
@endsection

@section('mainContent')
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">{{ $menu }}</li>
            <li class="breadcrumb-item active">{{ $title }}</li>
            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-5" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            {{ $title }}
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content p-0">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('how-we-work.update',$howWeWork->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PATCH")
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="icon">Icon Image<span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-image fs-xl"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="uploadImage" name="image">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a icon.
                                                </div>
                                            </div>
                                            <br>
                                            <?php $howWeWorkIcon = json_decode($howWeWork->image); ?>
                                            <img src="{{ asset('uploads/how_we_work/'.$howWeWorkIcon[0]->image) }}" alt="image" id="upload_image" height="24" width="24">
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-cube fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $howWeWork->title }}" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a title.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-12">
                                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-cube fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{ $howWeWork->description }}" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a description.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <button class="btn btn-primary ml-auto" type="submit">Update How We Work</button>
                                </div>
                            </form>
                            <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function()
                                {
                                    'use strict';
                                    window.addEventListener('load', function()
                                    {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');
                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function(form)
                                        {
                                            form.addEventListener('submit', function(event)
                                            {
                                                if (form.checkValidity() === false)
                                                {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();

                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- this overlay is activated only when mobile menu is triggered -->
@endsection
