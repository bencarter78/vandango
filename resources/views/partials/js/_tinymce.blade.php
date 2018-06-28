@section('scripts')
    <script src="{!! asset('components/tinymce/tinymce.min.js') !!}"></script>
@stop

@section('js')
    <script>
        tinymce.init({
            selector: ".tinymce",
            theme: "modern",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            content_css: "css/content.css",
            toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image",
        });
    </script>
@stop