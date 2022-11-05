<div class="card mb-4">
    <div class="card-body">
        <a href="{{ route('scenarios.show', $scenario->slug) }}" class="btn btn-sm" style="float: right; background-color: {{ groupColor($scenario->group, $scenario->slug) }};">Découvrir</a>
        <h5 class="card-title">{{$scenario->name}}</h5>
        <h6 class="card-subtitle text-muted">{{$scenario->introduction}}</h6>
    </div>
</div>