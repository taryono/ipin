function pagination(element, page_rows) {
    $selector = $(element); 
    window.tp = new Pagination(page_rows, {
        itemsCount: $selector.length,
        pageSize: 10,
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            var start = paging.pageSize * (paging.currentPage - 1),
                    end = start + paging.pageSize,
                    $rows = $selector;
            $rows.hide();
            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}