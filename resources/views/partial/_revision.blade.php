<div class="modal fade" id="modal_revision" data-backdrop="static" tabindex="-1"  role="dialog" aria-labelledby="modal_revision" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Revision Field </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form id="form_revision">
                <div class="modal-body">
                    <input type="hidden" name="id" id="hdn_user_id" value="{{$data->id}}">
                    @if($data->type == "paper")
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="cover_image">&nbsp;&nbsp;Image Cover</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="title">&nbsp;&nbsp;Title</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="author_1">&nbsp;&nbsp;Author</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="major">&nbsp;&nbsp;Major</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="abstract_eng">&nbsp;&nbsp;Abstract</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="publisher">&nbsp;&nbsp;Publisher</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="publication_place">&nbsp;&nbsp;Place of Publication</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="issued_date">&nbsp;&nbsp;Issued Dated</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="cover_pdf">&nbsp;&nbsp;Image PDF</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="chapter_1">&nbsp;&nbsp;Chapter 1</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="chapter_2">&nbsp;&nbsp;Chapter 2</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="chapter_3">&nbsp;&nbsp;Chapter 3</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="chapter_4">&nbsp;&nbsp;Chapter 4</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="chapter_5">&nbsp;&nbsp;Chapter 5</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="reference">&nbsp;&nbsp;Reference</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="data_revision[]" value="appendix">&nbsp;&nbsp;Appendix</label>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($data->type == "article")
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="cover_image">&nbsp;&nbsp;Image Cover</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="title">&nbsp;&nbsp;Title</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="abstract_eng">&nbsp;&nbsp;Abstract</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="author_1">&nbsp;&nbsp;Author 1</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="author_2">&nbsp;&nbsp;Author 2</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="author_3">&nbsp;&nbsp;Author 3</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="author_4">&nbsp;&nbsp;Author 4</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="author_5">&nbsp;&nbsp;Author 5</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="publisher">&nbsp;&nbsp;Publisher</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="publication_place">&nbsp;&nbsp;Place of Publication</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="issued_date">&nbsp;&nbsp;Issued Dated</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="isbn_issn">&nbsp;&nbsp;ISBN/ISSN</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="issued_date">&nbsp;&nbsp;Issued Dated</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="subject">&nbsp;&nbsp;Subject</label>
                                </div>
                                <div class="col-md-12">
                                    <label><input type="checkbox" name="data_revision[]" value="upload_file">&nbsp;&nbsp;File</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="campaign_name">Notes:</label>
                                <textarea name="notes" type="text" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_submit_revision" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>