@extends('layouts.main')

@section('title', 'Editing: ' . $event->title)

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Editing: {{ $event->title }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Event Title:</strong>
                        <input type="text" name="title" class="form-control" value={{ $event->title }}>
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Event Description:</strong>
                        <input type="text" name="description" class="form-control" value={{ $event->description }}>
                        @error('description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Event Date:</strong>
                        <input type="date" name="date" class="form-control" value={{ $event->date->format('Y-m-d') }}>
                        @error('date')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>City:</strong>
                        <input type="text" name="city" class="form-control" value={{ $event->city }}>
                        @error('city')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Event Image:</strong>
                        <input type="file" name="image" class="form-control" value={{ $event->image }}>
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input type="checkbox" name="promoted" {{ $event->promoted == 1 ? "checked='checked'" : "" }} >Is Promoted
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Event's Items:</strong>
                        <?php
                            $items = $event->items ?? [];  //for some reason this didnt work with blade
                        ?>
                        <div class="form-group">
                            <input type="checkbox" name="items[]" value="Chairs" {{ in_array('Chairs', $items) ? "checked='checked'" : "" }}>Chairs
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="items[]" value="Open Bar" {{ in_array('Open Bar', $items) ? "checked='checked'" : "" }}>Open Bar
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="items[]" value="Stage" {{ in_array('Stage', $items) ? "checked='checked'" : "" }}>Stage
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="items[]" value="Gifts" {{ in_array('Gifts', $items) ? "checked='checked'" : "" }}>Gifts
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="items[]" value="Smoking Area" {{ in_array('Smoking Area', $items) ? "checked='checked'" : "" }}>Smoking Area
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="items[]" value="Vip Room" {{ in_array('Vip Room', $items) ? "checked='checked'" : "" }}>Vip Room
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
