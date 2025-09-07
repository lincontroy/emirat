<!doctype html>
<html lang="en">
<head>
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emirates Special Fund MMF Dashboard</title>
  <meta name="description" content="Secure user dashboard for Emirates Special Fund MMF: balances, yields, plans, deposits, withdrawals, transactions, KYC, and support." />
  <link rel="canonical" href="/emirates-dashboard.html"/>
  <meta property="og:title" content="Emirates Special Fund MMF Dashboard" />
  <meta property="og:description" content="Track balances, yields, plans, transactions and manage KYC for Emirates Special Fund." />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="/placeholder.svg" />
  <meta name="twitter:card" content="summary_large_image" />

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      /* Elegant, trustworthy palette */
      --navy-900: #0a1230;   /* deep navy */
      --navy-700: #14204f;
      --emerald-600: #0f766e;/* emerald */
      --emerald-500: #14947c;
      --gold-500: #d4af37;   /* gold accent */
      --bg-100: #f6f8fb;     /* soft background */
      --text-900: #0e1325;
      --text-700: #2b3558;
      --sidebar-width: 280px;
    }

    html, body { height: 100%; }
    body {
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
      background: var(--bg-100);
      color: var(--text-900);
    }

    /* Layout Structure */
    .app-container {
      display: flex;
      min-height: 100vh;
    }

    /* Desktop Sidebar */
    .desktop-sidebar {
      width: var(--sidebar-width);
      background: linear-gradient(180deg, #0c163a 0%, #0a1230 100%);
      border-right: 1px solid rgba(212,175,55,0.15);
      position: fixed;
      height: 100vh;
      overflow-y: auto;
      transition: transform 0.3s ease;
      z-index: 1000;
    }

    .desktop-sidebar::-webkit-scrollbar {
      width: 6px;
    }
    
    .desktop-sidebar::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.1);
    }
    
    .desktop-sidebar::-webkit-scrollbar-thumb {
      background: rgba(212,175,55,0.3);
      border-radius: 3px;
    }

    /* Main content area */
    .main-content {
      flex: 1;
      margin-left: var(--sidebar-width);
      transition: margin-left 0.3s ease;
    }

    /* Top navbar */
    .app-navbar {
      background: linear-gradient(135deg, var(--navy-900), var(--navy-700));
      color: #fff;
      box-shadow: 0 4px 24px rgba(10, 18, 48, 0.25);
    }
    .brand-mark { color: var(--gold-500); font-weight: 700; letter-spacing: .3px; }

    /* Sidebar styles */
    .sidebar-header {
      padding: 1.5rem;
      border-bottom: 1px solid rgba(212,175,55,0.15);
      background: rgba(212,175,55,0.05);
    }

    .sidebar-brand {
      color: #fff;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .sidebar-brand:hover {
      color: var(--gold-500);
    }

    .sidebar-nav {
      padding: 1rem 0;
    }

    .sidebar-nav .nav-link {
      color: #cbd4ff;
      padding: 0.875rem 1.5rem;
      border: none;
      border-radius: 0;
      border-left: 3px solid transparent;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .sidebar-nav .nav-link:hover {
      color: #fff;
      background: rgba(20,148,124,0.1);
      border-left-color: var(--emerald-500);
      transform: translateX(2px);
    }

    .sidebar-nav .nav-link.active {
      color: #fff;
      background: rgba(20,148,124,0.15);
      border-left-color: var(--emerald-500);
      box-shadow: inset 0 0 10px rgba(20,148,124,0.1);
    }

    .sidebar-nav .nav-link i {
      width: 20px;
      text-align: center;
    }

    .sidebar-section {
      padding: 0.5rem 1.5rem;
      color: var(--gold-500);
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 1rem;
    }

    .sidebar-logout {
      margin-top: auto;
      padding: 1rem;
      border-top: 1px solid rgba(212,175,55,0.15);
    }

    .sidebar-logout .nav-link {
      color: #ff6b6b;
      justify-content: center;
      background: rgba(255,107,107,0.1);
      border-radius: 8px;
      margin: 0;
    }

    .sidebar-logout .nav-link:hover {
      background: rgba(255,107,107,0.2);
      transform: none;
      border-left-color: transparent;
    }

    /* Mobile offcanvas (unchanged for mobile) */
    .mobile-sidebar {
      background: #0c163a;
      border-right: 1px solid rgba(212,175,55,0.15);
    }
    .mobile-sidebar .nav-link { color: #cbd4ff; }
    .mobile-sidebar .nav-link.active, .mobile-sidebar .nav-link:hover {
      color: #fff;
      background: rgba(20,148,124,0.15);
      border-left: 3px solid var(--emerald-500);
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
      .desktop-sidebar {
        transform: translateX(-100%);
      }
      
      .main-content {
        margin-left: 0;
      }
    }

    @media (min-width: 992px) {
      .mobile-nav-toggle {
        display: none !important;
      }
    }

    /* Cards */
    .card {
      border: 1px solid rgba(10, 18, 48, 0.08);
      border-radius: 14px;
      box-shadow: 0 10px 24px rgba(10,18,48,0.06);
    }
    .metric { font-size: clamp(1.25rem, 1.1rem + 1.2vw, 2rem); font-weight: 700; color: var(--text-900); }
    .metric-sub { color: var(--text-700); font-size: .9rem; }
    .badge-gold { background: linear-gradient(135deg, #e5c85f, var(--gold-500)); color: #1f2436; }
    .badge-emerald { background: linear-gradient(135deg, #18b49b, var(--emerald-600)); }

    /* Quick actions */
    .action-btn {
      border-radius: 10px;
      transition: transform .15s ease, box-shadow .15s ease;
    }
    .action-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 16px rgba(20,148,124,0.25); }

    /* Section headings */
    .section-title { color: var(--text-900); font-weight: 700; }
    .section-sub { color: var(--text-700); }

    /* Table tweaks */
    .table thead th { background: #f1f3f9; }

    /* Accessibility utility */
    .visually-hidden-focusable:active, .visually-hidden-focusable:focus {
      position: static; width: auto; height: auto; overflow: visible; clip: auto; white-space: normal;
    }

    /* Demo dashboard content */
    .dashboard-content {
      padding: 2rem;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: #fff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 4px 12px rgba(10,18,48,0.08);
      border-left: 4px solid var(--emerald-500);
    }

    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      color: var(--navy-900);
      margin: 0;
    }

    .stat-label {
      color: var(--text-700);
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="app-container">
    <!-- Desktop Sidebar -->
    <nav class="desktop-sidebar d-none d-lg-flex flex-column" role="navigation" aria-label="Desktop Navigation">
      <div class="sidebar-header">
        <a href="#dashboard" class="sidebar-brand">
          <i class="bi bi-shield-check text-warning fs-4"></i>
          <div>
            <div class="brand-mark fs-5">Emirates</div>
            
          </div>
        </a>
      </div>

      <div class="flex-grow-1 d-flex flex-column">
        <div class="sidebar-nav flex-grow-1">
          <div class="sidebar-section">Overview</div>
          <a class="nav-link active" href="/dashboard">
            <i class="bi bi-speedometer2"></i>Dashboard
          </a>
          <a class="nav-link" href="/plans">
            <i class="bi bi-pie-chart-fill"></i>Investments
          </a>

          <div class="sidebar-section">Trading</div>
          <a class="nav-link" href="/plans">
            <i class="bi bi-lock-fill"></i>Plans / Lock-in
          </a>
          <a class="nav-link" href="/deposit">
            <i class="bi bi-arrow-down-circle"></i>Deposit
          </a>
          <a class="nav-link" href="/withdraw">
            <i class="bi bi-arrow-up-circle"></i>Withdraw
          </a>

          <div class="sidebar-section">History</div>
          <a class="nav-link" href="/transactions">
            <i class="bi bi-table"></i>Transactions
          </a>

          <div class="sidebar-section">Account</div>
          <a class="nav-link" href="/kyc">
            <i class="bi bi-person-badge"></i>KYC / Profile
          </a>
        

          <div class="sidebar-section">Support</div>
          <a class="nav-link" href="/support">
            <i class="bi bi-life-preserver"></i>Support
          </a>
          
        </div>

        <div class="sidebar-logout">
          <a href="#" class="nav-link" id="logoutBtn">
            <i class="bi bi-box-arrow-right"></i>Logout
          </a>
        </div>
      </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
      <!-- Top navbar (for mobile toggle and user info) -->
      <header class="navbar navbar-expand-lg app-navbar sticky-top" role="banner" aria-label="Top Navigation">
        <div class="container-fluid px-3">
          <button class="btn btn-outline-light me-2 d-lg-none mobile-nav-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-label="Open navigation">
            <i class="bi bi-list"></i>
          </button>
          <a class="navbar-brand d-flex align-items-center gap-2 text-white d-lg-none" href="#dashboard">
            <i class="bi bi-shield-check text-warning"></i>
            <span class="brand-mark">Emirates</span>
            
          </a>
          
          <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white-50 d-none d-md-inline">Welcome back, {{auth()->user()->name}}</span>
            <div class="dropdown">
              <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#profile"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#settings"><i class="bi bi-gear me-2"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#" id="topLogoutBtn"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </header>

      <!-- Main Content -->
      <main class="dashboard-content" id="mainContent">
       
        <!-- DASHBOARD / HOME -->
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Mobile Sidebar (Offcanvas) -->
  <div class="offcanvas offcanvas-start text-bg-dark mobile-sidebar" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="mobileSidebarLabel">Navigation</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
      <nav class="nav flex-column p-2" role="navigation" aria-label="Mobile Navigation">
        <a class="nav-link px-3 py-2 active" href="/dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
        <a class="nav-link px-3 py-2" href="/plans"><i class="bi bi-lock-fill me-2"></i>Plans / Lock-in</a>
        <a class="nav-link px-3 py-2" href="/deposit"><i class="bi bi-arrow-down-circle me-2"></i>Deposit</a>
        <a class="nav-link px-3 py-2" href="/withdraw"><i class="bi bi-arrow-up-circle me-2"></i>Withdraw</a>
        <a class="nav-link px-3 py-2" href="/transactions"><i class="bi bi-table me-2"></i>Transactions</a>
        <a class="nav-link px-3 py-2" href="/plans"><i class="bi bi-pie-chart-fill me-2"></i>Investments</a>
        <a class="nav-link px-3 py-2" href="/kyc"><i class="bi bi-person-badge me-2"></i>KYC / Profile</a>
        <a class="nav-link px-3 py-2" href="/settings"><i class="bi bi-gear me-2"></i>Settings</a>
        <a class="nav-link px-3 py-2" href="/support"><i class="bi bi-life-preserver me-2"></i>Support</a>
        <a class="nav-link px-3 py-2" href="/notifications"><i class="bi bi-bell-fill me-2"></i>Notifications</a>

        <hr>

        <!-- Logout -->
        <a href="#" class="nav-link px-3 py-2 text-danger" id="mobileLogoutBtn">
          <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
      </nav>
    </div>
  </div>

  <!-- DEPOSIT MODAL -->
  <div class="modal fade" id="depositModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="depositFormModal" data-endpoint="/api/deposit" novalidate>
          <div class="modal-header">
            <h5 class="modal-title">Deposit Funds</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="mDepAmount" class="form-label">Amount (USD)</label>
              <input id="mDepAmount" name="amount" type="number" min="1" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="mDepSource" class="form-label">Source</label>
              <select id="mDepSource" name="source" class="form-select" required>
                <option value="" selected disabled>Select source</option>
                <option>Bank</option>
                <option>MPESA</option>
                <option>Card</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Confirm Deposit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- WITHDRAW MODAL -->
  <div class="modal fade" id="withdrawModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="withdrawFormModal" data-endpoint="/api/withdraw" novalidate>
          <div class="modal-header">
            <h5 class="modal-title">Withdraw Funds</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="mWdAmount" class="form-label">Amount (USD)</label>
              <input id="mWdAmount" name="amount" type="number" min="1" step="0.01" class="form-control" required>
              <div class="form-text">Available: <span id="mAvailableText">$10,240.50</span></div>
            </div>
            <div class="mb-3">
              <label for="mWdDestination" class="form-label">Destination</label>
              <select id="mWdDestination" name="destination" class="form-select" required>
                <option value="" selected disabled>Select destination</option>
                <option>Bank</option>
                <option>MPESA</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Confirm Withdrawal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- LOCK / SUBSCRIBE MODAL -->
  <div class="modal fade" id="lockModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="lockForm" data-endpoint="/api/lock" novalidate>
          <div class="modal-header">
            <h5 class="modal-title">Lock Funds</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="lockPlan" class="form-label">Plan</label>
              <select id="lockPlan" name="plan" class="form-select" required>
                <option value="" selected disabled>Select a plan</option>
                <option value="7-day">7-day</option>
                <option value="30-day">30-day</option>
                <option value="6-month">6-month</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="lockAmount" class="form-label">Amount (USD)</label>
              <input id="lockAmount" name="amount" type="number" min="1" step="0.01" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">Confirm Lock</button>
          </div>
        </form>
      </div>
    </div>
  </div>




  <!-- Hidden logout form -->
  <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  
  <!-- Floating WhatsApp Button -->
<a href="https://wa.me/447446970806"
class="whatsapp-float"
target="_blank"
rel="noopener"
aria-label="Chat with us on WhatsApp">
<!-- WhatsApp SVG icon -->
<svg viewBox="0 0 32 32" width="26" height="26" aria-hidden="true">
 <path fill="#fff" d="M19.11 17.57c-.28-.14-1.63-.8-1.88-.89-.25-.09-.43-.14-.62.14-.18.27-.71.89-.87 1.07-.16.18-.32.2-.6.07-.28-.14-1.16-.43-2.2-1.38-.81-.72-1.36-1.6-1.52-1.87-.16-.27-.02-.41.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.62-1.49-.85-2.04-.22-.53-.45-.46-.62-.46-.16 0-.34-.02-.52-.02-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.29s.99 2.66 1.13 2.84c.14.18 1.95 2.98 4.72 4.18.66.28 1.18.45 1.58.58.66.21 1.25.18 1.72.11.53-.08 1.63-.66 1.86-1.31.23-.64.23-1.19.16-1.31-.07-.11-.25-.18-.53-.32z"/>
 <path fill="#25D366" d="M27.63 4.37A15.94 15.94 0 0 0 16 .03C7.19.03.05 7.17.05 16c0 2.8.73 5.58 2.12 8.02L.03 32l8.2-2.11A15.87 15.87 0 0 0 16 31.95c8.83 0 15.97-7.14 15.97-15.97 0-4.27-1.66-8.28-4.34-11.61zM16 29.37c-2.56 0-5.02-.69-7.19-2l-.51-.3-4.87 1.25 1.3-4.75-.33-.54A13.35 13.35 0 1 1 29.35 16 13.36 13.36 0 0 1 16 29.37z"/>
</svg>
</a>

<style>
.whatsapp-float{
 position: fixed;
 left: 16px;
 bottom: 16px;
 width: 56px;
 height: 56px;
 background: #25D366;
 color: #fff;
 border-radius: 50%;
 display: inline-flex;
 align-items: center;
 justify-content: center;
 box-shadow: 0 8px 24px rgba(0,0,0,.2);
 text-decoration: none;
 z-index: 9999;
 transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
}
.whatsapp-float:hover{
 transform: translateY(-2px);
 box-shadow: 0 12px 28px rgba(0,0,0,.25);
}
/* subtle pulse to attract attention */
.whatsapp-float::after{
 content: "";
 position: absolute;
 inset: 0;
 border-radius: 50%;
 box-shadow: 0 0 0 0 rgba(37,211,102,.5);
 animation: wpp-pulse 2s infinite;
}
@keyframes wpp-pulse{
 0% { box-shadow: 0 0 0 0 rgba(37,211,102,.5); }
 70% { box-shadow: 0 0 0 14px rgba(37,211,102,0); }
 100% { box-shadow: 0 0 0 0 rgba(37,211,102,0); }
}
/* respect users who prefer reduced motion */
@media (prefers-reduced-motion: reduce){
 .whatsapp-float,
 .whatsapp-float::after{
   animation: none !important;
   transition: none !important;
 }
}
</style>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // DOM Elements
    const elements = {
      sidebarLinks: document.querySelectorAll('.sidebar-nav .nav-link, .mobile-sidebar .nav-link'),
      lockPlanButtons: document.querySelectorAll('[data-bs-target="#lockModal"][data-plan]'),
      filterElements: {
        from: document.getElementById('filterFrom'),
        to: document.getElementById('filterTo'),
        type: document.getElementById('filterType'),
        minAmt: document.getElementById('filterMinAmt'),
        apply: document.getElementById('applyFilters'),
        clear: document.getElementById('clearFilters')
      },
      exportButtons: document.querySelectorAll('[data-action="export"]'),
      availableBalance: document.getElementById('availableBalance'),
      availableTexts: {
        page: document.getElementById('availableText'),
        modal: document.getElementById('mAvailableText')
      },
      transactionFilters: {
        search: document.getElementById('txSearch'),
        from: document.getElementById('txFrom'),
        to: document.getElementById('txTo'),
        type: document.getElementById('txType'),
        min: document.getElementById('txMin')
      }
    };

    // Utility Functions
    const utils = {
      formatUSD: (value) => {
        return value.toLocaleString(undefined, { 
          style: 'currency', 
          currency: 'USD',
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        });
      },
      getAvailableBalance: () => {
        const raw = elements.availableBalance ? 
          parseFloat(elements.availableBalance.getAttribute('data-available')) : 10240.50;
        return isNaN(raw) ? 10240.50 : raw;
      },
      exportTableToCSV: (tableSelector, filename) => {
        try {
          const rows = Array.from(document.querySelectorAll(`${tableSelector} tr`));
          const csvContent = rows.map(row => 
            Array.from(row.cells)
              .map(cell => `"${cell.innerText.replace(/"/g, '""')}"`)
              .join(',')
          ).join('\n');
          
          const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
          const link = document.createElement('a');
          link.href = URL.createObjectURL(blob);
          link.download = filename;
          link.click();
        } catch (error) {
          console.error('Export failed:', error);
          alert('Failed to export CSV. Please try again.');
        }
      }
    };

    // Navigation Functions
    const navigation = {
      setActiveNav: () => {
        const hash = window.location.hash || '#dashboard';
        elements.sidebarLinks.forEach(link => {
          const isActive = link.getAttribute('href') === hash;
          link.classList.toggle('active', isActive);
        });
      }
    };

    // Initialize
    const init = () => {
      // Navigation
      window.addEventListener('hashchange', navigation.setActiveNav);
      navigation.setActiveNav();

      // Lock Plan Prefill
      if (elements.lockPlanButtons) {
        elements.lockPlanButtons.forEach(button => {
          button.addEventListener('click', () => {
            const plan = button.getAttribute('data-plan');
            const select = document.getElementById('lockPlan');
            if (select) select.value = plan;
          });
        });
      }

      // Export Buttons
      if (elements.exportButtons) {
        elements.exportButtons.forEach(button => {
          button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            const format = button.getAttribute('data-format');
            
            if (format === 'csv') {
              utils.exportTableToCSV(target, 'transactions.csv');
            } else if (format === 'pdf') {
              alert('PDF export would be implemented here with jsPDF or a server call');
            }
          });
        });
      }

      // Available Balance Display
      const availableBalance = utils.getAvailableBalance();
      if (elements.availableTexts.page) {
        elements.availableTexts.page.textContent = utils.formatUSD(availableBalance);
      }
      if (elements.availableTexts.modal) {
        elements.availableTexts.modal.textContent = utils.formatUSD(availableBalance);
      }

      // Transaction Table Filters
      Object.values(elements.transactionFilters).forEach(element => {
        if (element) {
          element.addEventListener('input', () => {
            // Filter logic would go here
          });
          element.addEventListener('change', () => {
            // Filter logic would go here
          });
        }
      });
    };

    // Start the application
    init();
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68a4595f93bb0e191e62546e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<script>
// Multiple logout buttons handler
const logoutButtons = ['logoutBtn', 'topLogoutBtn', 'mobileLogoutBtn'];

logoutButtons.forEach(buttonId => {
  const button = document.getElementById(buttonId);
  if (button) {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out of your account.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, logout'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    });
  }
});
</script>
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach`,
        confirmButtonText: 'OK'
    });
</script>

@endif

</body>
</html>