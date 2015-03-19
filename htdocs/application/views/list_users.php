<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Users
                    <strong>List</strong>
                </h2>
                <hr>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    New Users
                </button>

                    <table class="table table-hover">


                            <?php
                            if ($this->aauth->is_admin($this->session->userdata('id')) && $this->aauth->get_user()) {
                                echo    '<tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                             <th>Groups</th>
                            <th>Commands</th>
                        </tr>';
                            foreach($list_user as $l){
                                echo '<tr>';
                                echo '<td>'.$l['name'].'</td>';
                                echo '<td>'.$l['surname'].'</td>';
                                echo '<td>'.$l['email'].'</td>';
                                $groups = $this->aauth->get_user_groups($l['id']);
                                echo '<td>';
                                foreach($groups as $g){
                                    echo $g['name'].' ';
                                }
                                echo '</td>';

                                echo '<td id="'.$l["id"].'"><a id="'.$l["id"].'" class="delete" href="#"><button class="btn btn-danger" title="delete file">Delete</button></a>
                                <a id="'.$l["id"].'" class="update" href="#"><button class="btn btn-success" title="update file">Update</button></a>

                                </td>';
                                echo '</tr>';
                           // Modal

                            }

                            }
                            else
                                echo '<h2 class="intro-text text-center"> <p class="text-warning">Forbidden <strong>You dont have enough right :( </strong></p>';
                            ?>
                    </table>


            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">New User</h4>
                        </div>


                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group">

                                    <label>Name</label>
                                    <input type="text" name="name"  id="name" value="<?php echo set_value('name'); ?>"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <?php echo form_error('surname','<div class="alert alert-danger">', '</div>'); ?>
                                    <label>Surname</label>

                                    <input type="text" name="surname"  id="surname" value="<?php echo set_value('surname'); ?>"  class="form-control">
                                </div>

                                <div class="form-group">
                                    <?php echo form_error('email','<div class="alert alert-danger">', '</div>'); ?>
                                    <label>Email Address</label>
                                    <input type="email" name ="email" id="email" value="<?php echo set_value('email'); ?>"   class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <?php echo form_error('password','<div class="alert alert-danger">', '</div>'); ?>
                                    <input type="password"   name = "password" id="password" value=""   class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Group</label>
                                <select name="mygroup" class="form-control" id="mygroup">
                                    <?php
                                    echo '<option></option>';
                                    echo '<option>Admin</option>';
                                    echo '<option>Public</option>';
                                    ?>
                                </select>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="addusers">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>


        <!-- Modal2 rempli oar javascript pour update -->
        <div id="update_modal"></div>

<script>
    /**
     * Created by aemebiku on 03/03/15.
     */
    $(document).ready(function() {
        $('.update').click(function(e) {
            var empId = $(this).attr("id");
            if (confirm("Are you sure, you want to update data?")) {

                $.post(window.location.origin + "/Users/update_users",
                    {'update': empId},
                    function (html) {
                        $('#update_modal').hide().html(html).fadeIn();
                        $('#myModal2').modal('show')

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

        $("#addusers").click(function(e) {


            var name =  $("#name").val();

            var surname =  $("#surname").val();

            var email =  $("#email").val();

            var pass = $("#password").val()
            var group = $("#mygroup").val()

            if(email=='' || name== '' || surname=='' || pass == '' ){

                alert("ERROR: You have one or more errors in your form");
            }

            else {
                $.post(window.location.origin + "/admin/add_user",
                    {'name':name, 'surname':surname,'email':email, 'password': pass, 'group' : group},
                    function(json){

                        if (json.reponse == "OK"){
                            $('#myModal').modal('hide');
                            alert("success save "+ json.reponse);
                            javascript:window.location.reload();
                        }
                        else
                        {
                            /*javascript:window.location.reload();
                            $('#myModal').modal('show');*/
                            alert("Error save "+ json.reponse);
                        }

                    },"json");
            }

        });

    })
</script>