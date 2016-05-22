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


try {

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "language": "zh",
        "legend": {
            "useGraphSettings": true
        },
        "showAllValueLabels": true,
        "dataDateFormat": "YYYY-MM",
        "mouseWheelZoomEnabled":true,
        "dataProvider": [],
        "synchronizeGrid":true,
        "chartScrollbar": {
        },
        "valueAxes": [{
            "id": "v1",
            "axisAlpha": 0,
            "position": "left",
            "ignoreAxisWidth":true
        }],
        "graphs": [],
        "chartCursor": {
            "cursorPosition": "mouse"
        },
        "valueScrollbar":{
            "oppositeAxis":false,
            "offset":60,
            "scrollbarHeight":10
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "axisColor": "#DADADA",
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true,
            "position": "bottom-right"
        }
    });

    chart.addListener("dataUpdated", zoomChart);
    zoomChart();


    /***
     * Ajax request to sever to get data
     * @returns {Array}
     */

    function getData() {
        $.post('/admin/statistic/request', {
            'useFilter' : $('[name=useFilter]').prop('checked'),
            'date1' : $('[name="date1"]').val(),
            'date2' : $('[name="date2"]').val(),
            'organization_list' : $('[name="organization_list[]"]').val(),
            'location_list' : $('[name="location_list[]"]').val(),
            'type_list' : $('[name="type_list[]"]').val(),
            'tag_list' : $('[name="tag_list[]"]').val(),
            'mainAnalysis' : $('[name="mainAnalysis"]:checked').val()
        }, function(result) {
            try {
                console.log(result);
                if (result.status == 1) {
                    chart.graphs = result.graphSetting;
                    sortDateInArrayKey(result.data, 'date');
                    chart.dataProvider = result.data;
                    chart.validateData();
                } else {
                    throw "Error";
                }
            } catch(e) {
                swal("错误", "服务器数据返回错误.", "error");
            }
        }).fail(function () {
            swal("错误", "服务器提了一个问题", "error");
        });
    }

    function zoomChart(){
        chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);
    }

    function sortDateInArrayKey(array, key) {
        array.sort(function(a, b){
            var keyA = new Date(a[key]),
                keyB = new Date(b[key]);
            // Compare the 2 dates
            if(keyA < keyB) return -1;
            if(keyA > keyB) return 1;
            return 0;
        });
    }

} catch(e) {
    console.log("没有找到图表");
}

$( "[name=useFilter]" ).click(function() {
    $( "[name=mainAnalysisSpan]" ).toggle();
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


function generic_delete(type, id) {
    swal({
        title: "你确定要删除?",
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
            $.post('/admin/' + type + '/' + id, {
                '_method' : 'DELETE'
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
                    swal("错误", result.info, "error");
                }
            }).fail(function () {
                swal("错误", "服务器提了一个问题", "error");
            });
        } else {
            swal("取消操作", "没有删除, 放心吧", "error");
        }
    })
}
