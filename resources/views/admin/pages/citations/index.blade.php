<style>
    .h25 {
        margin: 10px;
        width: 200px;
        height: 160px;
        border-radius: 15px;
        display: inline-block;
    }
    #img{
        /* width: 200px ; */
        /* height: 150px; */
        padding-top: 20px;
        display: flex;
        /* justify-content: center; */
    }
</style>
@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Citations</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="tx-gray-800 mg-b-5">Ajouter <a href="{{ route('citations.create') }}"
                                        class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a></h5>
                            </div><!-- d-flex -->

                            @if (session()->has('success'))
                                <div class="alert alert-success w-50">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            <div class="table-wrapper">
                                <table id="datatable1" class="table display table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p">Id</th>
                                            {{-- <th class="wd-15p">Catégories</th> --}}
                                            <th class="wd-35p">Contenu</th>
                                            <th class="wd-20p">Auteur</th>
                                            <th class="wd-20p">Date d'ajout</th>
                                            {{-- <th class="wd-10p">Date modification</th> --}}
                                            <th class="wd-20p">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($citations as $citation)
                                            <tr>
                                                <td class="wd-5p">{{ $citation->id }}</td>
                                                {{-- <td class="wd-15p">{{ $citation->name }}</td> --}}
                                                <td class="wd-35p">{{ Str::limit($citation->contenu, 50, '...') }}</td>
                                                <td class="wd-20p">{{ $citation->first_name . ' ' . $citation->last_name }}</td>
                                                <td class="wd-20p">{{ Carbon\Carbon::parse($citation->add_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                {{-- <td>{{ Carbon\Carbon::parse($citation->edit_date)->locale('fr_FR')->isoFormat('LLLL') }} --}}
                                                <td class="wd-20p">
                                                    <a href="{{ route('citations.edit', $citation->id) }}"
                                                        class="btn btn-info btn-sm">Modifier</a>
                                                    <a href="javascript:;" onclick="deleteFunction({{ $citation->id }})">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm">Supprimer</button>
                                                    </a>
                                                    {{-- <a href="" class="btn btn-primary btn-sm">Détails</a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div><!-- table-wrapper -->
                        </div><!-- modal -->
                    </div>
                </div><!-- card -->
            </div><!-- col-9 -->
        </div><!-- row -->
    </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
@endsection

{{-- @section('scripts') --}}

@section('scripts')
    <script>

        // prévisualisation des images
        const inputImg = document.getElementById('importFile');
        let img = document.getElementById('img');

        inputImg.addEventListener('change', function(event) {
            img.innerHTML = ""
            for (let i = 0; i < event.target.files.length; i++) {
                let file = event.target.files[i];
                let imgElement = document.createElement('img');
                imgElement.setAttribute("class", "h25");
                imgElement.src = URL.createObjectURL(file);
                img.appendChild(imgElement);
            }
        });


        function deleteFunction(citation_id) {
            Swal.fire({
                title: "Êtes-vous sûr?",
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        method: "POST",
                        url: "/delete-citation/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            citation_id: citation_id
                        },
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            location.reload();
                            Swal.fire({
                                text: "Vous avez supprimé !",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-default"
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
