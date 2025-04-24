window.uploadAvatar = function(input) {
    if (!input.files.length) return;

    const form = document.getElementById('avatar-upload-form');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(async res => {
        const contentType = res.headers.get("content-type");
        if (!res.ok || !contentType.includes("application/json")) {
            const errorText = await res.text();
            throw new Error(errorText);
        }
        return res.json();
    })
    .then(response => {
        const avatarImg = document.getElementById('user-avatar-img');
        avatarImg.src = response.avatar_url + '?v=' + new Date().getTime();
        showToast(response.message ?? 'Profile picture updated!', 'success');
    })
    .catch(error => {
        console.error('Avatar upload error:', error);
        showToast('Error updating profile photo.', 'danger');
    });
}

window.uploadCoverPhoto = function(input) {
    if (!input.files.length) return;

    const form = document.getElementById('cover-upload-form');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(async res => {
        const contentType = res.headers.get("content-type");
        if (!res.ok || !contentType.includes("application/json")) {
            const errorText = await res.text();
            throw new Error(errorText);
        }
        return res.json();
    })
    .then(response => {
        const coverImg = document.getElementById('cover-photo-img');
        coverImg.src = response.cover_url + '?v=' + new Date().getTime();
        showToast(response.message ?? 'Cover updated!', 'success');
    })
    .catch(error => {
        console.error('Cover upload error:', error);
        showToast('Error updating cover photo.', 'danger');
    });
}

function loadDefaultCovers() {
    fetch(window.defaultCoverUrl) // We’ll create this route
        .then(res => res.json())
        .then(data => {
            const grid = document.getElementById('default-cover-grid');
            grid.innerHTML = '';

            data.covers.forEach(cover => {
                const col = document.createElement('div');
                col.className = 'col-md-3';

                col.innerHTML = `
                    <div class="card h-100 shadow-sm border border-light rounded">
                        <img src="/default-covers/${cover}" class="img-fluid rounded" style="cursor:pointer;" onclick="selectCover('${cover}')">
                    </div>
                `;

                grid.appendChild(col);
            });
        })
        .catch(err => {
            console.error('Error loading covers', err);
            showToast('Unable to load covers', 'danger');
        });
}

window.selectCover = function(filename) {
    fetch(window.chooseCoverUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({ filename })
    })
    .then(res => res.json())
    .then(data => {
        const img = document.getElementById('cover-photo-img');
        img.src = data.cover_url + '?v=' + new Date().getTime();

        showToast('Cover updated!', 'success');
        bootstrap.Modal.getInstance(document.getElementById('chooseCoverModal')).hide();
    })
    .catch(() => showToast('Error updating cover.', 'danger'));
};

document.addEventListener('DOMContentLoaded', function () {
    const profileForm = document.getElementById('profileUpdateForm');

    if (profileForm) {
        profileForm.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation(); // 💥 Prevents toast doubling here too

            const formData = new FormData(profileForm);
            const actionUrl = profileForm.getAttribute('action');

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async res => {
                const contentType = res.headers.get('content-type');
                const response = contentType.includes('application/json') ? await res.json() : {};
                if (!res.ok) throw new Error(response.message || 'Error saving profile');

                showToast(response.message || 'Profile updated successfully!', 'success');

                // 🔄 Fetch updated completion percentage
                fetch('/profile/api/completion')
                    .then(res => res.json())
                    .then(data => {
                        const bar = document.getElementById('profile-progress-bar');
                        const label = document.getElementById('profile-progress-label');
                        const percent = data.percent;

                        bar.style.width = percent + '%';
                        bar.setAttribute('aria-valuenow', percent);
                        label.textContent = percent + '%';

                        bar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
                        if (percent < 40) bar.classList.add('bg-danger');
                        else if (percent < 75) bar.classList.add('bg-warning');
                        else bar.classList.add('bg-success');
                    });

            })
            .catch(err => {
                console.error('Profile update failed:', err);
                showToast('Error updating profile.', 'danger');
            });
        });
    }
});

