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
                            <form class="needs-validation" novalidate method="POST" action="{{ route('city.update',$city->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="name">Country <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <select name="country_id" id="country_id" class="select2 form-control" onchange="return onChangeCountry()" required>
                                                    <option value="">Choose one</option>
                                                    <?php
                                                    $countryId = DB::table('states')->where('id',$city->state_id)->value('country_id');
                                                    ?>
                                                    @foreach ($country as $coun)
                                                        <option <?php if($countryId == $coun->id){ ?> selected <?php } ?> value="{{ $coun->id }}">{{ $coun->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a country.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="name">State <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <select name="state_id" id="state_id" class="select2 form-control" required>
                                                    <?php $stateName = DB::table('states')->where('id',$city->state_id)->value('name'); ?>
                                                    <option value="{{ $city->state_id }}">{{ $stateName }}</option>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a state.
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="timezone" id="timezone" value="">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="name">City name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $city->name }}" placeholder="City name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a city name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="postal_code">Postal Code <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $city->postal_code }}" placeholder="Postal Code" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a postal code.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <a href="{{ route('city.index') }}" class="btn btn-dark">City List</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Update City</button>
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
    function onChangeCountry(){
        var countryId = $("#country_id").val();
        if(countryId){
            $.ajax({
                type: "GET",
                url: "{{ Session::get('api_base_url') }}states/"+countryId,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                },
                success: function(result){
                    var html = '<option value="">Choose one</option>';
                    result.forEach(state => {
                        html += '<option value="'+state.id+'">'+state.name+'</option>';
                    });
                    $("#state_id").html(html);
                }
            });
        }
    }
</script>
@endsection
