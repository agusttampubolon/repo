<div class="modal fade" id="modal_change_password" data-backdrop="static" tabindex="-1"  role="dialog" aria-labelledby="modal_change_password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form id="form_password">
                    <input type="hidden" name="email" id="hdn_email_password" value="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="campaign_name">New Password:</label>
                                <input type="password" class="form-control"  name="new_password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="campaign_name">Password Confirmation:</label>
                                <input type="password" class="form-control"  name="confirmation_password">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" id="btn_change_password">Change</button>
            </div>
        </div>
    </div>
</div>