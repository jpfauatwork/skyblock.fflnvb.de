@extends('management.main')

@section('title', 'Create Collectible')

@section('content')
    <h1 class="display-1">Events <small class="text-body-secondary"> & Collectibles</small></h1>
    <p class='lead'>Create a new Collectible for {{ $event->name }}</p>
    <h2>Form</h2>
    <form method="POST" action="{{ route('management.events.collectibles.store', $event) }}">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" aria-describedby="typeHelp">
                <option selected value="head">Head</option>
                <option value="block">Block</option>
                <option value="potion">Potion</option>
                <option value="tool">Tool</option>
            </select>
            <div id="typeHelp" class="form-text">What type of Collectible was given out?</div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">What's the name of the Collectible?</div>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (optional)</label>
            <input type="number" class="form-control" name="amount" value="{{ old('amount') }}" id="amount" aria-describedby="amountHelp">
            <div id="amountHelp" class="form-text">How many of these Collectibles have been distributed?</div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
