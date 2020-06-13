<?php $perbaikan = explode(",",$data->data_revision); ?>
<form id="form_submit_user_revision" enctype="multipart/form-data" method="POST" action="" class="needs-validation" novalidate>
    <input type="hidden" value="{{$data->id}}" name="id" />
    <div class="row mb-4">
        <div class="col-md-3">
            <img style="border: 1px solid #dadada;" id="image-preview" src="{{url('/assets/upload/student-paper'.'/'.$data->code.'/'.$data->cover_image)}}" width="100%">
            <div class="row mt-3">
                <div class="col-12">
                    @if(in_array("cover_image", $perbaikan))
                        <label class="text-danger" for="prestasi">Upload Cover: <small class="text-danger">Need to revise</small></label>
                        <div class="custom-file">
                            <input type="file" name="cover_image" class="custom-file-input" id="customFile" onchange="previewImage();" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format are .jpg, .jpeg, .png and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    @endif
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
                    <small class="pl-0 pt-0 mt-0 text-muted text-sm-left">{{$data->created_by}}, {{$data->created_at}}</small>
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
            <div class="row mb-3">
                <div class="col-md-12">
                    @if(in_array("title", $perbaikan))
                        <label class="text-danger" for="title">Title : <small class="text-danger">Need to revise</small></label>
                        <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="N/A" required>
                    @else
                        <label for="title">Title*</label>
                        <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="N/A" disabled>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        @if(in_array("author_1", $perbaikan))
                            <label class="text-danger" for="title">Author : <small class="text-danger">Need to revise</small></label>
                            <input type="text" class="form-control" name="author_1" value="{{$data->author_1}}" placeholder="N/A" required>
                            <small class="text-muted">Format name : Last Name, First Name</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        @else
                            <label for="title">Author*</label>
                            <input type="text" class="form-control" name="author_1" value="{{$data->author_1}}" placeholder="N/A" disabled>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-7">
                    @if(in_array("major", $perbaikan))
                        <label class="text-danger" for="title">Major : <small class="text-danger">Need to revise</small></label>
                        <select class="form-control" name="major" required>
                            <option value="Penyuluhan Pertanian Berkelanjutan" {{$data->major == "Penyuluhan Pertanian Berkelanjutan" ? "selected": ""}}>Penyuluhan Pertanian Berkelanjutan</option>
                            <option value="Penyuluhan Perkebunan Presisi" {{$data->major == "Penyuluhan Perkebunan Presisi" ? "selected": ""}}>Penyuluhan Perkebunan Presisi</option>
                            <option value="Teknologi Produksi Tanaman Perkebunan" {{$data->major == "Teknologi Produksi Tanaman Perkebunan" ? "selected": ""}}>Teknologi Produksi Tanaman Perkebunan</option>
                        </select>
                    @else
                        <label for="title">Major</label>
                        <input type="text" class="form-control" name="major" value="{{$data->major}}" placeholder="N/A" disabled>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    @if(in_array("abstract_eng", $perbaikan))
                        <label class="text-danger" for="title">Abstract : <small class="text-danger">Need to revise</small></label>
                        <textarea name="abstract_eng" rows="20" class="form-control my-editor" required>{{$data->abstract_eng}}</textarea>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="title">Abstract</label>
                        <div style="border:1.4px solid #ced4da;padding:12px;border-radius: 5px;">
                            {!! $data->abstract_eng !!}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    @if(in_array("publisher", $perbaikan))
                        <label class="text-danger" for="title">Publisher Name : <small class="text-danger">Need to revise</small></label>
                        <input type="text" class="form-control" name="publisher" value="{{$data->publisher}}" placeholder="N/A" required>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="publisher">Publisher Name*</label>
                        <input type="text" class="form-control" value="{{$data->publisher}}" placeholder="N/A" disabled>
                    @endif
                </div>
                <div class="col-md-6">
                    @if(in_array("publication_place", $perbaikan))
                        <label class="text-danger" for="publication_place">Place of Publication: <small class="text-danger">Need to revise</small></label>
                        <input type="text" class="form-control" name="publication_place" value="{{$data->publication_place}}" placeholder="N/A" required>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="publication_place">Place of Publication*</label>
                        <input type="text" class="form-control" value="{{$data->publication_place}}" placeholder="N/A" disabled>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    @if(in_array("issued_date", $perbaikan))
                        <label class="text-danger" for="issued_date">Issued Date: <small class="text-danger">Need to revise</small></label>
                        <select class="form-control" name="issued_date" required>
                            @foreach($years as $year)
                                <option value="{{$year}}" {{$year == $data->issued_date ? "selected" : ""}}>{{$year}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="issued_date">Issued Date*</label>
                        <input type="text" class="form-control" value="{{$data->issued_date}}" placeholder="N/A" disabled>
                    @endif
                </div>
            </div>

            @if(in_array("cover_pdf", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                        <label class="d-block text-danger">Cover PDF: <small class="text-danger">Need to revise</small></label>
                        <div class="custom-file">
                            <input type="file" name="cover_pdf" class="custom-file-input" id="cover_pdf" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                </div>
            </div>
            @endif

            @if(in_array("chapter_1", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                    <label class="text-danger" for="chapter_1">Chapter 1: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="chapter_1" class="custom-file-input" id="chapter_1" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array("chapter_2", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                    <label class="text-danger" for="chapter_2">Chapter 2: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="chapter_2" class="custom-file-input" id="chapter_2" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array("chapter_3", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                    <label class="text-danger" for="chapter_3">Chapter 3: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="chapter_3" class="custom-file-input" id="chapter_3" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array("chapter_4", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                    <label class="text-danger" for="chapter_3">Chapter 4: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="chapter_4" class="custom-file-input" id="chapter_4" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array("chapter_5", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                    <label class="text-danger" for="chapter_5">Chapter 5: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="chapter_5" class="custom-file-input" id="chapter_5" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array("reference", $perbaikan))
            <div class="row mb-3">
                <div class="col-8">
                    <label class="text-danger" for="reference">Reference: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="reference" class="custom-file-input" id="reference" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array("appendix", $perbaikan))
            <div class="row">
                <div class="col-8">
                    <label class="text-danger" for="reference">Appendix: <small class="text-danger">Need to revise</small></label>
                    <div class="custom-file">
                        <input type="file" name="appendix" class="custom-file-input" id="appendix" required>
                        <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                        <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
            </div>
            @endif

            @if($data->is_revised == 0)
            <hr/>
            <div class="row">
                <div class="col-12 text-left">
                    <button id="btn_revise_user" type="submit" class="btn btn-success">Revise</button>
                </div>
            </div>
            @endif
        </div>
    </div>
</form>
