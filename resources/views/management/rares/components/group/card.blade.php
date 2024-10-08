<div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $tagGroup->name }}</h5>
                    <p class="card-text">{{ $tagGroup->description}}</p>
                    <div class="float-end d-flex">
                        <form class="d-inline" action="{{ route('management.rares.groups.delete', $tagGroup) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit"><x-bi-trash /></button>
                        </form>
                        <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.rares.events.create', $tagGroup) }}"><x-bi-node-plus /></a>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($tagGroup->events as $event)
                        @include('management.rares.components.group.listitem')
                    @endforeach
                </ul>
            </div>
