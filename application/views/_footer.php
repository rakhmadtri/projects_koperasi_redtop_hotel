            <footer>
                <p>&copy; CV jayabaru</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="<?php echo base_url()?>asset/bootstrap/vendors/jquery-ui-1.10.3.js"></script>

        <link href="<?php echo base_url() ?>asset/bootstrap/vendors/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url()?>asset/bootstrap/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="<?php echo base_url()?>asset/bootstrap/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url()?>asset/bootstrap/vendors/uniform.default.css" rel="stylesheet" media="screen">


        <link href="<?php echo base_url()?>asset/bootstrap/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

         <script src="<?php echo base_url()?>asset/bootstrap/vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url()?>asset/bootstrap/vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url()?>asset/bootstrap/vendors/bootstrap-datepicker.js"></script>

        <script src="<?php echo base_url()?>asset/bootstrap/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
        <script src="<?php echo base_url()?>asset/bootstrap/vendors/bootstrap-wysihtml5/lib/js/bbootstrap-wysihtml5-0.0.2.js"></script>

        <script src="<?php echo base_url()?>asset/bootstrap/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url()?>asset/bootstrap/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>asset/bootstrap/assets/form-validation.js"></script>
        <script>

    jQuery(document).ready(function() {   
       FormValidation.init();
    });
    

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            // $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>