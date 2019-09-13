    <!-- Sidebar chat end-->
    <div class="content-wrapper">

        <!-- Container-fluid starts -->
        <!-- Main content starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <h4>Dashboard</h4>
                </div>
            </div>
            <!-- 4-blocks row start -->
            <div class="row m-b-30 dashboard-header">
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-primary bg-primary">
                        <div class="sales-primary">
                        
                            <img src="<?php echo base_url(); ?>assets/images/individual_logo2.png">
                            <div class="f-right">
                                <h2 class="counter"><?php echo @$users_count['individual']; ?></h2>
                             <!-- <span>Individual Professional</span>-->
                            </div>
                        </div>
                       <div class="bg-dark-primary">
                            <p class="week-sales">Individual Professional</p>
                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-success dashboard-success">
                        <div class="sales-success">
                            <img src="<?php echo base_url(); ?>assets/images/auto_shop.png">
                            <div class="f-right">
                                <h2 class="counter"><?php echo @$users_count['autoshop']; ?></h2>
                            </div>
                        </div>
                        <div class="bg-dark-success">
                            <p class="week-sales">Autoshop Repairs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-warning dasboard-warning">
                        <div class="sales-warning">
                            <img src="<?php echo base_url(); ?>assets/images/scrap_shop.png">
                            <div class="f-right">
                                <h2 class="counter"><?php echo @$users_count['scrapshop']; ?></h2>
                            </div>
                        </div>
                       <div class="bg-dark-warning">
                            <p class="week-sales">Scrap Shops</p>
                  
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-facebook dashboard-facebook">
                        <div class="sales-facebook">
                            <img src="<?php echo base_url(); ?>assets/images/user2.png">
                            <div class="f-right">
                               <h2 class="counter"><?php echo @$users_count['users']; ?></h2>
                            </div>
                        </div>
                        <div class="bg-dark-facebook">
                            <p class="week-sales">Users</p>
                            <!--<p class="total-sales">432</p>-->
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- end of col-lg-3 -->
                <!-- start col-lg-9 -->
                <div class="col-xl-12 col-lg-12">
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
           
            
        </div>
        <!-- Main content ends -->



        <!-- Container-fluid ends -->
    </div>
</div>
<script>
         Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Monthwise Registrations'
    },
    subtitle: {
        text: 'FULL DETAILS OF ALL USERS'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: ''
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Users',
        marker: {
            symbol: 'square'
        },
        data: [<?php echo @$graph_users; ?>]
    }, {
        name: 'Individual Professional',
        marker: {
            symbol: 'diamond'
        },
        data: [<?php echo @$graph_indi; ?>]    },{
        name: 'Auto Shops',
        marker: {
            symbol: 'triangle'
        },
        data: [<?php echo @$graph_auto; ?>]    },{
        name: 'Scrap Shops',
        marker: {
            symbol: 'triangle-down'
        },
        data: [<?php echo @$graph_scrap; ?>]    }]
});
</script>
