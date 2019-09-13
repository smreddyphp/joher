  
   <!--<script src="http://www.jqplot.com/src/jquery.jqplot.js"></script>
   <script src="http://www.jqplot.com/src/plugins/jqplot.pieRenderer.js"></script>
   <script src="http://www.jqplot.com/examples/syntaxhighlighter/scripts/shCore.min.js"></script>
   <script src="http://www.jqplot.com/src/plugins/jqplot.categoryAxisRenderer.js"></script>
   <script src="http://www.jqplot.com/src/plugins/jqplot.pointLabels.js"></script>   
   <link rel="stylesheet" type="text/css" href="http://www.jqplot.com/src/jquery.jqplot.css" />-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php 
        $can=0;$close=0;$open=0;$bill=0;$ongoing=0;$personal=0;
        //print_r($hotel_status);
        foreach($trip_status as $trip_status)
        {
          if(@$trip_status->status_b == 'Cancelled')
          {
              $can++;
          }
          else if(@$trip_status->status_b == 'Closed')
          {
            $close++;
          }
          else if(@$trip_status->status_b == 'Open')
          {
            $open++;
          }
          else if(@$trip_status->status_b == 'Billing')
          {
            $bill++;
          }
          else if(@$trip_status->status_b == 'Ongoing')
          {
            $ongoing++;
          }
          else if(@$trip_status->status_b == 'Personal')
          {
            $personal++;
          }
        }

  ?>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() 
      {
            var data = google.visualization.arrayToDataTable([
                ['Trips',  'Cancelled'],
                ['Closed',   <?=$close?>],  
                ['Cancelled',<?=$can?>],
                ['Open',     <?=$open?>],
                ['Billing',  <?=$bill?>],
                ['Ongoing',  <?=$ongoing?>],
                ['Personal',  <?=$personal?>]
            ]);

        var options = {
          title: 'Status By Trip',
           is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    <?php 
        $can=0;$close=0;

        //print_r($hotel_status);
        foreach($hotel_status as $hstatus)
        {
          if(@$hstatus->status_b == 'Cancelled')
          {

              $can++;
          }
          else if(@$hstatus->status_b == 'Closed')
          {
            $close++;
          }
        }

  ?>

  <?php 
        $t_can=0;$t_close=0;
        //print_r($hotel_status);
        foreach($train_status as $train_status)
        {
          if(@$train_status->status_b == 'Cancelled')
          {
              $t_can++;
          }
          else if(@$train_status->status_b == 'Closed')
          {
            $t_close++;
          }
        }
  ?>

  <?php 
        $craft_can=0;$craft_close=0;
        //print_r($hotel_status);
        foreach($craft_status as $craft_status)
        {
          if(@$craft_status->status_b == 'Cancelled')
          {
              $craft_can++;
          }
          else if(@$craft_status->status_b == 'Closed')
          {
            $craft_close++;
          }
        }
  ?>

  <?php 
        $driver_can=0;$driver_close=0;
        //print_r($hotel_status);
        foreach($driver_status as $driver_status)
        {
          if(@$driver_status->status_b == 'Cancelled')
          {
              $driver_can++;
          }
          else if(@$driver_status->status_b == 'Closed')
          {
            $driver_close++;
          }
        }
  ?>

  <?php 
        $boat_can=0;$boat_close=0;
        //print_r($hotel_status);
        foreach($boat_status as $boat_status)
        {
          if(@$boat_status->status_b == 'Cancelled')
          {
              $boat_can++;
          }
          else if(@$boat_status->status_b == 'Closed')
          {
            $boat_close++;
          }
        }
  ?>
   
   <?php 
        $company_can=0;$company_close=0;
        //print_r($hotel_status);
        foreach($company_status as $company_status)
        {
          if(@$company_status->status_b == 'Cancelled')
          {
              $company_can++;
          }
          else if(@$company_status->status_b == 'Closed')
          {
            $company_close++;
          }
        }
  ?>
  <?php 
          $cruise_can=0;$cruise_close=0;
          //print_r($hotel_status);
          foreach($cruise_status as $cruise_status)
          {
            if(@$cruise_status->status_b == 'Cancelled')
            {
                $cruise_can++;
            }
            else if(@$cruise_status->status_b == 'Closed')
            {
              $cruise_close++;
            }
          }
    ?>
    <?php 
          $cargo_can=0;$cargo_close=0;
          //print_r($hotel_status);
          foreach($cargo_status as $cargo_status)
          {
            if(@$cargo_status->status_b == 'Cancelled')
            {
                $cargo_can++;
            }
            else if(@$cargo_status->status_b == 'Closed')
            {
              $cargo_close++;
            }
          }
    ?>
    <?php 
          $event_can=0;$event_close=0;
          //print_r($hotel_status);
          foreach($event_status as $event_status)
          {
            if(@$event_status->status_b == 'Cancelled')
            {
                $event_can++;
            }
            else if(@$event_status->status_b == 'Closed')
            {
              $event_close++;
            }
          }
    ?>
    <?php 
          $miscellaneous_can=0;$miscellaneous_close=0;
          //print_r($hotel_status);
          foreach($miscellaneous_status as $miscellaneous_status)
          {
            if(@$miscellaneous_status->status_b == 'Cancelled')
            {
                $miscellaneous_can++;
            }
            else if(@$miscellaneous_status->status_b == 'Closed')
            {
              $miscellaneous_close++;
            }
          }
    ?>

   <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart1);

          function drawChart1()
          {
            var data = google.visualization.arrayToDataTable([
             ['Service', 'Cancelled', 'Closed'],
              ['Hotel', <?=$can?>, <?=$close?>],
              ['Air/Train', <?=$t_can?>, <?=$t_close?>],
              ['Aircraft',<?=$craft_can?>,<?=$craft_close?>],
              ['Car/Driver/Security',<?=$driver_can?>,<?=$driver_close?>],
              ['Boat', <?=$boat_can?>,<?=$boat_close?>],
              ['Company Fees', <?=$company_can?>,<?=$company_close?>],
              ['Cruise', <?=$cruise_can?>,<?=$cruise_close?>],
              ['Cargo Package',<?=$cargo_can?>,<?=$cargo_close?>],
              ['Events', <?=$event_can?>,<?=$event_close?>],
              ['Miscellaneous',<?=$miscellaneous_can?>,<?=$miscellaneous_close?>]
            ]);
    
            var options = {
              chart: {
                title: 'Status By Services',
                //subtitle: 'Sales, Expenses, and Profit: 2014-2017',
              },
              bars: 'vertical', // Required for Material Bar Charts horizontal .
              hAxis: {format: 'decimal'},
              width: 350,
              height: 250,
              bar: {groupWidth: "80%"},
              colors: ['#1b9e77', '#d95f02']
            };
    
            var chart = new google.charts.Bar(document.getElementById('chart_div'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
            /*var btns = document.getElementById('btn-group');
            btns.onclick = function (e) 
            {
              if (e.target.tagName === 'BUTTON') 
              {
                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                chart.draw(data, google.charts.Bar.convertOptions(options));
              }
            }*/
          }
   </script>
   
   <script type="text/javascript">
         /*   google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart2);

          function drawChart2() {
            var data1 = google.visualization.arrayToDataTable([
              ['Year', 'Sales'],
              ['2014', 1000],
              ['2015', 1170],
              ['2016', 660],
              ['2017', 1030]
            ]);
    
            var options1 = {
              chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
              },
              bars: 'vertical', // Required for Material Bar Charts horizontal .
              hAxis: {format: 'decimal'},
              height: 250,
              colors: ['#1b9e77', '#d95f02', '#7570b3']
            };
    
            var chart1 = new google.charts.Bar(document.getElementById('chart_div2'));
    
            chart1.draw(data1, google.charts.Bar.convertOptions(options1));
    
            var btns = document.getElementById('btn-group');
    
            btns.onclick = function (e) {
              if (e.target.tagName === 'BUTTON') {
                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                chart.draw(data, google.charts.Bar.convertOptions(options));
              }
            }
          }*/
   </script>
    <?php
      foreach($trip_names as $name)
      {
           //@$value .= "[".$name['user_name'].',';
            
           @$value1 .= "['".$name["to"]."', ".$name["total_trip"]."],";
      }
       echo @$value1 = rtrim($value1);
   ?>
   
   <script>
            google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAnnotations);

function drawAnnotations() {
      var data = google.visualization.arrayToDataTable([        
        ['City', 'Total Trips'],
        <?=$value1?>
        
       /* ['New York City, NY', 8175000],
        ['Los Angeles, CA', 3792000],
        ['Chicago, IL', 2695000],
        ['Houston, TX', 2099000],
        ['Philadelphia, PA', 1526000]*/
      ]);

    /* var data = google.visualization.arrayToDataTable([
        ['City', '2010 Population', {type: 'string', role: 'annotation'}],
        ['New York City, NY', 8175000, '8.1M'],
        ['Los Angeles, CA', 3792000, '3.8M'],
        ['Chicago, IL', 2695000, '2.7M'],
        ['Houston, TX', 2099000, '2.1M'],
        ['Philadelphia, PA', 1526000, '1.5M']
      ]);
    */
    
      var options = {
        title: 'Destination',
        chartArea: {width: '50%'},
        annotations: {
          alwaysOutside: true,
          textStyle: {
            fontSize: 12,
            auraColor: 'none',
            color: '#555'
          },
          boxStyle: {
            stroke: '#ccc',
            strokeWidth: 1,
            gradient: {
              color1: '#f3e5f5',
              //color2: '#f3e5f5',
              x1: '0%', 
              y1: '0%'
              //x2: '100%', 
              //y2: '100%'
            }
          }
        },
        hAxis: {
          title: 'Total Destination Trips',
          minValue: 0,
        },
        vAxis: {
          title: 'City'
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById('chart_div4'));
      chart.draw(data, options);
    }
   </script>
   <?php
      foreach($client_names as $name)
      {
           //@$value .= "[".$name['user_name'].',';
            
            $res1 = $this->db->where('user_id',$name['user_id'])->get('trip')->result_array();
            $res1 = sizeof($res1);
           @$value .= '["'.$name['user_name'].'", '.$res1.', "#b87333"],';
      }
        @$value = rtrim($value);
   ?>
   
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Trips", { role: "style" } ],
        <?=$value?>  

      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Trip By Client",
        width: 250,
        height: 500,
        bar: {groupWidth: "90%"},
        bars: 'vertical',
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  

   </script>
   
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
                        <div class="sales-primary" style = "padding: 2px;">
                            <img src="<?php echo base_url(); ?>assets/images/individual_logo2.png">
                            <div class="f-right">
                                <h2 class="counter"><?php echo @$trip_count[0]->trip;?></h2>
                             <!-- <span>Individual Professional</span>-->
                            </div>
                        </div>
                       <div class="bg-dark-primary">
                            <p class="week-sales">Trips</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-success dashboard-success">
                        <div class="sales-success" style = "padding: 2px;">
                            <img src="<?php echo base_url(); ?>assets/images/auto_shop.png">
                            <div class="f-right">
                                <h2 class="counter">10<?php //echo @$users_count['autoshop']; ?></h2>
                            </div>
                        </div>
                        <div class="bg-dark-success">
                            <p class="week-sales">Services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-warning dasboard-warning">
                        <div class="sales-warning" style = "padding: 2px;">
                            <img src="<?php echo base_url(); ?>assets/images/scrap_shop.png">
                            <div class="f-right">
                                <h2 class="counter"><?php echo @$city_count[0]->city; ?></h2>
                            </div>
                        </div>
                       <div class="bg-dark-warning">
                            <p class="week-sales">Destination-city</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="bg-facebook dashboard-facebook">
                        <div class="sales-facebook" style = "padding: 2px;">
                            <img src="<?php echo base_url(); ?>assets/images/user2.png">
                            <div class="f-right">
                               <h2 class="counter"><?php echo @$users_count['users']; ?></h2>
                            </div>
                        </div>
                        <div class="bg-dark-facebook">
                            <p class="week-sales">Clients</p>
                            <!--<p class="total-sales">432</p>-->
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- end of col-lg-3 -->
                <!-- start col-lg-9 -->
                <div class="col-xl-12 col-lg-12">
                    <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                </div>
                
                <div class="col-xl-12 col-lg-12">
                        <div id="" class = "col-xl-9 col-lg-9" style = "margin-top: 25px">
                          <div class="row menublock-list">
                          <div class="col-sm-4 menulist"> 
                            <strong style="color:#240eef;">Services </strong>
                     <ul>                    
                      <li><a href = "<?php echo base_url()?>admin/hotel">Hotel</a></li>
                      <li><a href = "<?php echo base_url()?>admin/air_train">Air/Train</a></li>
                      <li><a href = "<?php echo base_url()?>admin/aircraft">Aircraft</a></li>
                      <li><a href = "<?php echo base_url()?>admin/car_driver_security">Car/Driver/Security</a></li>
                      <li><a href = "<?php echo base_url()?>admin/boat">Boat</a></li>
                      <li><a href = "<?php echo base_url()?>admin/company_fees">Company Fees</a>
                      </li>
                      <li><a href = "<?php echo base_url()?>admin/cruise">Cruise</a></li>
                      <li><a href = "<?php echo base_url()?>admin/cargo_package">Cargo Package</a></li>
                      <li><a href = "<?php echo base_url()?>admin/crm_event">Events</a></li>
                      <li><a href = "<?php echo base_url()?>admin/miscellaneous">Miscellaneous</a></li>
                    </ul>  
                  </div>
                    <div class="col-sm-4 menulist"> 
                     <strong style="color: #aa0de2;">Status</strong>   
                      <ul> 
                     <li><a href=" ">Billing</a></li>
                     <li><a href=" ">Cancelled</a></li> 
                     <li><a href=" ">Closed</a></li>
                     <li><a href=" ">Ongoing</a></li>
                     <li><a href=" ">Open</a></li>
                     <li><a href=" ">Personal</a></li>
                    </ul>
                   </div>
                  <div class="col-sm-4 menulist"> 
                    <strong style="color: #d12912;">Client's Name</strong> 
                    <ul>
                      <?php foreach($client_names as $name)
                      {
                        ?>
                        <?php $id = $this->uri->segment(3); ?>
                        <li><a href = "<?php echo base_url()?>/admin/client_trip/<?=$name['user_id']?>"><?php echo $name['user_name'];?></a></li>
                      <?php }?>
                    </ul> 
                  </div>
                   </div>
                        </div>
                        <div id="" class = "col-xl-3 col-lg-3 mt-lg">                           
                            <div id="barchart_values" style="width: 250px; height: 500px;"></div>
                        </div>                        
                        <div id="" class = "col-xl-12 col-lg-12 charts-block">
                           <div class = "row" style = "background-color: white;border-style: solid;
                                        border-color: #c629288c; margin-top:20px; padding:15px;">
                                <div class = "col-xl-7 col-lg-7">
                                    <p>
                                        Time Line Work in Excle 2013 or higher. Do Not Move or resize
                                    </p>
                                </div>
                                <div class = "col-xl-5 col-lg-5">
                                    <p>
                                        Time Line Works in Excle 2013 or Higher.Do Not Move or resize
                                    </p>
                                </div>
                            </div>
                            <br/>
                            <div class = "row chart-block">
                                <div class = "col-xl-6 col-lg-6">
                                   <div class="chart-bg">
                                    <!--<span id = "chart1"></span>-->
                                     
                             <script src="https://code.highcharts.com/highcharts.js"></script>       
                            <div id="customer_age" style="height: 200px;">
                           <script>
                               var chart = Highcharts.chart('customer_age',{

                                   title: {
                                       text: ''
                                   },

                                   subtitle: {
                                       text: 'Services'
                                   },

                                   xAxis: {
                                       categories: ['Hotel', 'Air/Train', 'Aircraft', 'Car/Driver/Security','Boat','Company Fees','Cruise','Cargo Package','Events','Miscellaneous'],
                                       /*title: {
                                           text: 'Services'
                                       }*/
                                   },
                                   yAxis: {

                                           title: {
                                               //text: 'No. of customers'
                                           },
                                   },

                                   series: [{
                                       name:"Services",
                                       type: 'column',
                                       colorByPoint: true,
                                       data: [<?php echo @$hotel[0]->hotel;?>,<?php echo @$train[0]->train;?>,<?php echo @$craft[0]->craft;?>,<?php echo @$driver[0]->driver;?>,<?php echo @$boat[0]->boat;?>,<?php echo @$company[0]->company;?>,<?php echo @$cruise[0]->cruise;?>,<?php echo @$cargo[0]->cargo;?>,<?php echo @$event[0]->event;?>,<?php echo @$miscellaneous[0]->miscellaneous;?>],
                                       showInLegend: true
                                   }]

                               });


                               $('#plain').click(function () {
                                   chart.update({
                                       chart: {
                                           inverted: false,
                                           polar: false
                                       },
                                       subtitle: {
                                           text: 'Plain'
                                       }
                                   });
                               });

                               $('#inverted').click(function () {
                                   chart.update({
                                       chart: {
                                           inverted: true,
                                           polar: false
                                       },
                                       subtitle: {
                                           text: 'Inverted'
                                       }
                                   });
                               });

                               $('#polar').click(function () {
                                   chart.update({
                                       chart: {
                                           inverted: false,
                                           polar: true
                                       },
                                       subtitle: {
                                           text: 'Polar'
                                       }
                                   });
                               });
                           </script>
                          </div>
                                  </div>   
                                     
                                </div>
                                <div class = "col-xl-6 col-lg-6">  
                                 <div class="chart-bg">
                                      <div id="chart_div4"></div>
                                </div>
                                </div>   
                                <div class = "col-xl-6 col-lg-6">
                                    <div class="chart-bg mb-no">
                                    <!--<span id = "chart2"></span>-->
                                     <div id="chart_div"></div>
                                </div>
                                <div class="table-chart">
                                    <table class="table table-bordered table-responsive">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Hotel</th>
      <th scope="col">Air/Train</th>
      <th scope="col">Air craft</th>
      <th scope="col">Car/Driver/Security</th>
      <th scope="col">Boat</th>
      <th scope="col">Company Fees</th>
      <th scope="col">Cruise</th>
      <th scope="col">Cargo Package</th>
      <th scope="col">Events</th>
      <th scope="col">Miscellaneous</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Cancelled</th>      

      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('hotel_vila_apartment')->result());  ?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('air_train')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('air_craft')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('driver_security')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('boat')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('company_fees')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('cruise')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('cargo')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('crm_event')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Cancelled')->get('miscellaneous')->result());?></td>
    </tr>
    <tr>
      <th scope="row">Closed</th>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('hotel_vila_apartment')->result());  ?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('air_train')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('air_craft')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('driver_security')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('boat')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('company_fees')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('cruise')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('cargo')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('crm_event')->result());?></td>
      <td><?php echo count($this->db->select('status_b')->where('status_b','Closed')->get('miscellaneous')->result());?></td>
    </tr>
  </tbody>
