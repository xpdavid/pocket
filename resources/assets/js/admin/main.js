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


        // for fancybox
        /* This is basic - uses default settings */

        $("a#single_image").fancybox();
        

    } catch (e) {

    }
});


function deletePocketUploadById(id) {
    swal({
        title: "你确定要删除这个附件?",
        text: "请注意,删除将无法恢复!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "删吧",
        cancelButtonText: "不, 等等",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            $.post('/admin/pocket/upload/delete', {
                'id' : id
            }, function(result) {
                if (result.status == 1) {
                    swal({
                        title: 'Success',
                        text: '已经删除',
                        type: 'success'
                    }, function() {
                        location.reload();
                    });
                } else {
                    swal("错误", "服务器提了一个问题.", "error");
                }
            }).fail(function () {
                swal("错误", "服务器提了一个问题", "error");
            });
        } else {
            swal("取消操作", "没有删除, 放心吧", "error");
        }
    })
}
