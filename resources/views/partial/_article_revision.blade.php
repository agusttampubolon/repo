<?php $perbaikan = explode(",",$data->data_revision); ?>
<form id="form_submit_user_revision" enctype="multipart/form-data" method="POST" action="/article/submit" class="needs-validation" novalidate>
    <div class="row">
        <input type="hidden" value="{{$data->id}}" name="id" />
        <div class="col-md-3">
            <img style="border: 1px solid #dadada;" id="image-preview" src="{{url('/assets/upload/article'.'/'.$data->code.'/'.$data->cover_image)}}" width="100%">
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
            <div class="row mb-3">
                <div class="col-md-12">
                    @if(in_array("abstract_eng", $perbaikan))
                        <label class="text-danger" for="title">Abstract : <small class="text-danger">Need to revise</small></label>
                        <textarea name="abstract_eng" rows="20" class="form-control my-editor revision" required>{{$data->abstract_eng}}</textarea>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="title">Abstract</label>
                        <div style="border:1.4px solid #ced4da;padding:12px;border-radius: 5px;">
                            {!! $data->abstract_eng !!}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="title">Author*</label>
                <div class="row">
                    <div class="col-6">
                        @if(in_array("author_1", $perbaikan))
                            <input type="text" class="form-control revision" name="author_1" value="{{$data->author_1}}" placeholder="N/A" required>
                            <small class="text-muted">Format name : Last Name, First Name</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        @else
                            <input type="text" class="form-control" name="author_1" value="{{$data->author_1}}" placeholder="N/A" disabled>
                        @endif
                    </div>
                    <div class="col-6">
                        @if(in_array("author_2", $perbaikan))
                            <input type="text" class="form-control revision" name="author_2" value="{{$data->author_2}}" placeholder="N/A">
                        @else
                            <input type="text" class="form-control" value="{{$data->author_2}}" placeholder="N/A" disabled>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        @if(in_array("author_3", $perbaikan))
                            <input type="text" class="form-control revision" name="author_3" value="{{$data->author_3}}" placeholder="N/A">
                        @else
                            <input type="text" class="form-control" value="{{$data->author_3}}" placeholder="N/A" disabled>
                        @endif
                    </div>
                    <div class="col-6">
                        @if(in_array("author_4", $perbaikan))
                            <input type="text" class="form-control revision" name="author_4" value="{{$data->author_4}}" placeholder="N/A">
                        @else
                            <input type="text" class="form-control" value="{{$data->author_4}}" placeholder="N/A" disabled>
                        @endif
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        @if(in_array("author_5", $perbaikan))
                            <input type="text" class="form-control revision" name="author_5" value="{{$data->author_5}}" placeholder="N/A">
                        @else
                            <input type="text" class="form-control" value="{{$data->author_5}}" placeholder="N/A" disabled>
                        @endif
                    </div>
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
                <div class="col-md-6">
                    @if(in_array("isbn_issn", $perbaikan))
                        <label class="text-danger" for="isbn_issn">ISBN/ISSN : <small class="text-danger">Need to revise</small></label>
                        <input type="text" class="form-control" name="isbn_issn" value="{{$data->isbn_issn}}" placeholder="N/A" required>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="publisher">Publisher Name*</label>
                        <input type="text" class="form-control" value="{{$data->isbn_issn}}" placeholder="N/A" disabled>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    @if(in_array("subject", $perbaikan))
                        <label class="text-danger" for="isbn_issn">Subject : <small class="text-danger">Need to revise</small></label>
                        <input type="text" class="form-control" name="subject" value="{{$data->subject}}" placeholder="N/A" required>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    @else
                        <label for="publisher">Publisher Name*</label>
                        <input type="text" class="form-control" value="{{$data->subject}}" placeholder="N/A" disabled>
                    @endif
                </div>
            </div>
            @if(in_array("upload_file", $perbaikan))
                <div class="row mb-3">
                    <div class="col-8">
                        <label class="d-block text-danger">File : <small class="text-danger">Need to revise</small></label>
                        <div class="custom-file">
                            <input type="file" name="upload_file" class="custom-file-input revision" id="upload_file" required>
                            <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                            <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                </div>
            @else
                <label for="publisher">File *</label>
                <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/article'.'/'.$data->code.'/'.$data->upload_file)}}"><i class="fa fa-download"></i> {{$data->upload_file}}</a>
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

@include("partial._revision")