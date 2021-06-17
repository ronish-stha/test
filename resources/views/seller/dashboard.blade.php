@extends('seller.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.css"
          integrity="sha512-V0+DPzYyLzIiMiWCg3nNdY+NyIiK9bED/T1xNBj08CaIUyK3sXRpB26OUCIzujMevxY9TRJFHQIxTwgzb0jVLg=="
          crossorigin="anonymous"/>
    <style>
        .ct-label {
            font-size: 11px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            @if (Auth::user()->status && Auth::user()->verified)
                <div class="row">
                    <a href="{{ route('category.index') }}">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">view_list</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Categories</p>
                                    <h3 class="card-title">{{ count($categories) }}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('products.index') }}">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="purple">
                                    <i class="material-icons">shopping_basket</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Products</p>
                                    <h3 class="card-title">{{ count($products) }}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('sales.index') }}">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="rose">
                                    <i class="material-icons">credit_card</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Sales</p>
                                    <h3 class="card-title">{{ count($sales) }}</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @else
            @endif
            <div class="row">
                    {{--<div class="col-md-6">
                        <div class="card">
                            <div class="ct-chart" id="productSalesChart" data-background-color="rose">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="ct-chart" id="salesDateChart" data-background-color="green">
                            </div>
                        </div>
                    </div>--}}
                     <div class="col-md-6">
                         <div class="card card-chart">
                             <div class="card-header" data-background-color="green" data-header-animation="true">
                                 <div class="ct-chart" id="productSalesChart">
                                 </div>
                             </div>
                             <div class="card-content">
                                 <h4 class="card-title">Product Sales</h4>
                                 <p class="category">Quantity</p>
                             </div>
                             <div class="card-footer">
                                 <div class="stats">
                                     <i class="material-icons">stacked_bar_chart</i> Quantity sold per Product
                                 </div>
                             </div>

                         </div>
                     </div>

                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header" data-background-color="rose" data-header-animation="true">
                                <div class="ct-chart" id="salesDateChart">
                                </div>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Sales Amount</h4>
                                <p class="category">Month</p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">money</i> Sales per month
                                </div>
                            </div>

                        </div>
                    </div>

                {{--<div class="col-md-4">
                    <div class="card card-chart" data-count="13">
                        <div class="card-header" data-background-color="green" data-header-animation="true">
                            <div class="ct-chart" id="salesDateChart">
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-actions">
                                <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                </button>

                                <button type="button" class="btn btn-info btn-simple" rel="tooltip"
                                        data-placement="bottom" title="" data-original-title="Refresh">
                                    <i class="material-icons">refresh</i>
                                </button>
                                <button type="button" class="btn btn-default btn-simple" rel="tooltip"
                                        data-placement="bottom" title="" data-original-title="Change Date">
                                    <i class="material-icons">edit</i>
                                </button>
                            </div>

                            <h4 class="card-title">Daily Sales</h4>
                            <p class="category"><span class="text-success"><i
                                        class="fa fa-long-arrow-up"></i> 55%  </span> increase in today sales.</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated 4 minutes ago
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-chart" data-count="7">
                        <div class="card-header" data-background-color="blue" data-header-animation="true">
                            <div class="ct-chart" id="completedTasksChart">
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-actions">
                                <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                </button>

                                <button type="button" class="btn btn-info btn-simple" rel="tooltip"
                                        data-placement="bottom" title="" data-original-title="Refresh">
                                    <i class="material-icons">refresh</i>
                                </button>
                                <button type="button" class="btn btn-default btn-simple" rel="tooltip"
                                        data-placement="bottom" title="" data-original-title="Change Date">
                                    <i class="material-icons">edit</i>
                                </button>
                            </div>

                            <h4 class="card-title">Completed Tasks</h4>
                            <p class="category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> campaign sent 2 days ago
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js"
            integrity="sha512-9rxMbTkN9JcgG5euudGbdIbhFZ7KGyAuVomdQDI9qXfPply9BJh0iqA7E/moLCatH2JD4xBGHwV6ezBkCpnjRQ=="
            crossorigin="anonymous"></script>
    <script>
        let status = {{ Auth::user()->verified }};
        let orderDetailsCount = {{ $orderDetailsCount }};
        $(document).ready(function () {
            // if (orderDetailsCount) {
                product = <?php echo json_encode($productArray); ?>;
                quantity = <?php echo json_encode($quantityArray); ?>;
                sales = <?php echo json_encode($sales); ?>;
                months = <?php echo json_encode($months); ?>;
                monthsName = <?php echo json_encode($monthsName); ?>;
                maxSales = {{ $maxSales }}
                max = {{ $max }} + 1;

                var dataProductSalesChart = {
                    labels: product,
                    series: [
                        quantity
                    ]
                };

                var optionsProductSalesChart = {
                    axisX: {
                        showGrid: false
                    },
                    height: 400,
                    width: 700,
                    low: 0,
                    high: max,
                    chartPadding: {top: 0, right: 5, bottom: 0, left: 0},
                    seriesBarDistance: 1,
                };

                var responsiveOptions = [
                    ['screen and (max-width: 640px)', {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                return value[0];
                            }
                        }
                    }]
                ];

                var productSalesChart = Chartist.Bar('#productSalesChart', dataProductSalesChart, optionsProductSalesChart, responsiveOptions);

                //start animation for the Emails Subscription Chart
                md.startAnimationForBarChart(productSalesChart);
            // }

            dataSalesDateChart = {
                labels: monthsName,
                series: [
                    sales
                ]
            };

            optionsSalesDateChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: maxSales, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
                height: 400,
                width: 700,
            }

            var salesDateChart = new Chartist.Line('#salesDateChart', dataSalesDateChart, optionsSalesDateChart);

            // var animationHeaderChart = new Chartist.Line('#productSalesChart', dataSalesDateChart, optionsSalesDateChart);

            if (!status)
                $('#welcomeModal').modal('show');
        })
    </script>
@endsection
