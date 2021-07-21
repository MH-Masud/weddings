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
                            <form class="needs-validation" novalidate method="POST" action="{{ route('footer-link.update',$footerLink->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="name">Page Name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" onkeyup="return createSlug()" id="name" name="name" value="{{ $footerLink->name }}" placeholder="Page name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a page name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="slug">Slug <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $footerLink->slug }}" placeholder="Slug" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a slug.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="parent">Parent </label>
                                            <div class="input-group">
                                                <select name="parent" id="parent" class="select2 form-control">
                                                    <option <?php if($footerLink->parent == ''){ ?> selected <?php } ?> value="">No Parent</option>
                                                    @foreach ($parents as $parent)
                                                        <option <?php if($footerLink->parent == $parent->id){ ?> selected <?php } ?> value="{{ $parent->id }}">{{ $parent->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a parent.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="short_description">Short Description </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <textarea name="short_description" id="short_description" class="form-control" placeholder="Short description">{{ $footerLink->short_description }}</textarea>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a short description.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="image">Background Image </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="uploadImage" name="image">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a image.
                                                </div>
                                            </div>
                                            <br>
                                            <?php $image = json_decode($footerLink->image); ?>
                                            @if ($image)
                                            <img src="{{ asset('uploads/footer_link_image/'.$image[0]->thumb) }}" alt="image" id="upload_image" width="200" height="100">
                                            @else
                                            <img class="d-none" alt="image" id="upload_image" width="200" height="100">
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-12 mb-12">
                                            <label class="form-label" for="long_description">Long Description </label>
                                            <div class="input-group">
                                                <textarea name="long_description" class="js-summernote" id="saveToLocal">{{ $footerLink->long_description }}</textarea>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a long description.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <a href="{{ route('footer-link.index') }}" class="btn btn-dark">Page List</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Update Page</button>
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
    <script>
        const createSlug = () => {
            const name = $("#name").val();
            const filter = name.replace(/[^a-zA-Z ]/g, "");
            const slug = filter.replace(/\s+/g, '-');
            $("#slug").val(slug.toLowerCase());
        }
    </script>
@endsection
