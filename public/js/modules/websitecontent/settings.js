if (Array.isArray(window.contentSections)) {
    window.contentSections.forEach((section, index) => {
        const el = document.querySelector('#ckeditor-classic-' + index);
        if (!el) return;

        ClassicEditor
            .create(el)
            .then(editor => {
                editor.setData(section.content || '');
                editor.model.document.on('change:data', () => {
                    document.querySelector('#section-' + index + '-input').value = editor.getData();
                });
            })
            .catch(error => {
                console.error('Editor init error for section', index, error);
            });
    });
} else {
    console.warn('contentSections is not an array:', window.contentSections);
}

document.querySelectorAll('.image-input').forEach(input => {
    input.addEventListener('change', function () {
        const index = this.dataset.index;
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image-preview-' + index).src = e.target.result;
                document.getElementById('section-' + index + '-url').value = e.target.result; // or handle upload later
            };
            reader.readAsDataURL(file);
        }
    });
});

document.getElementById('editpage-form').addEventListener('submit', function (e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);

    // Clear old error styles
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(async response => {
        if (!response.ok) {
            const data = await response.json();
            
            if (response.status === 422 && data.errors) {
                const firstErrorKey = Object.keys(data.errors)[0];
                const firstErrorMessage = data.errors[firstErrorKey][0];

                // Highlight fields
                for (const [field, messages] of Object.entries(data.errors)) {
                    const name = field.replace(/\.\d+/g, ''); // remove array indices if needed
                    const input = form.querySelector(`[name="${field}"]`) ||
                                  form.querySelector(`[name="${name}[]"]`);
                    
                    if (input) {
                        input.classList.add('is-invalid');
                    }
                }

                showToast(firstErrorMessage, 'error');

                return;
            }

            throw new Error(data.message || 'Unexpected error');
        }

        // 🎉 Success
        const data = await response.json();
        showToast(data.message || 'Saved successfully', 'success');
    })
    .catch(err => {
        console.error(err);
        showToast('Something went wrong. Try again.', 'error');
    });
});

document.getElementById('saveAndExitBtn').addEventListener('click', function () {
    const form = document.getElementById('editpage-form');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'redirect_after';
    input.value = '1';
    form.appendChild(input);
    form.submit();
});