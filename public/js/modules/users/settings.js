document.addEventListener('DOMContentLoaded', function () {

    let shouldScrollToTop = false;
    initPendingConnectionAnimations();


    function fetchUsers(filters = {}, page = 1) {
        const perPage = document.getElementById('perPageSelect')?.value || '20';
        const sort = document.getElementById('sortSelect')?.value || 'latest';


        fetch(window.usersFilterUrl + "?page=" + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.csrfToken
            },
            body: JSON.stringify({ ...filters, per_page: perPage, sort })
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('usersContainer').innerHTML = html;
            initPendingConnectionAnimations();
            fetchPagination(filters, page);
        });
    }

    function fetchPagination(filters = {}, page = 1) {
        const perPage = document.getElementById('perPageSelect')?.value || '20';
        const sort = document.getElementById('sortSelect')?.value || 'latest';


        fetch(window.usersFilterUrl + "?page=" + page + "&pagination=true", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.csrfToken
            },
            body: JSON.stringify({ ...filters, per_page: perPage, sort })
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('paginationWrapper').innerHTML = html;
            bindPagination();


                // 👇 Scroll to top of user cards on pagination click only
                if (shouldScrollToTop) {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    shouldScrollToTop = false;
                }
        });
    }

    document.getElementById('searchInput')?.addEventListener('input', function () {
                const query = this.value;
        const role = document.getElementById('roleFilter').value;
        fetchUsers({ query, role });
    });

    document.getElementById('roleFilter')?.addEventListener('change', function () {
                const query = document.getElementById('searchInput').value;
        fetchUsers({ query, role: this.value });
    });

    document.getElementById('perPageSelect')?.addEventListener('change', function () {
                const query = document.getElementById('searchInput').value;
        const role = document.getElementById('roleFilter').value;
        fetchUsers({ query, role });
    });

    document.getElementById('resetFilters')?.addEventListener('click', function () {
        document.getElementById('searchInput').value = '';
        document.getElementById('roleFilter').value = '';
        document.getElementById('sortSelect').value = '';
        currentRelationFilter = null;
    
        btnFollow.classList.remove('active');
        btnConnect.classList.remove('active');
        btnRequests?.classList.remove('active');
    
        fetchUsers(getFilters());
    });

    let currentRelationFilter = null;

    const btnFollow = document.getElementById('filterFollowingBtn');
    const btnConnect = document.getElementById('filterConnectedBtn');
    const btnRequests = document.getElementById('filterRequestsBtn');
    
    btnFollow?.addEventListener('click', function () {
        if (currentRelationFilter === 'following') {
            currentRelationFilter = null;
            btnFollow.classList.remove('active');
        } else {
            currentRelationFilter = 'following';
            btnFollow.classList.add('active');
            btnConnect.classList.remove('active');
            btnRequests?.classList.remove('active');
        }
        fetchUsers(getFilters());
    });
    
    btnConnect?.addEventListener('click', function () {
        if (currentRelationFilter === 'connected') {
            currentRelationFilter = null;
            btnConnect.classList.remove('active');
        } else {
            currentRelationFilter = 'connected';
            btnConnect.classList.add('active');
            btnFollow.classList.remove('active');
            btnRequests?.classList.remove('active');
        }
        fetchUsers(getFilters());
    });

    btnRequests?.addEventListener('click', function () {
        if (currentRelationFilter === 'requests') {
            currentRelationFilter = null;
            btnRequests.classList.remove('active');
        } else {
            currentRelationFilter = 'requests';
            btnRequests.classList.add('active');
            btnConnect.classList.remove('active');
            btnFollow.classList.remove('active');
        }
        fetchUsers(getFilters());
    });
    
    function getFilters() {
        return {
            query: document.getElementById('searchInput')?.value || '',
            role: document.getElementById('roleFilter')?.value || '',
            sort: document.getElementById('sortSelect')?.value || '',
            relation: currentRelationFilter
        };
    }

    document.getElementById('sortSelect')?.addEventListener('change', function () {
                const query = document.getElementById('searchInput').value;
        const role = document.getElementById('roleFilter').value;
        fetchUsers({ query, role });
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.follow-btn, .following-btn')) {
            const btn = e.target;
            const userId = btn.dataset.id;
    
            if (btn.dataset.loading === 'true') return;
            btn.dataset.loading = 'true';
    
            fetch(window.usersFollowUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(async res => {
                const data = await res.json();
                const name = data.user_name || 'the user';
    
                // Remove both possible classes first
                btn.classList.remove('follow-btn', 'following-btn');
    
                if (data.status === 'followed') {
                    btn.classList.remove('btn-outline-success');
                    btn.classList.add('btn-success', 'following-btn');
                    btn.innerHTML = '<i class="ri-user-follow-line align-bottom"></i> Following';
                } else {
                    btn.classList.remove('btn-outline-danger');
                    btn.classList.add('btn-outline-success', 'follow-btn');
                    btn.innerHTML = '<i class="ri-user-follow-line align-bottom"></i> Follow';
                }
    
                showToast(
                    data.status === 'followed'
                        ? `You’re now following ${name}`
                        : `Unfollowed ${name}`,
                    'success'
                );
            })
            .catch(err => {
                console.error("❌ Follow error", err);
                showToast("Something went wrong. Try again.", 'danger');
            })
            .finally(() => {
                btn.dataset.loading = 'false';
            });
        }
    });

    document.addEventListener('mouseover', function (e) {
        const btn = e.target.closest('.following-btn');
        if (btn) {
            btn.classList.remove('btn-outline-success');
            btn.classList.add('btn-outline-danger');
            btn.innerHTML = '<i class="ri-user-unfollow-line align-bottom"></i> Unfollow';
        }
    });
    
    document.addEventListener('mouseout', function (e) {
        const btn = e.target.closest('.following-btn');
        if (btn) {
            btn.classList.remove('btn-outline-danger');
            btn.classList.add('btn-success');
            btn.innerHTML = '<i class="ri-user-follow-line align-bottom"></i> Following';
        }
    });

    

    const pendingButtons = document.querySelectorAll('.pending-connection-btn');

    pendingButtons.forEach(btn => {
        const span = btn.querySelector('.pending-text');
        if (!span) return;

        const words = ['Connection', 'is pending'];
        let index = 0;

        setInterval(() => {
            index = (index + 1) % words.length;
            span.textContent = words[index];
        }, 2000);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.connect-btn') && !e.target.classList.contains('clicked')) {
            const btn = e.target;
            const userId = btn.dataset.id;
    
            // ✅ Prevent duplicate clicks
            btn.classList.add('clicked');
            btn.disabled = true;
    
            fetch(window.usersConnectUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(res => res.json())
            .then(data => {
                const userName = data.user_name ?? 'user';
                showToast(`🔗 Connection request sent to ${userName}`, 'success');
                btn.innerHTML = '<i class="ri-time-line align-bottom"></i> Pending';
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('btn-outline-warning');
                btn.disabled = true;
            })
            .catch(err => {
                console.error("❌ Connection request failed", err);
                showToast("Connection failed.", 'danger');
                btn.classList.remove('clicked');
                btn.disabled = false;
            });
        }
    });


    document.addEventListener('click', function (e) {
        const acceptBtn = e.target.closest('.btn-accept, .accept-connection-btn');
        const denyBtn = e.target.closest('.btn-deny, .deny-connection-btn');
    
        if (acceptBtn && !acceptBtn.classList.contains('clicked')) {
            e.preventDefault();
            acceptBtn.classList.add('clicked');
            handleConnectionAction('accept', acceptBtn.dataset.id, acceptBtn);
        }
    
        if (denyBtn && !denyBtn.classList.contains('clicked')) {
            e.preventDefault();
            denyBtn.classList.add('clicked');
            handleConnectionAction('deny', denyBtn.dataset.id, denyBtn);
        }
    });


    function handleConnectionAction(action, userId, triggerElement) {
        const url = `/connections/${action}/${userId}`;
        const method = 'POST';
    
        fetch(url, {
            method,
            headers: {
                'X-CSRF-TOKEN': window.csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            const isAccept = action === 'accept';
            showToast(data.message, isAccept ? 'success' : 'danger');

            if (isAccept && typeof confetti === 'function') {
                confetti({
                    particleCount: 200,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 },
                });
                confetti({
                    particleCount: 200,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 },
                });
            }
    
            // 1. Notification context (if exists)
            const notifItem = triggerElement.closest('.notification-item');
            let notificationId = notifItem?.dataset?.notificationId;
    
            if (!notificationId && triggerElement.dataset.notificationId) {
                notificationId = triggerElement.dataset.notificationId;
            }
    
            if (notifItem) {
                const titleEl = notifItem.querySelector('h6');
                const timeEl = notifItem.querySelector('p.mb-0.text-muted.fs-11');
                const buttonGroup = notifItem.querySelector('.mt-2');
    
                if (titleEl && isAccept) {
                    titleEl.innerHTML = data.updatedTitle || '🎉 Connection confirmed!';
                    titleEl.classList.remove('mt-0');
                    titleEl.classList.add('mt-2');
                }
    
                if (buttonGroup) buttonGroup.remove();
                notifItem.classList.add('notification-read');
            }
    
            // 2. User card (if exists)
            const card = document.querySelector(`.user-card[data-user-id="${data.user_id}"]`);
            if (card) {
                const banner = card.querySelector('.connection-banner');
                if (banner) banner.remove();
    
                const connectBtn = card.querySelector('.connect-btn');
    
                if (connectBtn) {
                    connectBtn.innerHTML = isAccept
                        ? '<i class="ri-link-line align-bottom"></i> Connected'
                        : '<i class="ri-link-line align-bottom"></i> Connect';
    
                    connectBtn.classList.remove('btn-outline-info', 'btn-outline-secondary');
                    connectBtn.classList.add(isAccept ? 'btn-success' : 'btn-outline-info');
                    connectBtn.disabled = isAccept;
                } else {
                    const buttonWrapper = card.querySelector('.d-flex.justify-content-center.gap-2.mt-3');
                    if (buttonWrapper) {
                        ['btn-outline-secondary', 'btn-success'].forEach(className => {
                            const oldBtn = buttonWrapper.querySelector(`button.${className}`);
                            if (oldBtn) oldBtn.remove();
                        });
    
                        const newBtn = document.createElement('button');
                        newBtn.classList.add('btn', 'btn-sm');
                        newBtn.disabled = isAccept;
    
                        if (isAccept) {
                            newBtn.classList.add('btn-success');
                            newBtn.innerHTML = '<i class="ri-link-line align-bottom"></i> Connected';
                        } else {
                            newBtn.classList.add('btn-outline-info', 'connect-btn');
                            newBtn.innerHTML = '<i class="ri-link-line align-bottom"></i> Connect';
                            newBtn.setAttribute('data-id', data.user_id);
                        }
    
                        buttonWrapper.appendChild(newBtn);
                    }
                }
            }
    
            // 3. Profile page layout (new inline row)
            const profileRow = document.querySelector('.connection-banner-row');
            if (profileRow) profileRow.remove();
    
            const profileContainer = document.querySelector('.connection-button-container');
            if (profileContainer) {
                const newBtn = document.createElement('button');
                newBtn.classList.add('btn');
    
                if (isAccept) {
                    newBtn.classList.add('btn-secondary');
                    newBtn.innerHTML = '<i class="ri-user-shared-line align-bottom"></i> Connected';
                    newBtn.disabled = true;
                } else {
                    newBtn.classList.add('btn-outline-info', 'connect-btn');
                    newBtn.setAttribute('data-id', data.user_id);
                    newBtn.innerHTML = '<i class="ri-user-add-line align-bottom"></i> Connect';
                }
    
                profileContainer.innerHTML = ''; // Clear old state
                profileContainer.appendChild(newBtn);
            }
    
            // 4. Delayed notification cleanup
            if (notificationId) {
                setTimeout(() => {
                    const allInstances = document.querySelectorAll(`[data-notification-id="${notificationId}"]`);
                    allInstances.forEach(el => el.remove());
    
                    decrementNotificationBadge();
    
                    const allTab = document.querySelector('a[href="#all-noti-tab"]');
                    if (allTab) {
                        const match = allTab.textContent.match(/\((\d+)\)/);
                        if (match) {
                            let count = parseInt(match[1], 10);
                            if (!isNaN(count) && count > 0) {
                                count -= 1;
                                allTab.textContent = count > 0 ? `All (${count})` : `All`;
                            }
                        }
                    }
    
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
    
                    fetch(`/notifications/${notificationId}/dismiss`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': window.csrfToken,
                            'Accept': 'application/json',
                        },
                    });
                }, isAccept ? 4000 : 3000);
            }
    
            // 5. Update badge count
            const badge = document.getElementById('requestCountBadge');
            if (badge) {
                let count = parseInt(badge.textContent.trim(), 10);
                if (!isNaN(count) && count > 0) {
                    count -= 1;
                    if (count > 0) {
                        badge.textContent = count;
                    } else {
                        badge.remove();
                    }
                }
            }
        });
    }

    let lazyPage = 2;
    let lazyLoading = false;
    
    function setupLazyLoading(filters = {}) {
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting && !lazyLoading) {
                lazyLoading = true;
    
                fetch(window.usersFilterUrl + "?per_page=all&page=" + lazyPage, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.csrfToken
                    },
                    body: JSON.stringify(filters)
                })
                .then(res => res.text())
                .then(html => {
                    const wrapper = document.getElementById('usersContainer');
                    wrapper.insertAdjacentHTML('beforeend', html);
                    lazyPage++;
                    lazyLoading = false;
                })
                .catch(() => {
                    lazyLoading = false;
                });
            }
        }, {
            rootMargin: "0px",
            threshold: 1.0
        });
    
        const target = document.getElementById('lazyLoadTrigger');
        if (target) observer.observe(target);
    }

    const perPageSelect = document.getElementById('perPageSelect');
    perPageSelect?.addEventListener('change', function () {
        const perPage = this.value;
        const query = document.getElementById('searchInput').value;
        const role = document.getElementById('roleFilter').value;
        const sort = document.getElementById('sortSelect').value;
    
        const filters = { query, role, sort };
    
        if (perPage === 'all') {
            document.getElementById('paginationWrapper').classList.add('d-none');
            fetchUsers(filters, 1);
            setTimeout(() => setupLazyLoading(filters), 500);
        } else {
            document.getElementById('paginationWrapper').classList.remove('d-none');
            fetchUsers({ ...filters, per_page: perPage }, 1);
        }
    });

    function bindPagination() {
        document.querySelectorAll('#paginationWrapper a').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = new URL(this.href);
                const page = url.searchParams.get('page');
                const query = document.getElementById('searchInput').value;
                const role = document.getElementById('roleFilter').value;
                
                shouldScrollToTop = true;

                fetchUsers({ query, role }, page);
    
            });
        });
    }

    // Initial bind
    bindPagination();
});

function initPendingConnectionAnimations() {
    const pendingButtons = document.querySelectorAll('.pending-connection-btn');

    pendingButtons.forEach(btn => {
        const span = btn.querySelector('.pending-text');
        if (!span || btn.dataset.animated === 'true') return;

        const words = ['Connection', 'is pending'];
        let index = 0;

        setInterval(() => {
            index = (index + 1) % words.length;
            span.textContent = words[index];
        }, 2000);

        btn.dataset.animated = 'true'; // Prevent multiple intervals on same element
    });
}