<script type="text/javascript">
tinymce.init({
    selector: '.editor',
    plugins: 'pagebreak preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media table charmap hr advlist lists wordcount imagetools textpattern noneditable help charmap quickbars',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent pagebreak |  numlist bullist | forecolor backcolor removeformat | fullscreen  preview | charmap insertfile image media link codesample | ltr rtl',
    toolbar_sticky: true,
    height: 600,
    image_advtab: true,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image imagetools table',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',

    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;

        xhr.open('POST', "{{ route('cms.upload.editor') }}");
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

        xhr.onload = function () {
            var json;

            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    },
});
</script>