window.addSocialInput = function (platform, iconClass, colorClass) {
    const container = document.getElementById('socialsContainer');
    const existing = container.querySelector(`[data-platform="${platform.toLowerCase()}"]`);
    
    if (existing) {
        showToast(`${platform} has already been added.`, 'warning');
        return;
    }

    // Ensure background color class (convert text-* to bg-* if needed)
    let bgClass = colorClass;
    if (colorClass.startsWith('text-')) {
        bgClass = colorClass.replace('text-', 'bg-');
    }

    const row = document.createElement('div');
    row.className = 'mb-3 d-flex align-items-center social-input-row';
    row.setAttribute('data-platform', platform.toLowerCase());

    row.innerHTML = `
        <div class="avatar-xs d-block flex-shrink-0 me-3">
            <span class="avatar-title rounded-circle fs-5 ${bgClass} text-white">
                <i class="${iconClass}"></i>
            </span>
        </div>
        <input type="hidden" name="socials[${platform.toLowerCase()}][platform]" value="${platform}">
        <input type="hidden" name="socials[${platform.toLowerCase()}][color]" value="${bgClass}">
        <input type="hidden" name="socials[${platform.toLowerCase()}][icon]" value="${iconClass}">
        <input type="text" class="form-control me-2" name="socials[${platform.toLowerCase()}][handle]" placeholder="${platform} handle" required>
        <button type="button" class="btn btn-sm btn-icon btn-light" onclick="this.closest('.social-input-row').remove(); checkEmptySocials();">
            <i class="ri-delete-bin-line text-danger"></i>
        </button>
    `;

    container.appendChild(row);
    checkEmptySocials();
};

window.checkEmptySocials = function () {
    const container = document.getElementById('socialsContainer');
    const noMessage = document.getElementById('noSocialsMessage');
    const hasInputs = container.querySelectorAll('.social-input-row').length > 0;

    if (hasInputs && noMessage) {
        noMessage.remove();
    } else if (!hasInputs && !noMessage) {
        container.innerHTML = `
            <div class="text-muted text-center py-3" id="noSocialsMessage">
                <i class="ri-share-line fs-3 d-block mb-2"></i>
                Add your social media details here so people can connect with you.
            </div>
        `;
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const socialsForm = document.getElementById('socialsForm');

    if (socialsForm) {
        socialsForm.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation(); // 💥 This kills any duplicate listeners

            const formData = new FormData(socialsForm);
            const actionUrl = socialsForm.getAttribute('action');

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async res => {
                const contentType = res.headers.get('content-type');
                const response = contentType.includes('application/json') ? await res.json() : {};
                if (!res.ok) throw new Error(response.message || 'Error saving socials');

                showToast(response.message || 'Socials updated!', 'success');
            })
            .catch(err => {
                console.error('Socials update failed:', err);
                showToast('Error updating socials.', 'danger');
            });
        });
    }
});

