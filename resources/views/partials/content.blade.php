<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard ml-1"></i>لوحة التحكم </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-cube fa-3x"></i>
                <div class="info">
                    <h4>المنتجات</h4>
                    <p><b>{{ $totalProducts }}</b></p>
                </div>
            </div>
        </div>
        @role('Admin')
        <div class="col-md-6 col-xl-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4>المبيعات</h4>
                    <p><b>{{ $totalSales }}</b></p>
                </div>
            </div>
        </div>
        @endrole
        @role('Admin')
        <div class="col-md-6 col-xl-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-usd fa-3x"></i>
                <div class="info">
                    <h4>الدخل الصافي</h4>
                    <p><b>{{ $totalIncome }} درهم</b></p>
                </div>
            </div>
        </div>
        @endrole
        <div class="col-md-6 col-xl-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-file fa-3x"></i>
                <div class="info">
                    <h4>الفواتير</h4>
                    <p><b>{{ $totalInvoices }}</b></p>
                </div>
            </div>
        </div>
    </div>
    @role('Admin')
    <div class="row">
        <div class="col-xl-6">
            <div class="tile">
                <h3 class="tile-title">المبيعات الشهرية</h3>
                <div id="monthlySalesChart"></div>

            </div>
        </div>
        <div class="col-xl-6">
            <div class="tile">
                <h3 class="tile-title">أعلى 5 منتوجات مبيعًا</h3>
                <div id="topSalesChart"></div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="tile">
                <h3 class="tile-title">مبيعات اليوم مقارنةً مع مبيعات اليوم السابق</h3>
                <div id="sales_chart"></div>

            </div>
        </div>
        <div class="col-xl-6">
            <div class="tile">
                <h3 class="tile-title">مقارنة المبيعات</h3>
                <div id="weekSalesChart"></div>
            </div>
        </div>
    </div>
    @endrole
</main>

@push('js')
    <script type="text/javascript">
        function getArabicMonth(englishMonth) {
            const monthsInArabic = {
                "January": "يناير",
                "February": "فبراير",
                "March": "مارس",
                "April": "أبريل",
                "May": "مايو",
                "June": "يونيو",
                "July": "يوليو",
                "August": "أغسطس",
                "September": "سبتمبر",
                "October": "أكتوبر",
                "November": "نوفمبر",
                "December": "ديسمبر"
            };
            return monthsInArabic[englishMonth] || "Invalid month name";
        }

        // Sales per month
        const salesData = <?php echo json_encode($monthlySales); ?>;
        let months = salesData.map(element => getArabicMonth(element.month));
        let sales = salesData.map(element => element.total_amount);
        const options = {
            chart: {
                type: 'area',
                height: 350,
                fontFamily: 'Zain, sans-serif'
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'المبيعات',
                data: sales
            }],
            xaxis: {
                categories: months
            }
        }
        const salesChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
        salesChart.render();

        // Top 5 sales
        const top5SalesData = <?php echo json_encode($formattedTopSales); ?>;
        const labels = top5SalesData.map(item => item.productName);
        const series = top5SalesData.map(item => Number(item.totalSales));

        const options2 = {
            chart: {
                type: 'bar',
                height: 350,
                fontFamily: 'Zain, sans-serif'
            },
            series: [{
                name: 'مليعات',
                data: series
            }],
            xaxis: {
                categories: labels,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '70%',
                    distributed: true
                }
            },
            colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0'],
        };

        const top5Sales = new ApexCharts(document.querySelector("#topSalesChart"), options2);
        top5Sales.render();

        // Today Vs Yesterday Sales
        const yesterdaySales = <?php echo json_encode($yesterdaySales); ?>;
        const todaySales = <?php echo json_encode($todaySales); ?>;
        const options3 = {
            chart: {
                type: 'bar',
                height: 350,
                fontFamily: 'Zain, sans-serif'
            },
            series: [{
                name: 'المبيعات',
                data: [yesterdaySales, todaySales]
            }],
            xaxis: {
                categories: ['البارحة', 'اليوم']
            },
            colors: ['#008FFB', '#00E396'], // Optional: set colors for each bar
            plotOptions: {
                bar: {
                    distributed: true, // Different colors for each bar
                    borderRadius: 5
                }
            }
        };
        const todayVsYesterdayChart = new ApexCharts(document.querySelector("#sales_chart"), options3);
        todayVsYesterdayChart.render();

        // This Week Vs Last Week Sales
        const thisWeekSales = <?php echo json_encode($thisWeekSales); ?>;
        const lastWeekSales = <?php echo json_encode($lastWeekSales); ?>;

        // Chart options
        const options4 = {
            chart: {
                type: 'bar',
                height: 350,
                fontFamily: 'Zain, sans-serif'
            },
            series: [{
                name: 'المبيعات',
                data: [lastWeekSales, thisWeekSales]
            }],
            xaxis: {
                categories: ['الأسبوع السابق', 'هذا الأسبوع']
            },
            colors: ['#FF4560', '#775DD0'], // Optional: set colors for each bar
            plotOptions: {
                bar: {
                    distributed: true, // Different colors for each bar
                    borderRadius: 5
                }
            }
        };

        // Render the chart
        const thisWeekVsLastWeekSalesChart = new ApexCharts(document.querySelector("#weekSalesChart"),
            options4);
        thisWeekVsLastWeekSalesChart.render();
    </script>
@endpush
