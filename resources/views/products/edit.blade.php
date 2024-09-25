@extends('master')

@section('title')
    Edit Product: {{ $product->name }}
@endsection

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="category_id" class="mt-3">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $id => $name)
                <option
                    @selected($product->category_id == $id)
                    value="{{ $id }}">{{ $name }}
                </option>
            @endforeach
        </select>

        <label for="name" class="mt-3">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">

        <label for="image_path" class="mt-3">Image</label>
        <input type="file" name="image_path" id="image_path" class="form-control">

        @if ($product->image_path && \Storage::exists($product->image_path))
            <img src="{{ \Storage::url($product->image_path) }}" width="100px" alt="">
        @endif
        <br>

        <label for="price" class="mt-3">Price</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">

        <label for="description" class="mt-3">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>

        <label for="tags" class="mt-3">Tags</label>
        <select name="tags[]" id="tags" multiple class="form-control">
            @foreach ($tags as $id => $name)
                <option
                    @selected(in_array($id, $productTags))
                    value="{{ $id }}">{{ $name }}
                </option>
            @endforeach
        </select>

        @foreach ($product->galleries as $item)
            <label for="gallery_{{ $loop->iteration }}" class="mt-3">Gallery {{ $loop->iteration }}</label>
            <input type="file" name="galleries[{{ $item->id }}]" id="gallery_{{ $loop->iteration }}" class="form-control">

            @if ($item->image_path && \Storage::exists($item->image_path))
                <img src="{{ \Storage::url($item->image_path) }}" width="100px" alt="">
            @endif
            <br>
        @endforeach

        <button type="submit" class="btn btn-danger mt-3">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-info mt-3">Danh sách</a>
    </form>

@endsection