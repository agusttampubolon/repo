<form id="form_submit" enctype="multipart/form-data" method="POST" action="/article/submit" class="needs-validation" novalidate>
    <input type="hidden" value="{{$data->id}}" name="id" />
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
                <small class="text-muted">Format name for 1st Author : Last Name, First Name</small>
                <div class="invalid-feedback">Please fill out this field.</div>
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
        <div class="col-7">
            <div id="div_edit_file">
                <label class="d-block">File</label>
                <div class="custom-control-inline">
                    <a class="form-control form-control-plaintext" target="_blank" href="{{url('/assets/upload/guide-book'.'/'.$data->code.'/'.$data->upload_file)}}"><i class="fa fa-download"></i> {{$data->upload_file}}</a>
                    <button type="button" onclick="change_file()" class="btn btn-outline-success sb-btn-xs"><i data-feather="edit"></i></button>
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
                <input class="form-check-input" type="radio" name="publish_status" id="inlineRadio2" value="unpublish" {{$data->publish_status == "unpublish" ? "checked" : ""}}>
                <label class="form-check-label" for="inlineRadio2">Unpublish</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publish_status" id="inlineRadio1" value="publish" {{$data->publish_status == "publish" ? "checked" : ""}}>
                <label class="form-check-label" for="inlineRadio1">Publish</label>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-12 text-left">
            <button id="btn_update" type="submit" class="btn btn-success">Update</button>
            <button id="btn_delete" type="submit" class="btn btn-outline-dark">Delete</button>
        </div>
    </div>
</form>