<div class="modal fade" id="modal_rejection" data-backdrop="static" tabindex="-1"  role="dialog" aria-labelledby="modal_rejection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rejection Notes </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form id="form_rejection">
            <div class="modal-body">
                <input type="hidden" name="id" id="hdn_user_id" value="{{$data->id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="campaign_name">Reason:</label>
                            <textarea name="notes" type="text" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_rejection" class="btn btn-success btn-sm">Reject Now</button>
            </div>
            </form>
        </div>
    </div>
</div>