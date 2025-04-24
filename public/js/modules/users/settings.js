document.addEventListener('DOMContentLoaded', function () {

    let shouldScrollToTop = false;

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

    document.getElementById('searchInput').addEventListener('input', function () {
        const query = this.value;
        const role = document.getElementById('roleFilter').value;
        fetchUsers({ query, role });
    });

    document.getElementById('roleFilter').addEventListener('change', function () {
        const query = document.getElementById('searchInput').value;
        fetchUsers({ query, role: this.value });
    });

    document.getElementById('perPageSelect').addEventListener('change', function () {
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
    
        fetchUsers(getFilters());
    });

    let currentRelationFilter = null;

    const btnFollow = document.getElementById('filterFollowingBtn');
    const btnConnect = document.getElementById('filterConnectedBtn');
    
    btnFollow?.addEventListener('click', function () {
        if (currentRelationFilter === 'following') {
            currentRelationFilter = null;
            btnFollow.classList.remove('active');
        } else {
            currentRelationFilter = 'following';
            btnFollow.classList.add('active');
            btnConnect.classList.remove('active');
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
        }
        fetchUsers(getFilters());
    });
    
    function getFilters() {
        return {
            query: document.getElementById('searchInput').value,
            role: document.getElementById('roleFilter').value,
            sort: document.getElementById('sortSelect')?.value,
            relation: currentRelationFilter
        };
    }

    document.getElementById('sortSelect').addEventListener('change', function () {
        const query = document.getElementById('searchInput').value;
        const role = document.getElementById('roleFilter').value;
        fetchUsers({ query, role });
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.follow-btn')) {
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
    
                btn.textContent = data.status === 'followed' ? 'Unfollow' : 'Follow';
    
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
                btn.textContent = 'Pending';
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
        if (e.target.matches('.btn-accept')) {
            e.preventDefault();
            e.stopPropagation();
    
            const id = e.target.dataset.id;
    
            fetch(`/connections/accept/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message, 'success');
                e.target.closest('.notification-item').remove();
            });
        }
    
        if (e.target.matches('.btn-deny')) {
            e.preventDefault();
            e.stopPropagation();
    
            const id = e.target.dataset.id;
    
            fetch(`/connections/deny/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message, 'danger');
                e.target.closest('.notification-item').remove();
            });
        }
    });

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