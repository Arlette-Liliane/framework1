$(document).ready(function() {
    $('.updated').click(function(e) {

        $('#myModal').modal('show');
    });

    $("#updateuser").click(function(e) {

        var empId = $(this).attr("id");
        alert(empId);
        var name =  $("#name").val();

        var surname =  $("#surname").val();

        var email =  $("#email").val();

        var pass1 = $("#password").val();
        var pass2 = $("#password1").val();
        if (pass1 !== pass2)
        {
            alert("Error : the two passwords are not compatible")
        }
       else if(email=='' || name== '' || surname==''){

            alert("ERROR: ");
        }

        else {
            $.post(window.location.origin + "/Users/update_users",
                {'name':name, 'surname':surname,'email':email, 'pass':pass1, 'id': empId},
                function(){
                    $('#myModal').modal('hide');
                    alert("this data has been update");
                    javascript:window.location.reload();

                });
        }

    });


})
