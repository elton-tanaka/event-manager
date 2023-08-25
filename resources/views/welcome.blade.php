@extends('layouts.main')
@section('title', 'Events')

@section('content')
<div id="search-container" class="col-md-12">
    <h1>Search for a event</h1>

    <form class="d-flex" action="/" method="GET">
        <input class="form-control me-sm-2" type="search" id="search" name="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Searching for: {{ $search }}</h2>
    @else
        <h2>Upcomming Events</h2>
        <p class="subtitle">Look out for next events</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
            <div class="card border-secondary mb-3 scale-100 hover:scale-105">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                @if($event->promoted == true)
                    <div class="fa-3x">
                        <i class="fa-solid fa-star fa-bounce" style="color: #ffd505; --fa-animation-iteration-count: 3;"></i>
                    </div>
                @endif
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants"> {{ count($event->users) }} Participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Could not find any event with {{ $search }}! <a href="/">See all</a></p>
        @elseif(count($events) == 0)
            <p>There are no events available</p>
        @endif
    </div>
</div>

@endsection
