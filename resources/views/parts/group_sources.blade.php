@if (!empty(groupSources($group)))
<p>Sources :<br />
    @foreach (groupSources($group) as $url => $title)
        <i class="fa-solid fa-link"></i> <a href="{{ $url }}" target="_blank">{{ $title }}</a></br>
    @endforeach
</p>
@endif