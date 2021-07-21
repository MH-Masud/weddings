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
                            <div class="card mb-g rounded-top">
                                <div class="row no-gutters row-grid">
                                    <div class="col-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                            <?php $images = json_decode($plan->image) ?>
                                            <img src="{{ asset('uploads/plan_image/'.$images[0]->thumb) }}" class="rounded-circle shadow-2 img-thumbnail" alt="{{ $plan->name }}" title="{{ $plan->name }}">
                                            <h5 class="mb-0 fw-700 text-center mt-3">
                                                {{ $plan->name }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-center py-3">
                                            <h5 class="mb-0 fw-700">
                                                {{ $plan->express_interest }} times
                                                <small class="text-muted mb-0">Express Interest</small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-center py-3">
                                            <h5 class="mb-0 fw-700">
                                                {{ $plan->direct_messages }} times
                                                <small class="text-muted mb-0">Direct Message</small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-center py-3">
                                            <h5 class="mb-0 fw-700">
                                                {{ $plan->photo_gallery }} times
                                                <small class="text-muted mb-0">Photo Gallery</small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="text-center py-3">
                                            <h5 class="mb-0 fw-700">
                                                {{ $plan->package_duration }} days
                                                <small class="text-muted mb-0">Package Duration</small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 text-center">
                                            <a href="{{ route('plan.index') }}" class="btn btn-dark">Package List</a>
                                            <a href="{{ route('plan.edit',$plan->id) }}" class="btn btn-info">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- this overlay is activated only when mobile menu is triggered -->
@endsection
