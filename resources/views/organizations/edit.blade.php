@extends('layout')
@section('content')
    <div class="row">
        <div class="card w-25 mt-5 mr-auto ml-auto">
            <div class="card-body">
                <a href="{{ route('organizations.list') }}" type="button" class="btn btn-primary btn-sm mb-2">Back</a>
                <form method="POST" action="{{ route('organizations.update', ['organization' => $organization->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Person Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $organization->name }}">
                    </div>
                    <div class="form-group">
                        <label>People</label>
                        <select multiple class="form-control" name="person_ids[]">
                            @foreach($people as $person)
                                <option @if(in_array($person->id, $currentRelatedPeople)) selected @endif value="{{ $person->id }}">
                                    {{ $person->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @includeWhen($errors->any(), 'errors')
            </div>
        </div>
    </div>
@endsection
