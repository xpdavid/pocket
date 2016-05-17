$(function() {
    // for datepicker
    try {
        $('#date').datetimepicker({
            format : 'yyyy-mm',
            startView : 3,
            minView : 3,
            language : 'zh-CN'
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


    } catch (e) {

    }
});