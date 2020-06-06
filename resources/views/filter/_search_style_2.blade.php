<ul class="pagination mb-1">
    <li class="page-item"><a href="{{url()->current().'?char=a'}}" class="page-link" style="width: 38px">A</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=b'}}" class="page-link" style="width: 38px">B</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=c'}}" class="page-link" style="width: 38px">C</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=d'}}" class="page-link" style="width: 38px">D</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=e'}}" class="page-link" style="width: 38px">E</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=f'}}" class="page-link" style="width: 38px">F</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=g'}}" class="page-link" style="width: 38px">G</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=h'}}" class="page-link" style="width: 38px">H</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=i'}}" class="page-link" style="width: 38px">I</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=j'}}" class="page-link" style="width: 38px">J</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=k'}}" class="page-link" style="width: 38px">K</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=l'}}" class="page-link" style="width: 38px">L</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=m'}}" class="page-link" style="width: 38px">M</a></li>
</ul>
<ul class="pagination">
    <li class="page-item"><a href="{{url()->current().'?char=n'}}" class="page-link" style="width: 38px">N</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=o'}}" class="page-link" style="width: 38px">O</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=p'}}" class="page-link" style="width: 38px">P</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=q'}}" class="page-link" style="width: 38px">Q</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=r'}}" class="page-link" style="width: 38px">R</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=s'}}" class="page-link" style="width: 38px">S</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=t'}}" class="page-link" style="width: 38px">T</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=u'}}" class="page-link" style="width: 38px">U</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=v'}}" class="page-link" style="width: 38px">V</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=w'}}" class="page-link" style="width: 38px">W</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=x'}}" class="page-link" style="width: 38px">X</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=y'}}" class="page-link" style="width: 38px">Y</a></li>
    <li class="page-item"><a href="{{url()->current().'?char=z'}}" class="page-link" style="width: 38px">Z</a></li>
</ul>
<form method="GET">
    <div class="col-md-10 pl-0">
        <div class="input-group">
            <input type="text" class="form-control keyword" value="{{$keyword}}" name="keyword" placeholder="Enter your keyword">
            <div class="input-group-btn">
                <button class="btn btn-search" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>