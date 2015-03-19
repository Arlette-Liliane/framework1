/**
 * Created by aemebiku on 03/03/15.
 */
$(document).ready(function() {

    $(".delete").click(function(e) {
        var empId = $(this).attr("id");
        if (confirm("Are you sure, you want to delete data?")) {

            $.post(window.location.origin + "/Users/delete_users",
                {'empId': empId},
                function () {
                    alert("this data has been delete");
                    javascript:window.location.reload();

                });
        }

    })

})
