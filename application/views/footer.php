

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url(); ?>assets/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?= base_url(); ?>assets/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="<?= base_url(); ?>assets/js/demo.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <script src="<?= base_url(); ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

     <script type="text/javascript">  
    function showToast(from, align, payload_message, color){
                                $.notify({
                                    icon: "notifications",
                                    message: payload_message

                                },{
                                    type: color,
                                    timer: 3000,
                                    placement: {
                                        from: from,
                                        align: align
                                    }})
                            } 
    </script>

    <script type="text/javascript">
        $(".media-heading").each(function () {
            text = $(this).text();
            if (text.length > 100) {
                $(this).html(text.substr(0, 100) + '...');
            }
        });
        $(".small2 > a.elipsis").click(function (e) {
            e.preventDefault(); //prevent '#' from being added to the url
            $(this).prev('span.elipsis').fadeToggle(500);
        });

        function showToast(from, align, payload_message, color){
                                $.notify({
                                    icon: "notifications",
                                    message: payload_message

                                },{
                                    type: color,
                                    timer: 3000,
                                    placement: {
                                        from: from,
                                        align: align
                                    }})
                            } 
    </script>

</body>

</html>