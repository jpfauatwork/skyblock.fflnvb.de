<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $event->name }}</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $event->occured_at->format('F jS, Y') }}</h6>
        <p class="card-text">
            {{ $event->description}}
        </p>
        <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.rares.collectibles.create', $event) }}"><x-bi-node-plus /></a>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($event->collectibles as $collectible)
            @include('management.rares.components.event.listitem')
        @endforeach
    </ul>
</div>
