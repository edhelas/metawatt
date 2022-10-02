<div class="card mb-4">
    <div class="card-body">
        <a href="{{ route('scenarios.show.capacity', $scenario->id) }}" class="btn btn-primary btn-sm" style="float: right;">Capacité</a>
        <h5 class="card-title">{{$scenario->name}}</h5>
        <h6 class="card-subtitle text-muted">{{$scenario->introduction}}</h6>
    </div>
</div>