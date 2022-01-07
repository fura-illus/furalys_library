function previewFile(e) {
    var preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(e.target.files[0]);
    preview.onload = function() {
        URL.revokeObjectURL(preview.src)
    }
};
