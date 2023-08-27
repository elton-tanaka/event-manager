@extends('layouts.main')

@section('title', 'Create Event')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>{{__('Create Event')}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('events.index') }}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{__('Event Title:')}}</strong>
                        <input type="text" name="title" class="form-control" placeholder={{__('Title')}}>
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{__('Event Description:')}}</strong>
                        <input type="text" name="description" class="form-control" placeholder={{__('Description')}}>
                        @error('description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{__('Event Date:')}}</strong>
                        <input type="date" name="date" class="form-control">
                        @error('date')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{__('City:')}}</strong>
                        <input type="text" name="city" class="form-control" placeholder={{__('City')}}>
                        @error('city')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{__('Event Image:')}}</strong>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" name="promoted">{{__('Is Promoted')}}
                        @error('promoted')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group form-check" >
                        <strong>{{__("Select Event's Items:")}}</strong>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="items[]" value="Chairs">{{__('Chairs')}}
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="items[]" value="Open Bar">{{__('Open Bar')}}
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="items[]" value="Stage">{{__('Stage')}}
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="items[]" value="Gifts">{{__('Gifts')}}
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="items[]" value="Smoking Area">{{__('Smoking Area')}}
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="items[]" value="Vip Room">{{__('Vip Room')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">{{__('Submit')}}</button>
            </div>
        </form>
    </div>
@endsection
