

<?php

 echo '<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Update data!</h4>
        </div>
        <div class="modal-body">


            <div class="form-group">
                <label>name</label>';
                echo form_input([
                'class'       => 'form-control',
                'id'          => 'names',
                'name'        => 'name',
                'placeholder' => 'name',
                'value'       => $up->name
                ]);
                echo form_error('name');
                echo '</div>
            <div class="form-group">
                <label>Surname</label>';
                echo form_input([
                'class'       => 'form-control',
                'id'          => 'surnames',
                'name'        => 'surname',
                'placeholder' => 'surname',
                'value'       =>$up->surname
                ]);

                echo ' </div>

            <div class="form-group">
                <label>Email</label>';
                echo form_input([
                'class'       => 'form-control',
                'id'          => 'emails',
                'name'        => 'email',
                'placeholder' => 'email',
                'value'       => $up->email
                ]);

            echo '</div>
                <div class="form-group">
                <select name="mygroups" class="form-control" id="mygroups">';
                echo '<option></option>';
                foreach($gr as $g)
                {
                    if ($g["name"] == "Public"){

                        echo '<option>Admin</option>';
                    }

                    else if ($g["name"] == "Default") {

                        echo '<option>Public</option>';

                    }

                }
                echo ' </select>
                    </div>';
                echo '<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" name="submit" class="btn btn-primary btn-large" id="updateusers">Update</button>
            </div>
        </div>
    </div>
</div>';

?>

<script>
    $("#updateusers").click(function(e) {

        var id = '<?php echo $up->id; ?>';

        var name =  $("#names").val();

        var surname =  $("#surnames").val();

        var email =  $("#emails").val();

        var groups = $("#mygroups").val();

        if(email=='' || name== '' || surname==''){

            alert("ERROR: You have one or more errors in your form "+name+surname+email);
        }

        else {
            $.post(window.location.origin + "/Users/update_users",
                {'name':name, 'surname':surname,'email':email, 'id': id, 'groups': groups},
                function(){
                    $('#myModal2').modal('hide');
                    alert("this data has been update");
                    javascript:window.location.reload();

                });
        }

    });
</script>