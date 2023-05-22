<script>
    $(document).ready(function() {
        $('#tab_wanita').addClass('active_tab_catalog');
    });

    function select_tab(param) {
        if (param === 'pria') {
            $('#tab_pria').addClass('active_tab_catalog');
            $('#tab_wanita').removeClass('active_tab_catalog');
            $('#tab_anak').removeClass('active_tab_catalog');
        } else if (param === 'wanita') {
            $('#tab_pria').removeClass('active_tab_catalog');
            $('#tab_wanita').addClass('active_tab_catalog');
            $('#tab_anak').removeClass('active_tab_catalog');
        } else if (param === 'anak') {
            $('#tab_pria').removeClass('active_tab_catalog');
            $('#tab_wanita').removeClass('active_tab_catalog');
            $('#tab_anak').addClass('active_tab_catalog');
        }
    }
</script>
