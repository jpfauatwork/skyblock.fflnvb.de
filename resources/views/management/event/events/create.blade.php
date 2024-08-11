@extends('management.main')

@section('title', 'Create Event Group')

@section('content')
    <h1 class="display-1">Events <small class="text-body-secondary"> & Collectibles</small></h1>
    <p class='lead'>Create a new Event for {{ $eventGroup->name }}</p>
    <h2>Form</h2>
    <form method="POST" action="{{ route('management.events.events.store', $eventGroup) }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Event Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">Choose a name that makes the Event identifiable. Use the year and terms like "Dropparty" or "Hunt"</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <input type="text" class="form-control" name="description" value="{{ old('description') }}" id="description" aria-describedby="descriptionHelp">
            <div id="descriptionHelp" class="form-text">Got anything special about this Event?</div>
        </div>
        <div class="mb-3">
            <label for="occured_at" class="form-label">Date</label>
            <input type="date" class="form-control" name="occured_at" value="{{ old('occured_at') }}" id="occured_at" aria-describedby="occuredAtHelp">
            <div id="occuredAtHelp" class="form-text">When did the event take place</div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
