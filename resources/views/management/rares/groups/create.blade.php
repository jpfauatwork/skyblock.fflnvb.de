@extends('management.main')

@section('title', 'Create Event Group')

@section('content')
    <h1 class="display-1">Rares</h1>
    <p class='lead'>Create a new Event Group</p>
    <h2>Form</h2>
    <form method="POST" action="{{ route('management.rares.groups.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Event Group Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">A short and simple name describing the series of events</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <input type="text" class="form-control" name="description" id="description" aria-describedby="descriptionHelp">
            <div id="descriptionHelp" class="form-text">When does it occur and why?</div>
        </div>
        <div class="mb-3">
            <label for="order_column" class="form-label">Order Column (optional)</label>
            <input type="text" class="form-control" name="order_column" id="order_column" aria-describedby="orderColumnHelp">
            <div id="orderColumnHelp" class="form-text">If possible, to keep Events ordered by the occurence within the year, give us an approximate string of when it occurs in the format MMDD, for example "0102" for the 2nd of January.</div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
