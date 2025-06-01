// for admin add video page
$(document).ready(function() {
    // Initialize Select2
    $('#tags').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select tags',
        allowClear: true
    });
    
    // Show/hide thumbnail upload based on video source
    $('#source').change(function() {
        if ($(this).val() === 'tiktok') {
            $('#thumbnail-container').removeClass('d-none');
        } else {
            $('#thumbnail-container').addClass('d-none');
        }
    });
});

// Handle edit category
document.querySelectorAll('.edit-category').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('edit_id').value = this.dataset.id;
        document.getElementById('edit_name').value = this.dataset.name;
    });
});

// Handle delete category
document.querySelectorAll('.delete-category').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('delete_id').value = this.dataset.id;
        document.getElementById('delete_name').textContent = this.dataset.name;
    });
});

// for admin edit video page
$(document).ready(function() {
    // Initialize Select2 for tags
    $('#tags').select2({
        theme: 'bootstrap-5',
        placeholder: 'Select tags',
        allowClear: true
    });
});