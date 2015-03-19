<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Users
                    <strong>Settings</strong>
                </h2>
                <hr>


                <table class="table table-hover">


                    <?php
                    if ($this->aauth->is_loggedin() && $this->aauth->get_user()) {
                        echo '<tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                             <th>Groups</th>
                            <th>Commands</th>
                        </tr>';

                        echo '<tr>';
                        echo '<td>' . $pro->name . '</td>';
                        echo '<td>' . $pro->surname . '</td>';
                        echo '<td>' . $pro->email . '</td>';
                        $groups = $this->aauth->get_user_groups($pro->id);
                        echo '<td>';
                        foreach ($groups as $g) {
                            echo $g["name"] . ' ';
                        }
                        echo '</td>';

                        echo '<td id="' . $pro->id . '"><a id="' . $pro->id . '" class="delete" href="#"><button class="btn btn-danger" title="delete file">Delete</button></a>
                                <a id="' . $pro->id . '" class="updated" href="#"><button class="btn btn-success" title="update file">Update</button></a>

                                </td>';
                        echo '</tr>';
                        // Modal
                        echo ' <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            'class' => 'form-control',
                            'id' => 'name',
                            'name' => 'name',
                            'placeholder' => 'name',
                            'value' => $pro->name
                        ]);
                        echo form_error('name');
                        echo '</div>
                                <div class="form-group">
                                    <label>Surname</label>';
                        echo form_input([
                            'class' => 'form-control',
                            'id' => 'surname',
                            'name' => 'surname',
                            'placeholder' => 'surname',
                            'value' => $pro->surname
                        ]);

                        echo ' </div>

                                <div class="form-group">
                                    <label>Email</label>';
                        echo form_input([
                            'class' => 'form-control',
                            'id' => 'email',
                            'name' => 'email',
                            'placeholder' => 'email',
                            'value' => $pro->email
                        ]);
                        echo ' </div>

                                <div class="form-group">
                                    <label>New Password</label>';
                        echo form_input([
                            'class' => 'form-control',
                            'type' => 'password',
                            'id' => 'password',
                            'name' => 'password',
                            'placeholder' => 'password',

                        ]);
                        echo ' </div>
                                 <div class="form-group">
                                 <label>Confirm Password</label>';
                        echo form_input([
                            'class' => 'form-control',
                            'type' => 'password',
                            'id' => 'password1',
                            'name' => 'password1',
                            'placeholder' => 'password1',

                        ]);

                        echo ' </div>';
                        foreach ($groups as $g) {


                            echo '<div class="checkbox">
                                    <label> ' . $g["name"];
                            if ($g["name"] == 'Admin' || $g["name"] == 'Default' || $g["name"] == 'Public') {
                                $data = array(
                                    'name' => 'newsletter',
                                    'id' => 'newsletter',
                                    'value' => $g["name"],
                                    'checked' => TRUE,
                                    'style' => 'margin:10px',
                                );
                            } else {
                                $data = array(
                                    'name' => 'newsletter',
                                    'id' => $g["name"],
                                    'value' => 'Default',
                                    'checked' => FALSE,
                                    'style' => 'margin:10px',
                                );
                            }
                            echo form_checkbox($data);
                            echo '</label>
                                  </div>';
                        }

                        echo '<div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" name="submit" class="btn btn-primary btn-large" id="updateuser">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>';


                    }

                    ?>
                </table>



                    </div>
                </div>
            </div>
        </div>



<script>
    $(document).ready(function() {
        $('.updated').click(function(e) {

            $('#myModal').modal('show');
        });

        $("#updateuser").click(function(e) {

            var id = '<?php echo $pro->id; ?>';

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
                    {'name':name, 'surname':surname,'email':email, 'pass':pass1, 'id': id},
                    function(){
                        $('#myModal').modal('hide');
                        alert("this data has been update");
                        javascript:window.location.reload();

                    });
            }

        });

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

        });

    })

</script>

