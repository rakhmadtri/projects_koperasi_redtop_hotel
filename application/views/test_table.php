<!DOCTYPE html>
<html>
        <link href="<?php echo base_url();?>asset/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>asset/bootstrap/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url() ?>asset/bootstrap/assets/styles.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url() ?>asset/bootstrap/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url()?>asset/bootstrap/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
     <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Bootstrap dataTables with Toolbar</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                   <div class="table-toolbar">
                      <div class="btn-group">
                         <a href="#"><button class="btn btn-success">Add New <i class="icon-plus icon-white"></i></button></a>
                      </div>
                      <div class="btn-group pull-right">
                         <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                         <ul class="dropdown-menu">
                            <li><a href="#">Print</a></li>
                            <li><a href="#">Save as PDF</a></li>
                            <li><a href="#">Export to Excel</a></li>
                         </ul>
                      </div>
                   </div>            
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                            <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Trident</td>
                                    <td>Internet
                                         Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center"> 4</td>
                                    <td class="center">X</td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Trident</td>
                                    <td>Internet
                                         Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                                    <td class="center">C</td>
                                </tr>
                                <tr class="gradeU">
                                    <td>Other browsers</td>
                                    <td>All others</td>
                                    <td>-</td>
                                    <td class="center">-</td>
                                    <td class="center">U</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>asset/bootstrap/vendors/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url() ?>asset/bootstrap/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>asset/bootstrap/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>asset/bootstrap/assets/scripts.js"></script>
    <script src="<?php echo base_url() ?>asset/bootstrap/assets/DT_bootstrap.js"></script>
    <script>
    $(function() {
        
    });
    </script>
</html>