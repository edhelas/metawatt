<p class="card-text">
    @if (in_array($category->key, renewable()))
        <span class="text-muted">
            <i style="color: {{ catColor('renewable') }};" class="fa-solid fa-arrows-spin"></i>
            Renouvelable
        </span>
    @endif
    @if (in_array($category->key, renewable()) && in_array($category->key, lowCarbon()))
        <span class="text-muted">|</span>
    @endif
    @if (in_array($category->key, lowCarbon()))
        <span class="text-muted">
            <i style="color: {{ catColor('lowcarbon') }};" class="fa-solid fa-leaf"></i>
            Bas carbone ({{ carbonIntensity($category->key) }}g)
        </span>
    @endif
</p>