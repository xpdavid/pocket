var search_table;

$(function() {
    try {
        // set csrf_token
        $.ajaxPrefilter(function(options, originalOptions, xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
            }
        });

        // for datepicker
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

        /**
         * For search page nodateoption and select date plugin
         */
        $('#noDateOptionSearch').click(function() {
            if(this.checked) {
                $('#date1').val('0000-00-00');
                $('#date2').val('0000-00-00');
                $('#date1').prop('readonly', true);
                $('#date2').prop('readonly', true);
            } else {
                $('#date1').prop('readonly', false);
                $('#date2').prop('readonly', false);
                $('#date1').val(noDateOptionBackUp);
                $('#date2').val(noDateOptionBackUp);
            }
        });

        $('#date1').datetimepicker({
            format : 'yyyy-mm-dd',
            startView : 4,
            minView : 2,
            language : 'zh-CN',
            autoclose : true,
            todayBtn : true,

        });
        $('#date2').datetimepicker({
            format : 'yyyy-mm-dd',
            startView : 4,
            minView : 2,
            language : 'zh-CN',
            autoclose : true,
            todayBtn : true,

        });



        // for fancybox
        /* This is basic - uses default settings */

        $("a#single_image").fancybox();


        search_table = $('#search_results').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                url : "/admin/pocket/search",
                type : "POST",
                data : function(d) {
                    d.name = $('[name="name"]').val();
                    d.date1 = $('[name="date1"]').val();
                    d.date2 = $('[name="date2"]').val();
                    d.organization_list = $('[name="organization_list[]"]').val();
                    d.location_list = $('[name="location_list[]"]').val();
                    d.type_list = $('[name="type_list[]"]').val();
                    d.tag_list = $('[name="tag_list[]"]').val();

                }
            },
            "language" : {
                "url" : "/DataTables/Chinese.json"
            }
        } );

        // for admin manage tag/organization/locations/tags table
        var all_manage = [
            'tag',
            'organization',
            'location',
            'type'
        ];
        $.each(all_manage, function(index, value) {
            try{
                $('#' + value + '_table').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        url : "/admin/" + value + "/index",
                        type : "POST"
                    },
                    "language" : {
                        "url" : "/DataTables/Chinese.json"
                    }
                } );
            } catch (e) {

            }
        });
        

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
            $.post('/admin/pocket-upload/delete', {
                'id' : id
            }, function(result) {
                console.log(result);
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
