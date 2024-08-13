@extends('management.main')

@section('title', 'Events')

@section('content')
    <h1 class="display-2">Rares</h1>
    <p class='lead'>Overview of collectibles to be obtained</p>
    <h2>Collectibles by Events</h2>
    <div class="row">
    @foreach ($events as $event)
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $event->occured_at->format('F jS, Y') }}</h6>
                    <p class="card-text">
                        {{ $event->description}}
                    </p>
                    <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.rares.collectibles.create', $event) }}"><x-bi-plus /></a>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($event->collectibles as $collectible)
                        <li class="list-group-item">
                            <span class="badge text-bg-secondary text-uppercase">{{ $collectible->type }}</span>
                            {{ $collectible->name }}
                            <small class="text-muted">({{ $collectible->amount }})</small>
                            <form class="d-inline" action="{{ route('management.rares.collectibles.delete', $collectible) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit"><x-bi-trash /></button>
                            </form>
                            @if($collectible->collected_at)
                                <span class="badge rounded-pill text-bg-success float-end">Collected</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
    </div>
    <h2>
        Manage Event Groups
        <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.rares.groups.create') }}">Add Group</a>
    </h2>
    <div class="row">
    @foreach ($eventGroups as $eventGroup)
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $eventGroup->name }}</h5>
                    <p class="card-text">{{ $eventGroup->description}}</p>
                    <div class="float-end d-flex">
                        <form class="d-inline" action="{{ route('management.rares.groups.delete', $eventGroup) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit"><x-bi-trash /></button>
                        </form>
                        <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.rares.events.create', $eventGroup) }}"><x-bi-node-plus /></a>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($eventGroup->events as $event)
                    <li class="list-group-item">
                        {{ $event->name }}
                        <form class="d-inline" action="{{ route('management.rares.events.delete', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit"><x-bi-trash /></button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
    </div>
@endsection
