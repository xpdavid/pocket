$(function() {
    // for datepicker
    try {

        $('#date').datetimepicker({
            format : 'yyyy-mm-dd',
            startView : 4,
            minView : 2,
            language : 'zh-CN',
            autoclose : true,
            todayBtn : true,

        });

        $("#organizations").select2({
            tags: true
        });

        $("#types").select2({
            tags: true
        });

        $("#locations").select2({
            tags: true
        });

        $("#tags").select2({
            tags: true
        });

        /**
         * For toggle noDateOption
         */
        if ($('#date').val() == '0000-00-00') {
            $('#noDateOption').click();
            $('#date').prop('readonly', true);
        }

        /**
         * toogle the no date option in the submit form
         * set the no date to 0000-00-00
         */
        var noDateOptionBackUp = moment().format('YYYY-MM-DD');
        $('#noDateOption').click(function() {
            if(this.checked) {
                noDateOptionBackUp = $('#date').val();
                $('#date').val('0000-00-00');
                $('#date').prop('readonly', true);
            } else {
                $('#date').prop('readonly', false);
                $('#date').val(noDateOptionBackUp);
            }
        });

    } catch (e) {

    }
});

