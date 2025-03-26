@extends('admin.layout')
@section('content')
    <!-- Content Header (crud header) -->
    <div class="content-wrapper">
        <div class="content-header px-3">
            <div class="container-fluid">
                <div class="row mb-2 mx-1">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __(' Edit crud') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2">
                                <a title="Go Back" href="{{ route('admin.crud.index') }}"
                                    class="btn btn-secondary btn-sm previous round"> <i class="fas fa-arrow-left"
                                        aria-hidden="true"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.crud.index') }}">{{ __('crud') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                {{ __('Edit crud') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <section class="content px-3">
            <div class="container-fluid">

                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-body">
                            <form id="myForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.crud.update', $crud->id) }}">
                                @csrf
                                @method('PUT') <!-- Use PUT method for update -->
                                
                                <div class="row">
                                    <input type="hidden" name="type" value="crud">
                                    
                                    <!-- Name Field -->
                                    <div class="mb-3 form-group-translation col-md-4">
                                        <label for="name" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input id="name" type="text" name="name" value="{{ old('name', $crud->name) }}" placeholder="Title" class="form-control @error('name') is-invalid @enderror">
                                        @if ($errors->has('name'))
                                            <span style="color:red;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <!-- Name Field -->
                                    <div class="mb-3 form-group-translation col-md-4">
                                        <label for="name" class="form-label">Price <span class="text-danger">*</span></label>
                                        <input id="date" type="text" name="date" value="{{ old('date', $crud->date) }}" placeholder="Price" class="form-control @error('date') is-invalid @enderror">
                                        @if ($errors->has('date'))
                                            <span style="color:red;">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                            
                                   
                                    
                                    
                                </div>
                            
                                <!-- Meta Description Field -->
                                <div class="row">
                                    <div class="mb-3 form-group-translation col-md-12">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea name="meta_description" cols="8" rows="3" placeholder="Meta Description" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $crud->meta_description) }}</textarea>
                                        @if ($errors->has('meta_description'))
                                            <span style="color:red;">{{ $errors->first('meta_description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            
                                <!-- Image Uploads -->
                                <div class="row">
                                    <!-- Main Image Field -->
                                    <div class="mb-3 form-group-translation col-md-6" id="media-input-container">
                                        <div class="myDiv1 image_div1" id="showimage1">
                                            <label for="main_image"><span>Main Image</span>:</label>
                                            <p class="text-blue">Note: Please upload an image of size larger than 1280px x 685px.</p>
                                            <input type="file" class="form-control-file @error('main_image') is-invalid @enderror" id="main_image" accept=".jpg,.jpeg,.png" name="main_image">
                                            @if ($crud->main_image)
                                                <img src="{{ asset('storage/uploads/crud/main_image/' . $crud->main_image) }}" alt="Main Image" style="width: 100px; height: auto;">
                                            @endif
                                            @if ($errors->has('main_image'))
                                                <span style="color:red;">{{ $errors->first('main_image') }}</span>
                                            @endif
                                        </div>
                                    </div>
    
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="mt-2 col-md-12 text-right">
                                        <button type="submit" class="btn btn-success save-button" value="save">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>


                    </div>
            </div>
        </section>
    </div>
    </section>
    </div>
@endsection

<!-- Include CKEditor 5 Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    });
</script>