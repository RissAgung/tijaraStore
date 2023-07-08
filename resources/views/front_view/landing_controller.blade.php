<script>
    $(document).ready(function() {
        $('#tab_wanita').addClass('active_tab_catalog');
    });

    const select_tab = (param) => {
        if (param === 'pria') {
            $('#containerPria').removeClass('hidden');
            $('#containerWanita').addClass('hidden');
            $('#containerAnak').addClass('hidden');

            $('#tab_pria').addClass('active_tab_catalog');
            $('#tab_wanita').removeClass('active_tab_catalog');
            $('#tab_anak').removeClass('active_tab_catalog');
        } else if (param === 'wanita') {
            $('#containerPria').addClass('hidden');
            $('#containerWanita').removeClass('hidden');
            $('#containerAnak').addClass('hidden');

            $('#tab_pria').removeClass('active_tab_catalog');
            $('#tab_wanita').addClass('active_tab_catalog');
            $('#tab_anak').removeClass('active_tab_catalog');
        } else if (param === 'anak') {
            $('#containerPria').addClass('hidden');
            $('#containerWanita').addClass('hidden');
            $('#containerAnak').removeClass('hidden');

            $('#tab_pria').removeClass('active_tab_catalog');
            $('#tab_wanita').removeClass('active_tab_catalog');
            $('#tab_anak').addClass('active_tab_catalog');
        }
    }
</script>