window.hideChooseSocialModal = function () {
    const modalEl = document.getElementById('chooseSocialModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    modal?.hide();
};

window.deleteSocial = function (btn, platform) {
    const row = btn.closest('.social-input-row');
    if (row) row.remove();
    checkEmptySocials();

    // Optional: send delete to backend
    fetch(`/profile/socials/delete/${platform}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.ok ? showToast('Social removed', 'success') : showToast('Could not remove', 'danger'))
    .catch(() => showToast('Error removing social.', 'danger'));
};

document.addEventListener('DOMContentLoaded', function () {
    const currentInput = document.getElementById('oldpasswordInput');
    const newInput = document.getElementById('newpasswordInput');
    const confirmInput = document.getElementById('confirmpasswordInput');

    const currentError = document.getElementById('error-current_password');
    const newError = document.getElementById('error-new_password');
    const confirmError = document.getElementById('error-new_password_confirmation');

    const form = document.getElementById('changePasswordForm');
    const strongPasswordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

    function validatePasswords() {
        let isValid = true;

        if (!strongPasswordRegex.test(newInput.value)) {
            newInput.classList.add('is-invalid');
            newError.textContent = 'Must be at least 8 characters, include an uppercase letter and a number.';
            isValid = false;
        } else {
            newInput.classList.remove('is-invalid');
            newError.textContent = '';
        }

        if (newInput.value !== confirmInput.value) {
            confirmInput.classList.add('is-invalid');
            confirmError.textContent = 'Passwords do not match.';
            isValid = false;
        } else {
            confirmInput.classList.remove('is-invalid');
            confirmError.textContent = '';
        }

        return isValid;
    }

    newInput.addEventListener('blur', validatePasswords);
    confirmInput.addEventListener('blur', validatePasswords);

    currentInput.addEventListener('blur', function () {
        const password = currentInput.value;
        if (!password) return;

        fetch(window.validatePasswordUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ current_password: password })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.valid) {
                currentInput.classList.add('is-invalid');
                currentError.textContent = 'Current password is incorrect.';
            } else {
                currentInput.classList.remove('is-invalid');
                currentError.textContent = '';
            }
        })
        .catch(() => {
            currentInput.classList.add('is-invalid');
            currentError.textContent = 'Error validating current password.';
        });
    });

    currentInput.addEventListener('input', () => {
        currentInput.classList.remove('is-invalid');
        currentError.textContent = '';
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const isValid = validatePasswords();
        if (!isValid) return;

        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action');

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async res => {
            const contentType = res.headers.get('content-type');
            const response = contentType.includes('application/json') ? await res.json() : {};

            if (!res.ok) throw response;

            showToast(response.message || 'Password updated successfully!', 'success');
            form.reset();
        })
        .catch(err => {
            if (err.errors) {
                Object.entries(err.errors).forEach(([field, messages]) => {
                    const input = document.querySelector(`[name="${field}"]`);
                    const errorEl = document.getElementById(`error-${field}`);
                    if (input && errorEl) {
                        input.classList.add('is-invalid');
                        errorEl.textContent = messages[0];
                    }
                });
            } else {
                showToast('Something went wrong updating your password.', 'danger');
            }
        });
    });
});

// ✅ Actual delete logic (no confirm inside!)
window.clearLoginHistory = function () {
    fetch(window.loginHistoryClearUrl, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        }
    })
    .then(res => res.json())
    .then(data => {
        const container = document.querySelector('.scroll-container .pe-2');
        if (container) container.innerHTML = '';
        showToast(data.message || 'Login history cleared.', 'success');
    })
    .catch(() => showToast('Error clearing login history.', 'danger'));
};

// 🧊 SweetAlert confirm popup trigger
document.getElementById('clear-history-btn')?.addEventListener('click', function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will clear all login history.",
        icon: 'warning',
        confirmButtonColor: '#f06548',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, clear it!',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary ms-2'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            clearLoginHistory(); // 🎯 Now runs without extra confirm
        }
    });
});


document.querySelectorAll('.security-toggle').forEach(toggle => {
    toggle.addEventListener('change', function (e) {
        e.stopImmediatePropagation(); // Now e is defined ✅

        const field = this.dataset.setting;
        const value = this.checked ? 1 : 0;

        fetch('/profile/security/update-toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ field, value })
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message || 'Updated.', 'success');
        })
        .catch(() => {
            showToast('Update failed.', 'danger');
            this.checked = !this.checked; // revert the toggle
        });
    });
});


document.getElementById('generateBackupCodesBtn')?.addEventListener('click', function (e) {
    e.stopImmediatePropagation(); // ✅ Now 'e' is defined

    fetch(window.generateBackupCodeUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
        if (data.success && data.code) {
            const container = document.getElementById('backupCodesContainer');
            const list = document.getElementById('backupCodesList');

            list.innerHTML = `<code>${data.code}</code>`;
            container.style.display = 'block';

            const existing = document.getElementById('existingBackupCodes');
            if (existing) existing.style.display = 'none';
            showToast(data.message || 'Backup code generated', 'success');
        } else {
            alert('Could not generate backup code.');
        }
    })
    .catch(err => {
        alert('Error: ' + err.message);
    });
});



document.querySelectorAll('.notification-toggle').forEach(toggle => {
    toggle.addEventListener('change', function (e) {
        e.stopImmediatePropagation(); // 💥 prevents duplicate toasts

        fetch(window.notificationToggleUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: this.dataset.id,
                enabled: this.checked
            })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                showToast('Update failed.', 'danger');
            } else {
                showToast(data.message || 'Setting updated.', 'success');
            }
        })
        .catch(() => {
            showToast('Something went wrong while saving.', 'danger');
        });
    });
});



// Load covers when modal is opened
document.getElementById('chooseCoverModal').addEventListener('show.bs.modal', loadDefaultCovers);