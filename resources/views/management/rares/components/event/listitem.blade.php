<li class="list-group-item hoverable">
    <span class="badge text-bg-secondary text-uppercase">{{ $collectible->type }}</span>
    {{ $collectible->name }}
    <small class="text-muted">({{ $collectible->amount }})</small>
    <div class="d-inline float-end">
        <form class="d-inline action" action="{{ route('management.rares.collectibles.delete', $collectible) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger" type="submit"><x-bi-trash /></button>
        </form>
        @if($collectible->collected_at)
            <x-bi-check-lg style="color: var(--bs-success);" />
        @endif
    </div>
</li>
