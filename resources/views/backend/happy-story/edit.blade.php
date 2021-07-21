@extends('backend.layout.app')
@section('title')
    {{ $title }}
@endsection

@section('mainContent')
    <meta name="_token" content="{{ csrf_token() }}"/>
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
                            <form class="needs-validation" novalidate method="POST" action="{{ route('happy-story.update',$happyStory->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="posted_by">Member Name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <?php $memberName = DB::table('members')->where('id',$happyStory->posted_by)->select('first_name','last_name')->first(); ?>
                                                <input type="text" class="form-control" id="autocomplete" name="member_name" value="{{ $memberName->first_name.' '.$memberName->last_name }}" placeholder="Member name" required>
                                                <input type="hidden" class="form-control" id="selectuser_id" name="posted_by" value="{{ $happyStory->posted_by }}">
                                                <input type="hidden" class="form-control" id="timezone" name="timezone">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a member name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="partner_name">Partner Name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="partner_name" name="partner_name" value="{{ $happyStory->partner_name }}" placeholder="Partner name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a partner name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="title">Title <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $happyStory->title }}" placeholder="Title" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a title.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="description">Description <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <textarea name="description" id="description" class="form-control" placeholder="Description" required>{{ $happyStory->description }}</textarea>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a description.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="approval_status">Approval Status <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <select name="approval_status" id="approval_status" class="form-control" required>
                                                    <option <?php if($happyStory->approval_status == ''){ ?> selected <?php } ?> value="">Choose one</option>
                                                    <option <?php if($happyStory->approval_status == 'yes'){ ?> selected <?php } ?> value="yes">Yes</option>
                                                    <option <?php if($happyStory->approval_status == 'no'){ ?> selected <?php } ?> value="no">No</option>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a approval status.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="image1">Image 1 <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control" id="uploadImage" name="image1">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a image.
                                                </div>
                                            </div>
                                            <br>
                                            <?php $image1 = json_decode($happyStory->image1); ?>
                                            <img class="" src="{{ asset('uploads/happy_story_image/'.$image1[0]->thumb) }}" alt="image" id="upload_image" height="150" width="400">
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="image2">Image 2</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control" id="profile_image" name="image2">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a image.
                                                </div>
                                            </div>
                                            <br>
                                            <?php $image2 = json_decode($happyStory->image2); ?>
                                            @if ($image2)
                                            <img class="" src="{{ asset('uploads/happy_story_image/'.$image2[0]->thumb) }}" alt="image" id="showProfileImage" height="150" width="400">
                                            @else
                                            <img class="d-none" alt="image" id="showProfileImage" height="150" width="400">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <a href="{{ route('happy-story.index') }}" class="btn btn-dark">Happy Story List</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Add Happy Story</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $( "#autocomplete" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: '{{ env("BASE_API_URL") }}member-info',
                    type: 'post',
                    data: {
                        'search': request.term
                    },
                    headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function( data ) {
                        if(data){
                            data = JSON.parse(data)
                            response( data );
                        }
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.label);
                $('#selectuser_id').val(ui.item.value);
                return false;
            },
            focus: function(event, ui){
                $( "#autocomplete" ).val( ui.item.label );
                $( "#selectuser_id" ).val( ui.item.value );
                return false;
            },
        });
        </script>
@endsection
