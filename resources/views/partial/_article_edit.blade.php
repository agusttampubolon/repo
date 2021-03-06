<form id="form_submit" enctype="multipart/form-data" method="POST" action="/article/submit" class="needs-validation" novalidate>
    <div class="row">
        <input type="hidden" value="{{$data->id}}" name="id" />
        <div class="col-md-3">
            <img style="border: 1px solid #dadada;" id="image-preview" src="{{url('/assets/upload/article'.'/'.$data->code.'/'.$data->cover_image)}}" width="100%">
            <div class="row mt-3">
                <div class="col-12">
                    <label>Upload Cover*</label>
                    <div class="custom-file">
                        <input type="file" name="cover_image" class="custom-file-input" id="customFile" onchange="previewImage();" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format are .jpg, .jpeg, .png and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row mt-3">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Status</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left"><b>{{strtoupper($data->row_status)}}</b></small>
                </div>
                @if($data->row_status == "rejected")
                    <div class="col-12 mt-2">
                        <small class="block mb-0 text-muted">Rejection Notes</small><br/>
                        <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->notes}}</small>
                    </div>
                @endif
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Created By</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left"><a href="{{url('/admin/article/user?filter='.$data->user_id)}}"> {{$data->created_by}}</a>, {{$data->created_at}}</small>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Updated At</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->updated_by ? $data->updated_by : "-"}}, {{$data->updated_at}}</small>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <small class="block mb-0 text-muted">{{$data->row_status == "rejected" ? "Rejected By : " : "Approved By"}}</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->approved_by ? $data->approved_by : "-"}}, {{$data->approved_at}}</small>
                </div>
            </div>
            <hr/>
            <div class="row mt-2">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Total Download</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{Helper::get_download_count($data->id)}}</small>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @if($data->row_status == "revised")
                <div class="row mb-3">
                    <div class="col-12 mt-2">
                        <div class="alert alert-success" role="alert">
                            <label class="block mb-0">Revision Notes</label>
                            <div class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->notes}}</div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="title">Title*</label>
                    <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="N/A" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="title">Abstract*</label>
                    <textarea name="abstract_eng" rows="20" class="form-control my-editor" required>{{$data->abstract_eng}}</textarea>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Author*</label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" name="author_1" value="{{$data->author_1}}" placeholder="N/A" required>
                        <small class="text-muted">Format name for 1st Author : Last Name, First Name</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="author_2" value="{{$data->author_2}}" placeholder="N/A">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <input type="text" class="form-control" name="author_3" value="{{$data->author_3}}" placeholder="N/A">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="author_4" value="{{$data->author_4}}" placeholder="N/A">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <input type="text" class="form-control" name="author_5" value="{{$data->author_5}}" placeholder="N/A">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="publisher">Publisher Name*</label>
                    <input type="text" class="form-control" name="publisher" value="{{$data->publisher}}" placeholder="N/A" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                    <label for="publication_place">Place of Publication*</label>
                    <input type="text" class="form-control" name="publication_place" value="{{$data->publication_place}}" placeholder="N/A" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="issued_date">Issued Date*</label>
                    <select class="form-control" name="issued_date" required>
                        @foreach($years as $year)
                            <option value="{{$year}}" {{$year == $data->issued_date ? "selected" : ""}}>{{$year}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="col-md-6">
                    <label for="isbn_issn">ISBN/ISSN</label>
                    <input type="text" class="form-control" name="isbn_issn" value="{{$data->isbn_issn}}" placeholder="N/A">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" value="{{$data->subject}}" placeholder="N/A">
                    <small class="text-muted">Maximum 10 subjects. Please split the subjects by coma (,). Example: article, research</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-7">
                    <div id="div_edit_file">
                        <label class="d-block">File</label>
                        <div class="custom-control-inline">
                            <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/article'.'/'.$data->code.'/'.$data->upload_file)}}"><i class="fa fa-download"></i> {{$data->upload_file}}</a>
                            <button type="button" onclick="change_file()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_file">
                        <label for="prestasi">Upload File*</label>
                        <div class="custom-file">
                            <input type="file" name="upload_file" class="custom-file-input" id="upload_file" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_file()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row align-middle">
                <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="publish_status" id="inlineRadio2" value="unpublish" {{$data->publish_status == "unpublish" ? "checked" : " "}}>
                        <label class="form-check-label" for="inlineRadio2">Unpublish</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="publish_status" id="inlineRadio1" value="publish" {{$data->publish_status == "publish" ? "checked" : " "}}>
                        <label class="form-check-label" for="inlineRadio1">Publish</label>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-12 text-left">
                    <button id="btn_update" type="submit" class="btn btn-success">Update</button>
                    @if($data->row_status == "pending" && Auth::user()->role == "administrator" || ($data->row_status == "revised" && $data->is_revised == 1))
                        <button id="btn_approve" type="button" class="btn btn-success">Approve</button>
                        <button id="btn_revision" type="button" class="btn btn-success">Revise</button>
                        <button id="btn_reject" type="button" class="btn btn-outline-success">Reject</button>
                    @endif
                    <button id="btn_delete" type="button" class="btn btn-outline-success">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

@include("partial._revision")