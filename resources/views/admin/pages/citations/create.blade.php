<style>
    .form-control-label {
        text-align: left;
    }

    /* Style pour chaque image et son conteneur */
    .image-container {
        position: relative;
        margin: 10px;
        width: 200px;
        height: 160px;
        border-radius: 15px;
        display: inline-block;
    }

    /* Style pour chaque image */
    .h25 {
        width: 100%;
        height: 100%;
        border-radius: 15px;
    }
    #img {
        /* width: 50px ; */
        /* height: 150px; */
        padding-top: 50px;
        display: flex;
        /* justify-content: center; */
    }

    /* Style pour la croix (×) */
    .close-button {
        cursor: pointer;
        font-size: 24px;
        color: red;
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 1;
    }
</style>
@extends('layouts.base')

@section('content')
    <div class="br-mainpanel br-profile-page">

        <div class="card shadow-base bd-0 rounded-0 widget-4">
        </div><!-- card -->

        <br>
        <div class="tab-content br-profile-body" style="background: #fff;">
            <h4 class="tx-gray-800 mg-b-5">Ajouter une Citation</h4>
            @if (session()->has('success'))
                <div class="alert alert-success w-50">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                    <form action="{{ route('citations.store') }}" method="post" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Catégories: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choisir une catégorie"
                                            name="id_categorie_citations" required>
                                            <option label="Choose country"></option>
                                            @foreach ($categorie_citation as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-12 mt-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Contenu: <span class="tx-danger">*</span></label>
                                        <textarea rows="10" class="form-control" placeholder="contenu" name="contenu" required></textarea>
                                    </div>
                                </div>

                                <input type="file" name="fichiers[]" multiple id="importFile" class="mt-3">

                                <div id="img" class="col-lg-12"></div>

                            </div><!-- row -->
                        </div><!-- form-layout -->

                        <div class="form-layout-footer mt-3">
                            <button class="btn btn-info">Enregistrer</button>
                        </div><!-- form-layout-footer -->

                    </form>
                </div>

            </div><!-- tab-pane -->
        </div><!-- br-pagebody -->
        <!-- </form> -->
    </div><!-- br-mainpanel -->
@endsection

@section('scripts')
    <script>
        const inputImg = document.getElementById('importFile');
        const imgContainer = document.getElementById('img');

        inputImg.addEventListener('change', function(event) {
            imgContainer.innerHTML = "";

            for (let i = 0; i < event.target.files.length; i++) {
                let file = event.target.files[i];

                // Créer un conteneur pour chaque image
                let imgContainerDiv = document.createElement('div');
                imgContainerDiv.setAttribute("class", "image-container");

                // Créer l'élément d'image
                let imgElement = document.createElement('img');
                imgElement.setAttribute("class", "h25");
                imgElement.src = URL.createObjectURL(file);

                // Créer le span contenant la croix (×) pour chaque image
                let closeButton = document.createElement('span');
                closeButton.innerHTML = "&times;";
                closeButton.setAttribute("class", "close-button");
                closeButton.addEventListener('click', function() {
                    // Supprimer l'élément d'image lorsque la croix est cliquée
                    imgContainerDiv.remove();
                    // Réinitialiser l'input pour vider la sélection d'image
                    inputImg.value = "";
                });
                // Ajouter l'élément d'image et la croix au conteneur
                imgContainerDiv.appendChild(imgElement);
                imgContainerDiv.appendChild(closeButton);

                // Ajouter le conteneur au conteneur principal des images
                imgContainer.appendChild(imgContainerDiv);
            }
        });
    </script>
@endsection
