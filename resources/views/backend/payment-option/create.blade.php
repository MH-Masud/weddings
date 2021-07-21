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
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content p-0">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('payment-option.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="title">Title <span
                                                    class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ old('title') }}" placeholder="Card name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a title.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="desktop_image">Desktop Image <span
                                                    class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="uploadImage" name="desktop_image" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a desktop image.
                                                </div>
                                            </div>
                                            <br>
                                            <img class="d-none" id="upload_image" width="200" height="100" alt="image">
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="mobile_image">Mobile Image <span
                                                    class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="mobileImage" name="mobile_image" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a mobile image.
                                                </div>
                                            </div>
                                            <br>
                                            <img class="d-none" id="mobile_image" width="200" height="100" alt="image">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <a href="{{ route('payment-option.index') }}" class="btn btn-dark">Payment Option List</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Add Payment Option</button>
                                </div>
                            </form>
                            <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function() {
                                    'use strict';
                                    window.addEventListener('load', function() {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');
                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function(form) {
                                            form.addEventListener('submit', function(event) {
                                                if (form.checkValidity() === false) {
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
