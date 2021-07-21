@extends('backend.layout.app')
@section('title')
    {{$title}}
@endsection
@section('mainContent')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        <li class="breadcrumb-item">Home</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i><span class='fw-300'>Dashboard</span>
        </h1>
        {{-- <div class="d-flex mr-4">
            <div class="mr-2">
                <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#967bbd&quot;, &quot;#ccbfdf&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }">7/10</span>
            </div>
            <div>
                <label class="fs-sm mb-0 mt-2 mt-md-0">New Sessions</label>
                <h4 class="font-weight-bold mb-0">70.60%</h4>
            </div>
        </div>
        <div class="d-flex mr-0">
            <div class="mr-2">
                <span class="peity-donut" data-peity="{ &quot;fill&quot;: [&quot;#2196F3&quot;, &quot;#9acffa&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }">3/10</span>
            </div>
            <div>
                <label class="fs-sm mb-0 mt-2 mt-md-0">Page Views</label>
                <h4 class="font-weight-bold mb-0">14,134</h4>
            </div>
        </div> --}}
    </div>
    <h6>Members</h6>
    <div class="row">
        <div class="col-sm-3 col-xl-3">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php $totalMembers = DB::table('members')->get(); ?>
                        {{ number_format(count($totalMembers)) }}
                        <small class="m-0 l-h-n">Total Member</small>
                    </h3>
                </div>
                <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        <div class="col-sm-3 col-xl-3">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php $totalPaidMembers = DB::table('members')->where('membership',2)->get(); ?>
                        {{ number_format(count($totalPaidMembers)) }}
                        <small class="m-0 l-h-n">Premium Members</small>
                    </h3>
                </div>
                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-3 col-xl-3">
            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php $totalFreeMembers = DB::table('members')->where('membership',1)->get(); ?>
                        {{ number_format(count($totalFreeMembers)) }}
                        <small class="m-0 l-h-n">Free Members</small>
                    </h3>
                </div>
                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
            </div>
        </div>
        <div class="col-sm-3 col-xl-3">
            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php $totalBlockedMembers = DB::table('members')->where('is_blocked','yes')->get(); ?>
                        {{ number_format(count($totalBlockedMembers)) }}
                        <small class="m-0 l-h-n">Blocked Members</small>
                    </h3>
                </div>
                <i class="fal fa-user-times position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 8rem;"></i>
            </div>
        </div>
    </div>
    <h6>Earnings</h6>
    <div class="row">
        <div class="col-sm-4 col-xl-4">
            <div class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php $totalEarning = DB::table('payments')->sum('total'); ?>
                        {{ number_format($totalEarning,'2') }}
                        <small class="m-0 l-h-n">Total Earnings</small>
                    </h3>
                </div>
                <i class="fal fa-lira-sign position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="p-3 bg-danger-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php
                                $start = date('d-m-Y H:i:s', strtotime("-1 months"));
                                $end = date('Y-m-d');
                                $lastMonthEarning = DB::table('payments')
                                                    ->where('created_at', '>=', $start)
                                                    ->where('created_at', '<=', $end)
                                                    ->sum('total');
                        ?>
                        {{ number_format($lastMonthEarning) }}
                        <small class="m-0 l-h-n">Last Month</small>
                    </h3>
                </div>
                <i class="fal fa-lira-sign position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="p-3 bg-primary rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php
                                $start = date('d-m-Y H:i:s', strtotime("-3 months"));
                                $end = date('Y-m-d');
                                $lastThreeMonthEarning = DB::table('payments')
                                                    ->where('created_at', '>=', $start)
                                                    ->where('created_at', '<=', $end)
                                                    ->sum('total');
                        ?>
                        {{ number_format($lastThreeMonthEarning) }}
                        <small class="m-0 l-h-n">Last 3 Months</small>
                    </h3>
                </div>
                <i class="fal fa-lira-sign position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="p-3 bg-secondary rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php 
                                $start = date('d-m-Y H:i:s', strtotime("-6 months"));
                                $end = date('Y-m-d');
                                $halfYearlyEarning = DB::table('payments')
                                                    ->where('created_at', '>=', $start)
                                                    ->where('created_at', '<=', $end)
                                                    ->sum('total');
                        ?>
                        {{ number_format($halfYearlyEarning) }}
                        <small class="m-0 l-h-n">Half Yearly</small>
                    </h3>
                </div>
                <i class="fal fa-lira-sign position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 8rem;"></i>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="p-3 bg-warning rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        <?php 
                                $start = date('d-m-Y H:i:s', strtotime("-12 months"));
                                $end = date('Y-m-d');
                                $yearlyEarning = DB::table('payments')
                                                    ->where('created_at', '>=', $start)
                                                    ->where('created_at', '<=', $end)
                                                    ->sum('total');
                        ?>
                        {{ number_format($yearlyEarning) }}
                        <small class="m-0 l-h-n">Yearl</small>
                    </h3>
                </div>
                <i class="fal fa-lira-sign position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 8rem;"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-7" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Member <span class="fw-300"><i>Monthly</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        {{-- <div class="panel-tag">
                            An area chart or area graph displays graphically quantitative data. It is based on the line chart. The area between axis and line are commonly emphasized with colors, textures and hatchings
                        </div> --}}
                        <div id="areaChart">
                            <canvas style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div id="panel-8" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Sales <span class="fw-300"><i>Monthly</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        {{-- <div class="panel-tag">
                            A bar chart provides a way of showing data values represented as vertical bars. It is sometimes used to show trend data, and the comparison of multiple data sets side by side
                        </div> --}}
                        <div id="barChart">
                            <canvas style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- this overlay is activated only when mobile menu is triggered -->
@endsection
