<form id="form_submit" enctype="multipart/form-data" method="POST" action="" class="needs-validation" novalidate>
    <input type="hidden" value="{{$data->id}}" name="id" />
    <div class="row">
        <div class="col-md-3">
            <img style="border: 1px solid #dadada;" id="image-preview" src="{{url('/assets/upload/student-paper'.'/'.$data->code.'/'.$data->cover_image)}}" width="100%">
            <div class="row mt-3">
                <div class="col-12">
                    <label for="prestasi">Upload Cover*</label>
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
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Created By</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->created_by}}, {{$data->created_at}}</small>
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
                    <small class="block mb-0 text-muted">Approved By</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->approved_by ? $data->approved_by : "-"}}, {{$data->approved_at}}</small>
                </div>
            </div>
            <hr/>
        </div>
        <div class="col-md-9">
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="title">Title*</label>
                    <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="N/A" required>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Author*</label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" name="author_1" value="{{$data->author_1}}" placeholder="N/A" required>
                        <small class="text-muted">Format name : Last Name, First Name</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="title">Abstract*</label>
                    <textarea name="abstract_eng" rows="20" class="form-control my-editor" required>{{$data->abstract_eng}}</textarea>
                    <div class="invalid-feedback">Please fill out this field.</div>
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
            </div>

            <div class="row mb-3">
                <div class="col-7">
                    <div id="div_edit_chapter_1">
                        <label class="d-block">Chapter 1</label>
                        <div class="custom-control-inline">
                            <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_1)}}"><i class="fa fa-download"></i> {{$data->chapter_1}}</a>
                            <button type="button" onclick="change_chapter_1()" class="btn btn-outline-success sb-btn-xs">Change</button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_chapter_1">
                        <label for="chapter_1">Chapter 1*</label>
                        <div class="custom-file">
                            <input type="file" name="chapter_1" class="custom-file-input" id="chapter_1" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_chapter_1()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-7">
                    <div id="div_edit_chapter_2">
                        <label class="d-block">Chapter 2</label>
                        <div class="custom-control-inline">
                            <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_2)}}"><i class="fa fa-download"></i> {{$data->chapter_2}}</a>
                            <button type="button" onclick="change_chapter_2()" class="btn btn-outline-success sb-btn-xs">Change</button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_chapter_2">
                        <label for="chapter_1">Chapter 2*</label>
                        <div class="custom-file">
                            <input type="file" name="chapter_2" class="custom-file-input" id="chapter_2" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_chapter_2()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-7">
                    <div id="div_edit_chapter_3">
                        <label class="d-block">Chapter 3</label>
                        <div class="custom-control-inline">
                            <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_3)}}"><i class="fa fa-download"></i> {{$data->chapter_3}}</a>
                            <button type="button" onclick="change_chapter_3()" class="btn btn-outline-success sb-btn-xs">Change</button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_chapter_3">
                        <label for="chapter_1">Chapter 3*</label>
                        <div class="custom-file">
                            <input type="file" name="chapter_3" class="custom-file-input" id="chapter_3" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_chapter_3()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-7">
                    <div id="div_edit_chapter_4">
                        <label class="d-block">Chapter 4</label>
                        <div class="custom-control-inline">
                            <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_4)}}"><i class="fa fa-download"></i> {{$data->chapter_4}}</a>
                            <button type="button" onclick="change_chapter_4()" class="btn btn-outline-success sb-btn-xs">Change</button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_chapter_4">
                        <label for="chapter_1">Chapter 4*</label>
                        <div class="custom-file">
                            <input type="file" name="chapter_4" class="custom-file-input" id="chapter_4" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_chapter_4()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-7">
                    <div id="div_edit_chapter_5">
                        <label class="d-block">Chapter 5</label>
                        <div class="custom-control-inline">
                            <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_5)}}"><i class="fa fa-download"></i> {{$data->chapter_5}}</a>
                            <button type="button" onclick="change_chapter_5()" class="btn btn-outline-success sb-btn-xs">Change</button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_chapter_5">
                        <label for="chapter_1">Upload File*</label>
                        <div class="custom-file">
                            <input type="file" name="chapter_5" class="custom-file-input" id="chapter_5" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_chapter_5()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-12 text-left">
                    <button id="btn_update" type="submit" class="btn btn-success">Update</button>
                    @if($data->row_status == "pending" && Auth::user()->role == "administrator")
                        <button id="btn_approve" type="submit" class="btn btn-outline-success">Approve</button>
                        <button id="btn_reject" type="submit" class="btn btn-outline-success">Reject</button>
                    @endif
                    <button id="btn_delete" type="submit" class="btn btn-outline-dark">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>