<div class="modal fade" id="modal_my_account" data-backdrop="static" tabindex="-1"  role="dialog" aria-labelledby="modal_my_account" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Account Detail </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form id="form_account">
                    <input type="hidden" name="id" id="hdn_user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="campaign_name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="campaign_name">Email:</label>
                                <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="change_password('{{Auth::user()->email}}')">Password</button>
                <button type="button" class="btn btn-success btn-sm" onclick="change_account()">Change</button>
            </div>
        </div>
    </div>
</div>