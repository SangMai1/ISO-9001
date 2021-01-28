

<div class="card-columns">
  @foreach($xes as $xl)
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">{{$taisans[$xl->taisanid] ?? ""}}</h3>
      <p class="card-text">Biển số: {{ $xl->bienso }}</p>
      <p class="card-text">Nhân viên: {{ $nhanviens[$xl->nhanvienid] ?? ""}}</p>
      <div class="btn-toolbar" role="toolbar">
        <div class="btn-group">
        <button class="btn btn-sm btn-icon btn-danger delete-btn"><i class="fas fa-trash"></i></button>
        </div>
        <div class="btn-group">
          <a class="btn btn-sm btn-info btn-icon" 
              href="{{ route('xe.edit') }}?id={{$xl->id}}"><i class="fas fa-pencil-alt"></i></a>
        </div>
        
      </div>
    </div>
  </div>
  @endforeach
</div>