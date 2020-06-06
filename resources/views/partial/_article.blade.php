<form id="form_submit" enctype="multipart/form-data" method="POST" action="/article/submit" class="needs-validation" novalidate>
<div class="row">
    <div class="col-md-3">
        <img style="border: 1px solid #dadada;" id="image-preview" src="{{url('/images/banner_default.jpg')}}" width="100%">
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
    </div>
    <div class="col-md-9">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="title">Title*</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="title">Abstract*</label>
            <textarea name="abstract_eng" rows="20" class="form-control my-editor" required></textarea>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>
    <div class="form-group">
        <label for="title">Author*</label>
        <div class="row">
            <div class="col-6">
                <input type="text" class="form-control" name="author_1" placeholder="Enter Author 1" required>
                <small class="text-muted">Format name for 1st Author : Last Name, First Name</small>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="author_2" placeholder="Enter Author 2">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <input type="text" class="form-control" name="author_3" placeholder="Enter Author 3">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="author_4" placeholder="Enter Author 4">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <input type="text" class="form-control" name="author_5" placeholder="Enter Author 5">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="publisher">Publisher Name*</label>
            <input type="text" class="form-control" name="publisher" placeholder="Enter Publisher Name" required>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col-md-6">
            <label for="publication_place">Place of Publication*</label>
            <input type="text" class="form-control" name="publication_place" placeholder="Enter Place of Publication" required>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="issued_date">Issued Date*</label>
            <select class="form-control" name="issued_date" required>
                @foreach($years as $year)
                    <option value="{{$year}}">{{$year}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="col-md-6">
            <label for="isbn_issn">ISBN/ISSN</label>
            <input type="text" class="form-control" name="isbn_issn" placeholder="Enter ISBN/ISSN">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" placeholder="Enter Subject">
            <small class="text-muted">Maximum 10 subjects. Please split the subjects by coma (,). Example: article, research</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-8">
            <label for="prestasi">Upload File*</label>
            <div class="custom-file">
                <input type="file" name="upload_file" class="custom-file-input" id="customFile" required>
                <label class="custom-file-label text-muted" for="customFile">Choose file</label>
                <small class="text-muted">Allowed file format is .pdf and maximum file size is 2MB</small>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>
    </div>

    <div class="row align-middle">
        <div class="col-md-6">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publish_status" id="inlineRadio2" value="unpublish" checked>
                <label class="form-check-label" for="inlineRadio2">Unpublish</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publish_status" id="inlineRadio1" value="publish">
                <label class="form-check-label" for="inlineRadio1">Publish</label>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-12 text-left">
            <button id="btn_save" type="submit" class="btn btn-success w-25">Save</button>
        </div>
    </div>
</div>
</div>
</form>
