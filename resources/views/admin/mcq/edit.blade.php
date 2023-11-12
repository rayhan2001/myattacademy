@extends('layouts.admin_app')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .selected-image {
            width: 100px;
            height: 100px;
            margin: 5px;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="com-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>create a mcq</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('mcq.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Question</label>
                                        <input type="text" name="question" value="{{$mcq->question}}" class="form-control" placeholder="Enter your question">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <label for="">Question Thumbnail</label>
                                        <input type="file" name="image_thumbnail[]" id="image_thumbnail" class="form-control" multiple>
                                    </div>
                                </div>
                                    @php
                                        $images = explode('|', $mcq->image_thumbnail);
                                        $options = json_decode($mcq->option);
                                        $option_images = explode('|', $mcq->option_image);
                                    @endphp
                                    @foreach($images as $image)
                                        <img src="{{ asset($image) }}" alt="" style="height: 50px; width: 50px;" class="img-thumbnail mt-2 dispaly_img_thumbnail">
                                    @endforeach
                                <div id="selectedImages"></div>
                                <div class="row mt-3" id="folderLinkForm">
                                    <div class="col-md-12 dynamic-folder-link" id="dynamic-folder-link-list-1">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                            @foreach($options as $option)
                                                <input type="text" name="option[]" value="{{$option}}" class="form-control mb-3" placeholder="Enter your option">
                                            @endforeach
                                            </div>
                                            <div class="col-md-4">
                                                @foreach($option_images as $img)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="file" name="option_image[]" class="form-control mb-3">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img src="{{ asset($img) }}" alt="" style="height: 40px; width: 50px;" class="img-thumbnail">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @if($options || $option_images)
                                                <div class="col-md-4 mt-2">
                                                    @if($options !=null)
                                                        @foreach($options as $item)
                                                            <input class="form-check-input" type="radio" value="1" name="answer" id="answer">
                                                            <label class="form-check-label" for="answer">
                                                                Correct Answer
                                                            </label>
                                                        @endforeach
                                                    @else
                                                        @foreach($option_images as $item)
                                                            <input class="form-check-input" type="radio" value="1" name="answer" id="answer">
                                                            <label class="form-check-label" for="answer">
                                                                Correct Answer
                                                            </label>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const inputElement = document.getElementById('image_thumbnail');
        const selectedImagesContainer = document.getElementById('selectedImages');

        inputElement.addEventListener('change', handleImageSelection);

        function handleImageSelection(event) {
            selectedImagesContainer.innerHTML = '';

            const selectedFiles = event.target.files;
            const thumbnailImages = document.querySelectorAll('.dispaly_img_thumbnail');
            thumbnailImages.forEach(image => {
                image.style.display = 'none';
            });
            for (const file of selectedFiles) {
                const imageElement = document.createElement('img');
                imageElement.src = URL.createObjectURL(file);
                imageElement.classList.add('selected-image');

                const deleteButton = document.createElement('button');
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
                deleteButton.innerHTML = '<i class="bi bi-trash-fill"></i>';

                deleteButton.addEventListener('click', () => {
                    const imageContainer = deleteButton.parentNode;
                    selectedImagesContainer.removeChild(imageContainer);
                });

                const imageContainer = document.createElement('div');
                imageContainer.appendChild(imageElement);
                imageContainer.appendChild(deleteButton);

                selectedImagesContainer.appendChild(imageContainer);
            }
        }
    </script>
@endsection
