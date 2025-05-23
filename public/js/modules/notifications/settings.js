document.addEventListener('DOMContentLoaded', function () {


    window.decrementNotificationBadge = function () {
        const badge = document.getElementById('topbar-unread-count');
        const tabBadge = document.querySelector('.dropdown-tabs .badge');
    
        if (badge) {
            let count = parseInt(badge.textContent.trim());
            if (!isNaN(count) && count > 0) {
                count--;
                if (count === 0) {
                    badge.remove();
                } else {
                    badge.textContent = count;
                }
    
                // Also update the tab badge text
                if (tabBadge) {
                    tabBadge.textContent = `${count} New`;
                }
            }
        }
    };

    document.addEventListener('click', function (e) {
        if (e.target.closest('.btn-close-notification')) {
            e.preventDefault();
    
            const btn = e.target.closest('.btn-close-notification');
            const notificationId = btn.dataset.id;
    
            fetch(`/notifications/${notificationId}/dismiss`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message || 'Notification dismissed.', 'info');
    
                // Remove from all matching notification elements
                const allInstances = document.querySelectorAll(`[data-notification-id="${notificationId}"]`);
                allInstances.forEach(el => el.remove());
    
                decrementNotificationBadge();
    
                // Re-check if each tab has any .notification-item left
                ['all-noti-tab', 'alerts-tab'].forEach(tabId => {
                    const tab = document.getElementById(tabId);
                    if (tab && tab.querySelectorAll('.notification-item').length === 0) {
                        tab.innerHTML = `
                            <div class="text-center text-muted py-4">
                                <i class="ri-notification-off-line fs-24 mb-2"></i>
                                <p class="mb-0">No ${tabId.includes('alert') ? 'alerts' : 'notifications'} yet</p>
                            </div>
                        `;
                    }
                });
            })
            .catch(err => {
                console.error('Dismiss failed', err);
                showToast('Failed to dismiss notification.', 'danger');
            });
        }
    });

});