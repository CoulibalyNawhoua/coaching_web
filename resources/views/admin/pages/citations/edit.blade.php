<style>
    .form-control-label {
        text-align: left;
    }
    .image-container {
        position: relative;
        margin: 10px;
        width: 200px;
        height: 160px;
        border-radius: 15px;
        display: inline-block;
    }

    .h25 {
        margin: 10px;
        width: 200px;
        height: 160px;
        border-radius: 15px;
        display: inline-block;
    }

    #img {
        /* width: 50px ; */
        /* height: 150px; */
        padding-top: 50px;
        display: flex;
        /* justify-content: center; */
    }

    .close-button {
        cursor: pointer;
        font-size: 24px;
        color: red;
        /* position: absolute; */
        top: 0px;
        right: 0px;
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
            <h2 class="tx-gray-800 tx-uppercase tx-bold tx-16 ">Modifier une citation</h2>
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                    <form action="{{ route('citations.update', $citation->id) }}" method="post" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Catégories: <span
                                                class="tx-danger">*</span></label>
                                        <select name="id_categorie_citations" class="form-control" required
                                            id="id_categorie_citations">
                                            <option value="" disabled selected>Choisissez un rôle</option>
                                            @foreach ($categorie_citation as $categorie)
                                                <option value="{{ $categorie->id }}"
                                                    {{ $citation->id_categorie_citations == $categorie->id ? 'selected' : '' }}>
                                                    {{ $categorie->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Contenu: <span class="tx-danger">*</span></label>
                                        <textarea rows="10" class="form-control" placeholder="contenu" name="contenu">{{ $citation->contenu }}</textarea>
                                    </div>
                                </div>
                                <div>
                                    <input type="file" name="fichiers[]" multiple id="importFile" class="mt-3">
                                </div>
                                <div id="img" class="col-lg-12">
                                        @foreach ($images as $image)
                                            <div>
                                                <input type="hidden" name="id_fichier[]" value="{{ $image->id }}">
                                                <img src="{{ Storage::url($image->url_medias) }}" alt=""
                                                    class="h25">
                                                <span class="close-button"
                                                    onclick="deleteSub(this, {{ $image->id }})">×</span>
                                            </div>
                                        @endforeach
                                </div>
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
        
        function deleteSub(el, id) {
            if (Number(id) > 0) {
                $(el).parents('form').append('<input type="hidden" name="delete_sub[]" value="' + id + '" />');
            }
            $(el).parent().remove();
        }

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
