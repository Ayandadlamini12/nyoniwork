document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const sidebar = document.getElementById('appSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const modeToggle = document.getElementById('modeToggle');
    const legacyFrame = document.getElementById('legacyFrame');
    const legacyLoader = document.getElementById('legacyLoader');
    const moduleButtons = document.querySelectorAll('.js-load-module');

    // Handle sidebar toggle (mobile + desktop collapse)
    sidebarToggle?.addEventListener('click', () => {
        if (window.innerWidth <= 1024) {
            sidebar?.classList.toggle('revealed');
        } else {
            sidebar?.classList.toggle('collapsed');
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            sidebar?.classList.remove('revealed');
        }
    });

    // Dark / light mode persistence
    const storedTheme = localStorage.getItem('helentor-admin-theme');
    if (storedTheme) {
        body.setAttribute('data-theme', storedTheme);
        updateModeIcon(storedTheme);
    }

    // Legacy module loader
    moduleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const moduleName = btn.getAttribute('data-module');
            if (!moduleName || !legacyFrame) return;

            moduleButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            showLegacyLoader(true);

            const targetUrl = `../app-content/${moduleName}.php`;
            legacyFrame.setAttribute('src', targetUrl);
        });
    });

    if (legacyFrame) {
        legacyFrame.addEventListener('load', () => showLegacyLoader(false));
    }

    function showLegacyLoader(show) {
        if (!legacyLoader) return;
        if (show) {
            legacyLoader.classList.remove('hidden');
        } else {
            legacyLoader.classList.add('hidden');
        }
    }

    modeToggle?.addEventListener('click', () => {
        const current = body.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
        const nextTheme = current === 'dark' ? 'light' : 'dark';
        body.setAttribute('data-theme', nextTheme);
        localStorage.setItem('helentor-admin-theme', nextTheme);
        updateModeIcon(nextTheme);
    });

    function updateModeIcon(theme) {
        if (!modeToggle) return;
        modeToggle.innerHTML = theme === 'dark'
            ? '<i class="ri-sun-line"></i>'
            : '<i class="ri-moon-line"></i>';
    }

    // Charts (using Chart.js)
    const perfCtx = document.getElementById('performanceChart');
    if (perfCtx) {
        new Chart(perfCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
                datasets: [{
                    label: 'Unique Visitors',
                    data: [320, 410, 460, 520, 480],
                    fill: true,
                    borderColor: '#e3dc19',
                    backgroundColor: 'rgba(227, 220, 25, 0.15)',
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#e3dc19'
                }, {
                    label: 'Engaged Sessions',
                    data: [210, 280, 360, 400, 420],
                    fill: false,
                    borderColor: '#5f8450',
                    tension: 0.4,
                    borderDash: [6, 6],
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, align: 'start' }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(15, 23, 42, 0.08)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    const trafficCtx = document.getElementById('trafficChart');
    if (trafficCtx) {
        new Chart(trafficCtx, {
            type: 'doughnut',
            data: {
                labels: ['Organic', 'Paid', 'Social', 'Referral'],
                datasets: [{
                    data: [45, 20, 25, 10],
                    backgroundColor: ['#e3dc19', '#5f8450', '#405a76', '#f1b02b'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true }
                    }
                }
            }
        });
    }
});
