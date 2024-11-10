<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="text-white page-title-icon bg-gradient-primary me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i
                        class="align-middle mdi mdi-alert-circle-outline icon-sm text-primary"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="text-white card bg-gradient-danger card-img-holder">
                <div class="card-body">
                    <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="mb-3 font-weight-normal">Weekly Sales <i
                            class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">${{ number_format($weeklySales, 2) }}</h2>
                    <h6 class="card-text">Increased by 60%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="text-white card bg-gradient-info card-img-holder">
                <div class="card-body">
                    <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="mb-3 font-weight-normal">Weekly Orders <i
                            class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ number_format($weeklyOrders) }}</h2>
                    <h6 class="card-text">Decreased by 10%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="text-white card bg-gradient-success card-img-holder">
                <div class="card-body">
                    <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="mb-3 font-weight-normal">Visitors  <i
                            class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ number_format($visitors) }}</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="card-title float-start">Visit And Sales Statistics</h4>
                        <div id="visit-sale-chart-legend"
                            class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="traffic-chart"></canvas>
                    </div>
                    <div id="traffic-chart-legend"
                        class="pt-4 rounded-legend legend-vertical legend-bottom-left"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Tickets</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Assignee </th>
                                    <th> Subject </th>
                                    <th> Status </th>
                                    <th> Last Update </th>
                                    <th> Tracking ID </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/admin/images/faces/face1.jpg') }}" class="me-2"
                                            alt="image"> David Grey
                                    </td>
                                    <td> Fund is not received </td>
                                    <td>
                                        <label class="badge badge-gradient-success">DONE</label>
                                    </td>
                                    <td> Dec 5, 2017 </td>
                                    <td> WD-12345 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/admin/images/faces/face2.jpg') }}" class="me-2"
                                            alt="image"> Stella Johnson
                                    </td>
                                    <td> High loading time </td>
                                    <td>
                                        <label class="badge badge-gradient-warning">PROGRESS</label>
                                    </td>
                                    <td> Dec 12, 2017 </td>
                                    <td> WD-12346 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/admin/images/faces/face3.jpg') }}" class="me-2"
                                            alt="image"> Marina Michel
                                    </td>
                                    <td> Website down for one week </td>
                                    <td>
                                        <label class="badge badge-gradient-info">ON HOLD</label>
                                    </td>
                                    <td> Dec 16, 2017 </td>
                                    <td> WD-12347 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('assets/admin/images/faces/face4.jpg') }}" class="me-2"
                                            alt="image"> John Doe
                                    </td>
                                    <td> Losing control on server </td>
                                    <td>
                                        <label class="badge badge-gradient-danger">REJECTED</label>
                                    </td>
                                    <td> Dec 3, 2017 </td>
                                    <td> WD-12348 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="p-0 card-body d-flex">
                    <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Updates</h4>
                    <div class="d-flex">
                        <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                            <i class="mdi mdi-account-outline icon-sm me-2"></i>
                            <span>jack Menqu</span>
                        </div>
                        <div class="d-flex align-items-center text-muted font-weight-light">
                            <i class="mdi mdi-clock icon-sm me-2"></i>
                            <span>October 3rd, 2018</span>
                        </div>
                    </div>
                    <div class="mt-3 row">
                        <div class="col-6 pe-1">
                            <img src="{{ asset('assets/admin/images/dashboard/img_1.jpg') }}"
                                class="mb-2 rounded mw-100 w-100" alt="image">
                            <img src="{{ asset('assets/admin/images/dashboard/img_4.jpg') }}" class="rounded mw-100 w-100"
                                alt="image">
                        </div>
                        <div class="col-6 ps-1">
                            <img src="{{ asset('assets/admin/images/dashboard/img_2.jpg') }}"
                                class="mb-2 rounded mw-100 w-100" alt="image">
                            <img src="{{ asset('assets/admin/images/dashboard/img_3.jpg') }}" class="rounded mw-100 w-100"
                                alt="image">
                        </div>
                    </div>
                    <div class="mt-5 d-flex align-items-top">
                        <img src="{{ asset('assets/admin/images/faces/face3.jpg') }}" class="img-sm rounded-circle me-3"
                            alt="image">
                        <div class="flex-grow mb-0">
                            <h5 class="mb-2 me-2">School Website - Authentication Module.</h5>
                            <p class="mb-0 font-weight-light">It is a long established fact that a
                                reader will be distracted by the readable content of a page.</p>
                        </div>
                        <div class="ms-auto">
                            <i class="mdi mdi-heart-outline text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
