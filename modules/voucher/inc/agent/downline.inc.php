<style>
    ul
    {
        list-style-type: none;
    }
    
   table.treetable tbody tr td {
       font-size: 15px;
   }
</style>
<script type="text/javascript">
    //<![CDATA[
    $(function() {

        $('table.admin_table').each(function() {
            var currentPage = 0;
            var numPerPage = 20;
            var $table = $(this);
            $table.bind('repaginate', function() {
                $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
            });
            $table.trigger('repaginate');
            var numRows = $table.find('tbody tr').length;
            var numPages = Math.ceil(numRows / numPerPage);
            var $pager = $('<div class="paginate"></div>');
            for (var page = 0; page < numPages; page++) {
                $('<a href="javascript:void(0)" class="page-number"></a>').text(page + 1).bind('click', {
                    newPage: page
                }, function(event) {
                    currentPage = event.data['newPage'];
                    $table.trigger('repaginate');
                    $(this).addClass('active').siblings().removeClass('active');
                }).appendTo($pager).addClass('clickable');
            }
            $pager.insertBefore($table).find('span.page-number:first').addClass('active');
        });


        jQuery("#search_trigger").click(function(){
            $('#search_content').slideToggle();
        });
        $("#search").on("keyup", function() {
            var value = $(this).val();
            value=value.toLowerCase();
            $("#myTable tr").each(function(index) {
                if (index !== 0) {

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                }
            });
            var rowCount = $('#myTable >tbody >tr:visible').length;
            $('#total_res').text(rowCount);
        });
        $("#search").change(function() {
            var value = $(this).val();
            value=value.toLowerCase();
            $("#myTable tr").each(function(index) {
                if (index !== 0) {

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                }
            });
            var rowCount = $('#myTable >tbody >tr:visible').length;
            $('#total_res').text(rowCount);
        });

    });

    //]]>
</script>
<style>
    .paginate a.active{
        border: 1px solid #ddd;
        font-weight: bold;
        background-color: #ddd;
    }
    .paginate a{

    }
</style>
