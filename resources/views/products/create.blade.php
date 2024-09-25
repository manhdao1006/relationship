@extends('master')

@section('title')
    Create a New Product
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="category_id" class="mt-3">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>

        <label for="name" class="mt-3">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

        <label for="image_path" class="mt-3">Image</label>
        <input type="file" name="image_path" id="image_path" class="form-control">

        <label for="price" class="mt-3">Price</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">

        <label for="description" class="mt-3">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>

        <label for="tags" class="mt-3">Tags</label>
        <select name="tags[]" id="tags" multiple class="form-control">
            @foreach ($tags as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>

        <label for="gallery_1" class="mt-3">Gallery 1</label>
        <input type="file" name="galleries[]" id="gallery_1" class="form-control">

        <label for="gallery_2" class="mt-3">Gallery 2</label>
        <input type="file" name="galleries[]" id="gallery_2" class="form-control">

        <button type="submit" class="btn btn-danger mt-3">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-info mt-3">Danh sách</a>
    </form>

@endsection