<script type="text/javascript">
$(function () {
    bsCustomFileInput.init();

    $("#{{ $uploader }}").on('change', function() {
        var file = $(this)[0].files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            $("#{{ $previewer }}").attr("src", reader.result);
        }
        if (file) {
            reader.readAsDataURL(file);
        }
    });
});
</script>
