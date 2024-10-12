<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Coaching</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.jpg') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/jquery-switchbutton/jquery.switchButton.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/chartist/chartist.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/medium-editor/default.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    {{-- <link rel="stylesheet" href="dist/image-uploader.min.css"> --}}
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap" rel="stylesheet">
       
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bracket.css') }}">
</head>

<body>

    @include('layouts.sidebar')

    @yield('content')

    <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('assets/lib/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery-switchbutton/jquery.switchButton.js') }}"></script>
    <script src="{{ asset('assets/lib/peity/jquery.peity.js') }}"></script>
    <script src="{{ asset('assets/lib/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('assets/lib/rickshaw/rickshaw.min.js') }}"></script>


    <script src="{{ asset('assets/lib/highlightjs/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/bracket.js') }}"></script>
    <script src="{{ asset('assets/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/medium-editor.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/dist/image-uploader.min.js') }}"></script>

    @yield('scripts')
    

    <script>
        var datatable1 = $('#datatable1').DataTable({
            language: {
                searchPlaceholder: 'Recherche...',
                sSearch: '',
            },
            order: false
        });

          // Inline editor
          var editor = new MediumEditor('.editable');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#avatar").change(function() {
            readURL(this);
        })

        $('.dropify').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        function readURL(input) {
            if (input.files && input.files.length > 0) {
                // Supprimez toutes les images prévisualisées précédentes
                $("#image-preview-container").empty();

                for (let i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Créez un élément <img> pour afficher la prévisualisation de l'image
                        var img = document.createElement("img");
                        img.setAttribute("src", e.target.result);
                        img.setAttribute("alt", "Preview");

                        // Ajoutez l'élément <img> à la div de prévisualisation
                        $("#image-preview-container").append(img);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        $("#avatar").change(function() {
            readURL(this);
        });
        $('.input-images').imageUploader();

        // Datepicker
        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    </script>
</body>

</html>
