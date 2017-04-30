$(function(){
    $("#data-table").bootgrid({
        css: {
            icon: 'zmdi icon',
            iconColumns: 'zmdi-view-module',
            iconDown: 'zmdi-expand-more',
            iconRefresh: 'zmdi-refresh',
            iconUp: 'zmdi-expand-less'
        },
        caseSensitive: false,
        formatters: {
            "commands": function(column, row) {
                return "<a class=\"btn btn-icon command-edit\" data-row-id=\"" + row.id + "\" href=\"/lecture/view/" + row.id + "\" title=\"View lecture profile\"><i class=\"zmdi zmdi-eye p-t-10\"></i></a> ";
            }
        }
    });
});