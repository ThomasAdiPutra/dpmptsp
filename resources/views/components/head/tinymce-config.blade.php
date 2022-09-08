@props(['images_upload_url', 'selector', 'script' => 'true'])

@if ($script === 'true')
    <script src="https://cdn.tiny.cloud/1/7m2gz4dcpdtz3ckju0bkhh3ckvzysnoil3zyu3uurobtlrgv/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
@endif
<script>
    tinymce.init({
        selector: 'textarea{{ $selector ?? '' }}',
        plugins: 'advlist autolink lists link {{ isset($images_upload_url) ? "image" : "" }} searchreplace visualblocks fullscreen media table wordcount code',
        toolbar: 'undo redo | fontfamily forecolor fontsize | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent {{ isset($images_upload_url) ? "| image" : "" }}',
        @if (isset($images_upload_url))
            images_upload_url: "{{ $images_upload_url }}",
            automatic_uploads: true,
            convert_urls: false,
        @endif
        // skin: 'oxide-dark',
    });
</script>
