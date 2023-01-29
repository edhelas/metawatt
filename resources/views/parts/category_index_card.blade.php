<div class="card mb-4">
    <img src="{{ resourceImage($category->key) }}" class="card-img-top">

    <div class="card-body">
        <h5 class="card-title">
            <i style="color: {{ $category->color }};"
                class="fa-solid {{ catIcon($category->key)}}"></i>
            {{ $category->title}}
        </h5>
        <p class="card-text">
            <i class="fa-solid fa-chart-line"></i>
            <a href="{{ route('categories.show.capacity', $category->key) }}">Capacité déployée dans le temps</a><br />

            @if (!in_array($category->key, ['step', 'battery']))
                <i class="fa-solid fa-chart-line"></i>
                <a href="{{ route('categories.show.production', $category->key) }}">Volume produit dans le temps</a><br />

                <i class="fa-solid fa-chart-line"></i>
                <a href="{{ route('categories.show.load.factor', $category->key) }}">Évolution du facteur de charge</a>
            @endif
        </p>

        @include('parts.category_types_card', ['category' => $category])
    </div>
</div>