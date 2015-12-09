<?php $this->load->view('login/components/page_head'); ?>

  <body>

  	<div id="wrapper">

                <!-- Sidebar -->
                <div id="sidebar-wrapper">
                    
					<?php $this->load->view($subview_2); ?>

                </div>
                <!-- /#sidebar-wrapper -->



                <!-- Page Content -->
                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12"> <!-- span12 -->

								<a href="#menu-toggle" class="icon-list" id="menu-toggle"></a>


                                <?php $this->load->view($subview);  //   ?>
                                
                                

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#page-content-wrapper -->

    </div>
<!-- /#wrapper -->

<?php $this->load->view('login/components/page_tail');  ?>
