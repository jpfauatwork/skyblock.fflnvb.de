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
        @if($event->collectibles_count)
            @php($percentage =  $event->collectibles_owned / $event->collectibles_count * 100)
            <li class="list-group-item">
                <div class="progress" role="progressbar" aria-label="Default striped example" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped" style="width: {{ $percentage }}%"></div>
                </div>
            </li>
        @endif
        @foreach ($event->collectibles as $collectible)
            @include('management.rares.components.event.listitem')
        @endforeach
    </ul>
</div>