</table>
</div>
</div>
<div class = "col-xl-6 col-lg-6">
  <div class="chart-bg">
   <!-- <span id = "pie1" style = "position: absolute;left: 0px;top: 0px;width: 250px;height:300px;"></span>-->
   <strong>Status by Trip </strong>
   <div id="piechart" style="width: 250px; height: 250px;"></div>
 </div>
</div>
</div>

</div>
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
        name: 'Trip',
        marker: {
            symbol: 'square'
        },
        data: [<?php echo @$graph_trip; ?>]
    }, /*{
        name: 'Services',
        marker: {
            symbol: 'diamond'
        },
        data: [<?php echo 10; ?>] 
      },*/
        {
        name: 'Destination-city',
        marker: {
            symbol: 'triangle'
        },
        data: [<?php echo @$graph_auto; ?>]    },{
        name: 'Clients',
        marker: {
            symbol: 'triangle-down'
        },
        data: [<?php echo @$graph_scrap; ?>]    }]
});
</script>

<script>
$(document).ready(function(){
    
             ////////////////
            var plot1 = $.jqplot('pie1', [[['a',25],['b',14],['c',7]]], {
                gridPadding: {top:0, bottom:38, left:0, right:0},
                seriesDefaults:{
                    renderer:$.jqplot.PieRenderer, 
                    trendline:{ show:false }, 
                    rendererOptions: { padding: 8, showDataLabels: true }
                },
                legend:{
                    show:true, 
                    placement: 'outside', 
                    rendererOptions: {
                        numberRows: 1
                    }, 
                    location:'s',
                    marginTop: '15px'
                }       
            });
        /////////////////
     
        
    });
</script>

<style>
    .mt-lg { margin-top:25px; }
    .menublock-list {
    background: #fff;
    padding: 17px 0;
}
    .menulist li a {
    background: #f5f5f5;
    border-bottom: 1px solid #ecebeb;
    padding: 10px 10px;
    display:block;
}
    .menulist li a:hover  {
    background: #c62928;
    color:#fff;
}
.menulist strong {
    color: #c62928 !important;
    text-transform: uppercase;
    margin-bottom: 16px;
    display: block;
}
.menulist ul {
    height: 429px;
    overflow-y: auto;
}
.menulist li a { color: #8c8c8c; }
.charts-block { min-height:450px; }
.chart-block .col-lg-3 {
    background: #fff;
    height: 270px;
    border-right: 1px solid #ccc;
}
.chart-bg {
    padding-top: 15px;
    background: #fff;
    margin-bottom: 20px;
}
#chart_div div , #piechart , #piechart div { 
    width: 100% !important; text-align:center; }
    .chart-block { min-height:580px; }
    .table-chart {
    background: #fff;
}
.mb-no { margin-bottom:0 !important; }
.table-chart {
    border-top: 1px solid #ddd;
}
</style>

