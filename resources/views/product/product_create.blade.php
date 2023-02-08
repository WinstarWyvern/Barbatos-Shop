@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 border border-black">
            <div class="navbar navbar-expand-lg navbar m-md-2">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('products.index') }}">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    Add Product
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">
                                Name
                            </label>

                            <div class="col-md-12">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Enter Product Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category_id" class="col-md-12 col-form-label text-md-start">
                                {{ __('Category') }}
                            </label>

                            <div class="col-md-12">
                                <select name="category_id" id="category_id"
                                    class="form-control form-select @error('category_id') is-invalid @enderror" required>
                                    <option selected disabled>Choose a Category </option>
                                    @foreach ($categories as $category)
                                        <option value={{ $category['id'] }}
                                            {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                                            {{ $category['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-12 col-form-label text-md-start">
                                {{ __('Description') }}
                            </label>

                            <div class="col-md-12">
                                <textarea class="form-control" id="description" name="description" rows="10">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">
                                Price
                            </label>

                            <div class="col-md-12">
                                <input id="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ old('price') }}" required autocomplete="price" autofocus
                                    placeholder="Enter Product Price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="imagePath" class="form-label">Photo</label>

                            <div class="col-md-12">
                                <input class="form-control @error('imagePath') is-invalid @enderror"" type="file"
                                    id="imagePath" name="imagePath" onchange="previewPhoto()">
                                <img class="img-fluid img-preview my-5 mx-auto d-block">
                                @error('imagePath')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="text-md-center col-md-3 me-auto">
                                <button type="submit" class="btn btn-outline-primary w-100">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function previewPhoto() {
        const image = document.querySelector('#imagePath');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);
        ofReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
