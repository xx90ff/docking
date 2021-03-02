define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'push_log/index' + location.search,
                    add_url: 'push_log/add',
                    edit_url: 'push_log/edit',
                    del_url: 'push_log/del',
                    multi_url: 'push_log/multi',
                    import_url: 'push_log/import',
                    table: 'push_log',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'push_type', title: __('Push_type'), searchList: {"create":__('Push_type create'),"paid":__('Push_type paid'),"success":__('Push_type success')}, formatter: Table.api.formatter.normal},
                        {field: 'trigger_time', title: __('Trigger_time'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'sync_status', title: __('Sync_status'), searchList: {"0":__('Sync_status 0'),"1":__('Sync_status 1')}, formatter: Table.api.formatter.status},
                        {field: 'sync_time', title: __('Sync_time'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});