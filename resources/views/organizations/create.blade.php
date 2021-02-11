@extends('layout')
@section('content')
    <div class="row">
        <div class="card w-25 mt-5 mr-auto ml-auto">
            <div class="card-body">
                <a href="{{ route('organizations.list') }}" type="button" class="btn btn-primary btn-sm mb-2">Back</a>
                <form method="POST" action="{{ route('organizations.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Organization Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>People</label>
                        <select multiple class="form-control" name="organization_ids[]">
                            @foreach($people as $person)
                                <option value="{{ $person->id }}">{{ $person->name }}</option>
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
