@extends('layout')
@section('content')
    <div class="row">
        <div class="card w-25 mt-5 mr-auto ml-auto">
            <div class="card-body">
                <a href="{{ route('people.list') }}" type="button" class="btn btn-primary btn-sm mb-2">Back</a>
                <form method="POST" action="{{ route('people.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Person Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>Organization</label>
                        <select multiple class="form-control" name="organization_ids[]">
                            @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
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
