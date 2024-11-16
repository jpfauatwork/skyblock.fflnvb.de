@extends('management.main')

@section('title', 'Events')

@section('content')
    <h1 class="display-2 mt-3">Rares</h1>
    <p class='lead'>Overview of collectibles to be obtained</p>
    <h2>Collectibles by Events</h2>
    <div class="row">
    @foreach ($events as $event)
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            @include('management.rares.components.event.card')
        </div>
    @endforeach
    </div>
    <h2>
        Manage Event Groups
        <a role="button" class="btn btn-sm btn-outline-secondary" href="{{ route('management.rares.tag-groups.create') }}">Add Group</a>
    </h2>
    <div class="row">
    @foreach ($tagGroups as $tagGroup)
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            @include('management.rares.components.group.card')
        </div>
    @endforeach
    </div>
@endsection
