<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once( __DIR__ . '/include/head.php' ); ?>
</head>
  <body>
  <?php require_once( __DIR__ . '/include/header.php' ); ?>
   <?php require_once( __DIR__ . '/include/sidebar.php' ); ?>
     <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                          
                            <div class="col-xl-3 col-md-3">
                                <!-- card -->
                                <div class="card card-h-100 card-box">
                                    <!-- card body -->
                                    <div class="card-body color-cornflowerblue">
                                        <div class="row align-items-center">
										<a href="<?php echo base_url('admin/Dashboard/guidepal_register'); ?>" data-key="t-login">
                                            <div class="col-8">
											
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate dash-box-text">Guide registration</span>
                                                
												<h4 class="mb-3">
                                                    <span class="counter" data-target=""><?=$total_guidepal_register;?></span>
                                                </h4>
                                            </div>
										</a>
                                            <div class="col-3">
                                                <!--<div class=" mb-2"><i class="dripicons-list iconcss"></i></div>-->
                                            </div>
                                        </div>
                                        <!--<div class="text-nowrap" style="display: flex;
    justify-content: space-between;">
                                           
                                            <span class="ms-1 text-muted font-size-13">Services content</span>
                                            
                                             <div class="action-button text-right">
                                            
                                            <a href="<?php echo base_url('/admin/Dashboard/services'); ?>" class="btn  btn-sm btn-soft-primary waves-effect waves-light">View details</a>
                                            
                                        </div>
                                        </div>-->
                                       
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-3 col-md-3">
                                <!-- card -->
                                <div class="card card-h-100 card-box">
                                    <!-- card body -->
                                    <div class="card-body color-cornflowerblue">
                                        <div class="row align-items-center">
										<a href="<?php echo base_url('admin/Dashboard/user_register'); ?>" data-key="t-login">
                                            <div class="col-8">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate dash-box-text">User registration</span>
                                                <h4 class="mb-3">
                                                    <span class="counter" data-target=""><?=$total_user_register;?></span>
                                                </h4>
                                            </div>
										</a>
                                            <div class="col-3">
                                                <!--<div class=" mb-2"><i class="dripicons-blog iconcss"></i></div>-->
                                            </div>
                                        </div>
                                        <!--<div class="text-nowrap" style="display: flex;
    justify-content: space-between;">
                                           
                                            <span class="ms-1 text-muted font-size-13">Feature content</span>
                                            
                                             <div class="action-button text-right">
                                            
                                            <a href="<?php echo base_url('/admin/Dashboard/features'); ?>" class="btn  btn-sm btn-soft-primary waves-effect waves-light">View details</a>
                                            
                                        </div>
                                        </div>-->
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->
        
                            <div class="col-xl-3 col-md-3">
                                <!-- card -->
                                <div class="card card-h-100 card-box">
                                    <!-- card body -->
                                    <div class="card-body color-cornflowerblue">
                                        <div class="row align-items-center">
										<a href="<?php echo base_url('admin/Dashboard/rent_friend'); ?>" data-key="t-login">
                                            <div class="col-8">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate dash-box-text">Rent as a friend</span>
                                                <h4 class="mb-3">
                                                    <span class="counter" data-target=""><?=$total_rent_friend_register;?></span>
                                                </h4>
                                            </div>
										</a>
                                            <div class="col-3">
                                                <!--<div class=" mb-2"><i class="dripicons-blog iconcss"></i></div>-->
                                            </div>
                                        </div>
                                        <!--<div class="text-nowrap" style="display: flex;
    justify-content: space-between;">
                                           
                                            <span class="ms-1 text-muted font-size-13">Feature content</span>
                                            
                                             <div class="action-button text-right">
                                            
                                            <a href="<?php echo base_url('/admin/Dashboard/features'); ?>" class="btn  btn-sm btn-soft-primary waves-effect waves-light">View details</a>
                                            
                                        </div>
                                        </div>-->
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->
        	                


				    </div>
				    
				    <div class="row">
				       <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">User</h6>
                                <select class="form-select" id="userType" style="width:22%;height:35px">
                                  <option value="">Select User</option>    
                                  <option value="perday">Per Day</option>
                                  <option value="permonth">Per Month</option>
                                  <option value="peryear">Per Year</option>
                                </select>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="user"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="revenue"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Bookings</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="bookings"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Guide</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="guide"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Rent a friend </h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="rent_a_friend"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->    
				    </div>
				    
					<!-- container-fluid -->
                </div>
                <!-- End Page-content -->


            <!-- footer -->
             <?php require_once( __DIR__ . '/include/footer.php' ); ?>
            <!-- footer End -->
            </div>
            <!-- end main content-->
  
  
  <!-- end  -->
    <?php require_once( __DIR__ . '/include/include-bottom.php' ); ?>


<script>
    $(document).ready(function(){
     $.ajax({
        url:"<?php echo base_url();?>admin/Dashboard/users_data",
        method:"POST",
        async: true,
        dataType:"JSON",
        success:function(users)
        {
            //console.log(perday);
            usersInfo(users);
        }
    });
    });
</script>

<script>
    // user
  function usersInfo(usersInfo){  
    var tot = usersInfo.total.map(Number)
    var ctx1 = $("#user").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: usersInfo.perdate,
            datasets: [{
                    label: "User",
                    data: tot,
                    backgroundColor: "rgba(98, 147, 233, .7)"
                },
            ]
            },
        options: {
            responsive: true
        }
    });
  }
    
    // Revenue Chart
    var ctx2 = $("#revenue").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [ /* {
                  label: "Salse",
                    data: [15, 30, 55, 45, 70, 65, 85],
                    backgroundColor: "rgba(235, 22, 22, .7)",
                    fill: true
                },*/
                {
                    label: "Revenue",
                    data: [99, 135, 170, 130, 190, 180, 270],
                    backgroundColor: "rgba(98, 147, 233, .7)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });
    
    // Bookings Chart
    var ctx2 = $("#bookings").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [ /* {
                  label: "Salse",
                    data: [15, 30, 55, 45, 70, 65, 85],
                    backgroundColor: "rgba(235, 22, 22, .7)",
                    fill: true
                },*/
                {
                    label: "Bookings",
                    data: [99, 135, 170, 130, 190, 180, 270],
                    backgroundColor: "rgba(98, 147, 233, .7)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });
    
    // Guide Chart
    var ctx2 = $("#guide").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [ /* {
                  label: "Salse",
                    data: [15, 30, 55, 45, 70, 65, 85],
                    backgroundColor: "rgba(235, 22, 22, .7)",
                    fill: true
                },*/
                {
                    label: "Bookings",
                    data: [99, 135, 170, 130, 190, 180, 270],
                    backgroundColor: "rgba(98, 147, 233, .7)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });
    
    // Guide Chart
    var ctx2 = $("#rent_a_friend").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [ /* {
                  label: "Salse",
                    data: [15, 30, 55, 45, 70, 65, 85],
                    backgroundColor: "rgba(235, 22, 22, .7)",
                    fill: true
                },*/
                {
                    label: "Bookings",
                    data: [99, 135, 170, 130, 190, 180, 270],
                    backgroundColor: "rgba(98, 147, 233, .7)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });
</script>

<script>
$(document).ready(function(){
    $('#userType').change(function(){
        var userview = $(this).val();
        //console.log(userview);
        if(userview != '')
        {
            usersInfo(userview);
        }
    });
});
</script>


	</body>