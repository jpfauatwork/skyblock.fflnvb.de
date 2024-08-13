<li class="list-group-item hoverable">
    {{ $event->name }}
    <form class="d-inline action float-end" action="{{ route('management.rares.events.delete', $event) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" type="submit"><x-bi-trash /></button>
    </form>
</li>
