@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>{{__('My Events')}}</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table table-hover">
        <thead>
            <tr class="table-default">
                <th scope="col">#</th>
                <th scope="col">{{__('Title')}}</th>
                <th scope="col">{{__('Participants')}}</th>
                <th scope="col">{{__('Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr class="table-default">
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users) }}</td>
                    <td>
                        <a href="/events/{{ $event->id }}/edit/" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>{{__('Edit')}}</a>
                        <form action="/events/{{ $event->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>{{__('Delete')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{__('You have no events yet, ')}}<a href="/events/create">{{__('Create Event')}}</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>{{__('Events I`m Attending')}}</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
@if(count($eventsAsParticipant) > 0)
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('Title')}}</th>
            <th scope="col">{{__('Participants')}}</th>
            <th scope="col">{{__('Actions')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventsAsParticipant as $event)
            <tr>
                <td scropt="row">{{ $loop->index + 1 }}</td>
                <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                <td>{{ count($event->users) }}</td>
                <td>
                    <form action="/events/leave/{{ $event->id }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon>
                            {{__('Leave the event')}}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>{{__('You are not participating in any events yet. ')}}<a href="/">{{__('See all events')}}</a></p>
@endif
</div>
@endsection
