@extends('management.main')

@section('title', 'Events')

@section('content')
    <h1 class="display-1">Events <small class="text-body-secondary"> & Collectibles</small></h1>
    <p class='lead'>Overview of collectibles to be obtained</p>
    <h2>List of Collectibles</h2>
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
                    <form class="d-inline" action="{{ route('management.events.events.delete', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                    </form>
                    <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.events.collectibles.create', $event) }}">Add Collectible</a>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($event->collectibles as $collectible)
                        <li class="list-group-item">
                            <span class="badge text-bg-secondary text-uppercase">{{ $collectible->type }}</span>
                            {{ $collectible->name }}
                            <small class="text-muted">({{ $collectible->amount }})</small>
                            <form class="d-inline" action="{{ route('management.events.collectibles.delete', $collectible) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
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
        List of Events by Group
        <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.events.groups.create') }}">Add Group</a>
    </h2>
    <div class="row">
    @foreach ($eventGroups as $eventGroup)
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $eventGroup->name }}</h5>
                    <p class="card-text">{{ $eventGroup->description}}</p>
                    <form class="d-inline" action="{{ route('management.events.groups.delete', $eventGroup) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                    </form>
                    <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.events.events.create', $eventGroup) }}">Add Event</a>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($eventGroup->events as $event)
                    <li class="list-group-item">{{ $event->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
    </div>
@endsection
