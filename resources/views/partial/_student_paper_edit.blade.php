<form id="form_submit" enctype="multipart/form-data" method="POST" action="" class="needs-validation" novalidate>
    <input type="hidden" value="{{$data->id}}" name="id" />
    <div class="row mb-4">
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
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left"><a href="{{url('/admin/student-paper/user?filter='.$data->user_id)}}"> {{$data->created_by}}</a>, {{$data->created_at}}</small>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Updated At</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->updated_by ? $data->updated_by : "-"}}, {{$data->updated_at}}</small>
                </div>
            </div>
            @if($data->row_status == "active")
            <div class="row mt-2">
                <div class="col-12">
                    <small class="block mb-0 text-muted">Approved By</small><br/>
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->approved_by ? $data->approved_by : "-"}}, {{$data->approved_at}}</small>
                </div>
            </div>
            @endif
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

            <div class="form-group">
                <label for="title">Major*</label>
                <div class="row">
                    <div class="col-7">
                        <select class="form-control" name="major" required>
                            <option value="Penyuluhan Pertanian Berkelanjutan" {{$data->major == "Penyuluhan Pertanian Berkelanjutan" ? "selected": ""}}>Penyuluhan Pertanian Berkelanjutan</option>
                            <option value="Penyuluhan Perkebunan Presisi" {{$data->major == "Penyuluhan Perkebunan Presisi" ? "selected": ""}}>Penyuluhan Perkebunan Presisi</option>
                            <option value="Teknologi Produksi Tanaman Perkebunan" {{$data->major == "Teknologi Produksi Tanaman Perkebunan" ? "selected": ""}}>Teknologi Produksi Tanaman Perkebunan</option>
                        </select>
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
                <div class="col-8">
                    <div id="div_edit_cover_pdf">
                        <label class="d-block">Cover PDF</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->cover_pdf)}}"><i class="fa fa-download"></i> {{$data->cover_pdf}}</a>
                            <button type="button" onclick="change_cover_pdf()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_cover_pdf">
                        <label for="chapter_1">Cover PDF*</label>
                        <div class="custom-file">
                            <input type="file" name="cover_pdf" class="custom-file-input" id="cover_pdf" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_cover_pdf()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-8">
                    <div id="div_edit_chapter_1">
                        <label class="d-block">Chapter 1</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_1)}}"><i class="fa fa-download"></i> {{$data->chapter_1}}</a>
                            <button type="button" onclick="change_chapter_1()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
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
                <div class="col-8">
                    <div id="div_edit_chapter_2">
                        <label class="d-block">Chapter 2</label>
                        <div class="custom-control-inline align-middle">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_2)}}"><i class="fa fa-download"></i> {{$data->chapter_2}}</a>
                            <button type="button" onclick="change_chapter_2()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
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
                <div class="col-8">
                    <div id="div_edit_chapter_3">
                        <label class="d-block">Chapter 3</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_3)}}"><i class="fa fa-download"></i> {{$data->chapter_3}}</a>
                            <button type="button" onclick="change_chapter_3()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
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
                <div class="col-8">
                    <div id="div_edit_chapter_4">
                        <label class="d-block">Chapter 4</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_4)}}"><i class="fa fa-download"></i> {{$data->chapter_4}}</a>
                            <button type="button" onclick="change_chapter_4()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
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
                <div class="col-8">
                    <div id="div_edit_chapter_5">
                        <label class="d-block">Chapter 5</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->chapter_5)}}"><i class="fa fa-download"></i> {{$data->chapter_5}}</a>
                            <button type="button" onclick="change_chapter_5()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_chapter_5">
                        <label for="chapter_1">Chapter 5*</label>
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

            <div class="row mb-3">
                <div class="col-8">
                    <div id="div_edit_reference">
                        <label class="d-block">Reference</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->reference)}}"><i class="fa fa-download"></i> {{$data->reference}}</a>
                            <button type="button" onclick="change_reference()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_reference">
                        <label for="reference">Reference*</label>
                        <div class="custom-file">
                            <input type="file" name="reference" class="custom-file-input" id="reference" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_reference()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-8">
                    <div id="div_edit_appendix">
                        <label class="d-block">Appendix</label>
                        <div class="custom-control-inline">
                            <a class="btn btn-outline-success sb-btn-xs mr-2" target="_blank" href="{{url('/assets/upload/student-book'.'/'.$data->code.'/'.$data->appendix)}}"><i class="fa fa-download"></i> {{$data->appendix}}</a>
                            <button type="button" onclick="change_appendix()" class="btn btn-outline-success sb-btn-xs"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="hide" id="div_new_appendix">
                        <label for="appendix">Appendix*</label>
                        <div class="custom-file">
                            <input type="file" name="appendix" class="custom-file-input" id="appendix" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <button style="position: absolute;right: -32px;top: 32px;" type="button" onclick="cancel_change_appendix()" class="btn btn-outline-danger sb-btn-xs"><i class="fa fa-times"></i> </button>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role == "administrator")
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="prestasi">Please check bellow if you want to lock the files </label>
                    </div>
                    <div class="col-3">
                        <div class="custom-checkbox">
                            <input type="checkbox" name="lock_chapter_3" value="1" {{$data->lock_chapter_3 == 1 ? "checked" : ""}}>
                            <label class="text-muted">Chapter 3</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="lock_chapter_4" value="1" {{$data->lock_chapter_4 == 1 ? "checked" : ""}}>
                            <label class="text-muted">Chapter 4</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="lock_chapter_5" value="1" {{$data->lock_chapter_5 == 1 ? "checked" : ""}}>
                            <label class="text-muted">Chapter 5</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="custom-checkbox">
                            <input type="checkbox" name="lock_reference" value="1" {{$data->lock_reference == 1 ? "checked" : ""}}>
                            <label class="text-muted">Reference</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="lock_appendix" value="1" {{$data->lock_appendix == 1 ? "checked" : ""}}>
                            <label class="text-muted">Appendix</label>
                        </div>
                    </div>
                </div>
            @endif

            <hr/>
            <div class="row">
                <div class="col-12 text-left">
                    @if($data->row_status != "deleted")
                        @if($data->row_status != "rejected")
                        <button id="btn_update" type="submit" class="btn btn-success">Update</button>
                        @endif
                        @if($data->row_status == "pending" && Auth::user()->role == "administrator" || ($data->row_status == "revised" && $data->is_revised == 1))
                            <button id="btn_approve" type="submit" class="btn btn-success">Approve</button>
                            <button id="btn_revision" type="button" class="btn btn-success">Revise</button>
                            <button id="btn_reject" type="button" class="btn btn-outline-success">Reject</button>
                        @endif
                        <button id="btn_delete" type="submit" class="btn btn-outline-success">Delete</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>

@include("partial._rejection")
@include("partial._revision")