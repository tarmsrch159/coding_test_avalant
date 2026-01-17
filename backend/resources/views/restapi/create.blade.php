@extends('restapi.layouts.app')

@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form method="POST" action="/challenge3">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        placeholder="title*" />
                    @error('title')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content*</label>
                    <input
                        type="text"
                        name="content"
                        id="content"
                        class="form-control @error('content') is-invalid @enderror"
                        value="{{ old('content') }}"
                        placeholder="content*" />
                    @error('content')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="author_id" class="form-label">Author*</label>
                    <select class="form-control @error('Author_id') is-invalid @enderror" name="author_id"
                        id="author_id">
                        <option value="" selected disabled>Choose a Author</option>
                        @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @if (old('author_id')==$author->id)
                            selected
                            @endif>
                            {{ $author->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('author_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-sm btn-dark mb-3">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection