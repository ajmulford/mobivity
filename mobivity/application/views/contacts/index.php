            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Contacts
                            <button type="button" class="btn btn-outline btn-primary btn-xs" onclick="add_contact()" style="float:right">Add Contact</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Company</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php foreach ($contacts as $contacts_item): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $contacts_item['fullName']; ?></td>
                                        <td><?php echo $contacts_item['companyName']; ?></td>
                                        <td><?php echo $contacts_item['phone']; ?></td>
                                        <td><?php echo $contacts_item['email']; ?></td>
                                        <td><?php echo $contacts_item['nicename']; ?></td>
                                        <td><button class="btn btn-warning" onclick="edit_contact(<?php echo $contacts_item['contactID']; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_contact(<?php echo $contacts_item['contactID']; ?>, '<?php echo $_SERVER['REMOTE_ADDR']; ?>')"><i class="glyphicon glyphicon-remove"></i></button></td>
                                    </tr>
                            <?php endforeach; ?>

                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->