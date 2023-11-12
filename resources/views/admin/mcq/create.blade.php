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
                                        <input type="text" name="question" class="form-control" placeholder="Enter your question">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <label for="">Question Thumbnail</label>
                                        <input type="file" name="image_thumbnail[]" id="image_thumbnail" class="form-control" multiple>
                                    </div>
                                </div>
                                <div id="selectedImages"></div>
                                <div class="row mt-3" id="folderLinkForm">
                                    <div class="col-md-10 dynamic-folder-link" id="dynamic-folder-link-list-1">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <input type="text" name="option[]" class="form-control" placeholder="Enter your option">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" name="option_image[]" class="form-control">
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <input class="form-check-input" type="radio" value="1" name="answer" id="answer">
                                                <label class="form-check-label" for="answer">
                                                    Correct Answer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 append-buttons">
                                        <div class="clearfix">
                                            <button type="button" id="add-button" class="btn btn-primary float-left text-uppercase shadow-sm"><i class="bi bi-plus"></i></button>
                                            <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="bi bi-dash"></i></button>
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
        $(document).ready(function () {
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-folder-link";
            var count = 0;
            var field = "";
            var maxFields = 50;

            function totalFields() {
                return $(className).length;
            }

            function addNewField() {
                var total = $('input[name="option[]"]').length;
                count = totalFields() + 1;
                field = $("#dynamic-folder-link-list-1").clone();
                field.attr("id", "dynamic-folder-link-" + count);


                field.find('input[name="option[]"]').val("");
                field.find('input[name="option_image[]"]').val("");
                field.find('input[name="answer"]').prop("checked", false);

                $(className + ":last").after($(field));
            }


            function removeLastField() {
                if (totalFields() > 1) {
                    $(className + ":last").remove();
                }
            }

            function enableButtonRemove() {
                if (totalFields() === 2) {
                    buttonRemove.removeAttr("disabled");
                    buttonRemove.addClass("shadow-sm");
                }
            }

            function disableButtonRemove() {
                if (totalFields() === 1) {
                    buttonRemove.attr("disabled", "disabled");
                    buttonRemove.removeClass("shadow-sm");
                }
            }

            function disableButtonAdd() {
                if (totalFields() === maxFields) {
                    buttonAdd.attr("disabled", "disabled");
                    buttonAdd.removeClass("shadow-sm");
                }
            }

            function enableButtonAdd() {
                if (totalFields() === maxFields - 1) {
                    buttonAdd.removeAttr("disabled");
                    buttonAdd.addClass("shadow-sm");
                }
            }

            buttonAdd.click(function () {
                addNewField();
                enableButtonRemove();
                disableButtonAdd();
            });

            buttonRemove.click(function () {
                removeLastField();
                disableButtonRemove();
                enableButtonAdd();
            });
        });

        const inputElement = document.getElementById('image_thumbnail');
        const selectedImagesContainer = document.getElementById('selectedImages');

        inputElement.addEventListener('change', handleImageSelection);

        function handleImageSelection(event) {
            selectedImagesContainer.innerHTML = '';

            const selectedFiles = event.target.files;
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
