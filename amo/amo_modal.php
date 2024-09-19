<div class="modal fade" id="detailsModal<?= $kasambahay_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">...</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_<?php echo $_SESSION['USER']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Remove Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="student_crud.php">
                    <input type="hidden" name="student_id" class="form-control" value="<?php echo $row['student_id'] ?>" />
                    <p class="text-center">Are you sure you want to Delete</p>
                    <h2 class="text-center"><?php echo $_SESSION['USER']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete_student" class="btn btn-danger"> Delete</button>

            </div>
            </form>
        </div>
    </div>
</div>