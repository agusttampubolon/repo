<div class="modal fade" id="modal_edit_user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_edit_user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Status</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hdn_email" value="">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="radio_active" type="radio" value="active" name="status" checked>
                    <label class="custom-control-label" for="radio_active">Approve Request</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="radio_reject" type="radio" value="rejected" name="status">
                    <label class="custom-control-label" for="radio_reject">Reject Request</label>
                </div>
                <div class="custom-control custom-radio" id="div_block">
                    <input class="custom-control-input" id="radio_block" type="radio" value="blocked" name="status">
                    <label class="custom-control-label" for="radio_block">Block this user</label>
                </div>
                <div class="custom-control custom-radio" id="div_unblock">
                    <input class="custom-control-input" id="radio_unblock" type="radio" value="active" name="status">
                    <label class="custom-control-label" for="radio_unblock">Unblock this user</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="radio_delete" type="radio" value="deleted" name="status">
                    <label class="custom-control-label" for="radio_delete">Delete this user</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" id="btn_update_user">Update</button>
            </div>
        </div>
    </div>
</div>