<!-- Add Modal -->
<div class="modal fade" id="pending<?php echo $users['user_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="height:1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Pending User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="subject_crud.php">
                    <div class="form-group">
                        <label class="col-md-8 col-form-label">Subject Name</label>
                        <input type="text" class="form-control" name="subject_name" placeholder="Enter subject name">
                    </div>
                    <div class="form-group">
                        <label for="cars">Under Course</label>
                        <select class="form-control" name="course_name" id="course" value="">
                            <option value="">---Select Course---</option>
                            <?php
                            try {
                                $sql1 = 'SELECT * FROM course';
                                foreach ($db->query($sql1) as $row1) {
                            ?>

                                    <option value="<?php echo $row1['course_abbr']; ?>"><?php echo $row1['course_name']; ?></option>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "There is some problem in connection: " . $e->getMessage();
                            } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="addsubject" class="btn btn-primary submitBtn">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>