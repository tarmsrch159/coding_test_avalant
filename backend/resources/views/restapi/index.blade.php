@extends('restapi.layouts.app')

@section('content')
<div class="card-body">
    <a href="{{ route('admin.challenge3.create') }}" class="btn btn-sm btn-primary">
        Add data
    </a>
    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>content</td>
                <td>Author</td>
                <td></td>

            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
            <tr>
                <td>{{ $key += 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->author->name }}</td>
                <td>
                    <form id="{{$post->id}}"
                        action="{{route('admin.challenge3.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"

                            class="btn btn-sm btn-danger">
                            ลบ
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection