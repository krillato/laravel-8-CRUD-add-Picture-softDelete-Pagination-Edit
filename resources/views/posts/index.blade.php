@extends('posts.layout')

@section('content')

    <div class="row mt-5">
        
        <div class="col-md-12">
            <h2>ลองของไปงั้นน</h2>
            <a href="{{ route('posts.create')}}" class="btn btn-success my-3" >Create new post</a>
            
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td> {{$value->title }} </td>
                    <td> {{ Str::limit($value->description, 100) }} </td>{{-- แสดง Str แค่100ตัว --}}
                    <td> 
                        <form action="{{ route('posts.destroy', $value->id) }}" method="POST">
                            <a href="{{ route('posts.show', $value->id) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('posts.edit', $value->id) }}" class="btn btn-secondary">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </table> 
        
    </div>

    {!! $data->links() !!}

@endsection