<section id="plans" class="container-xxl pt-5">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <h2 class="section-title mb-1 text-gradient-primary">Investment Plans</h2>
      <p class="section-sub mb-0 text-muted">Lock your funds to earn higher yields</p>
    </div>
    <div class="d-none d-md-block">
      <span class="badge bg-light text-dark">
        <i class="bi bi-star-fill text-warning me-1"></i>
        Most Popular: 30-day Plan
      </span>
    </div>
  </div>

  <div class="row g-4">
    <!-- 7-day Plan -->
    <div class="col-12 col-md-4">
      <article class="card h-100 border-0 shadow-sm plan-card plan-basic">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <h3 class="h4 mb-0">7-day Lock</h3>
            <span class="badge bg-light-blue text-blue rounded-pill">Short Term</span>
          </div>
          <div class="mb-4">
            <span class="display-5 fw-bold text-blue">5.0%</span>
            <span class="text-muted">APY</span>
          </div>
          <ul class="list-unstyled plan-features mb-4">
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              <span>Expected yield: <strong>0.9%</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-currency-dollar text-blue me-2"></i>
              <span>Min deposit: <strong>$100</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
              <span>Early withdrawal: <strong>0.3% penalty</strong></span>
            </li>
            <li class="d-flex align-items-center">
              <i class="bi bi-lightning-charge-fill text-purple me-2"></i>
              <span>Instant reinvestment</span>
            </li>
          </ul>
          <button class="btn btn-outline-blue w-100 py-2 fw-bold" 
                  data-bs-toggle="modal" 
                  data-bs-target="#lockModal" 
                  data-plan="7-day" 
                  aria-label="Subscribe to 7-day plan">
            <i class="bi bi-lock-fill me-2"></i>Start Earning
          </button>
        </div>
        <div class="card-footer bg-light-blue border-0 py-3">
          <small class="text-muted d-flex justify-content-center">
            <i class="bi bi-clock-history me-2"></i>
            Flexible short-term option
          </small>
        </div>
      </article>
    </div>

    <!-- 30-day Plan (Featured) -->
    <div class="col-12 col-md-4">
      <article class="card h-100 border-0 shadow-lg plan-card plan-popular">
        <div class="card-header bg-gradient-primary text-white border-0 py-3">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="h4 mb-0">30-day Lock</h3>
            <span class="badge bg-white text-primary rounded-pill">Most Popular</span>
          </div>
        </div>
        <div class="card-body p-4">
          <div class="mb-4">
            <span class="display-5 fw-bold text-primary">6.5%</span>
            <span class="text-muted">APY</span>
          </div>
          <ul class="list-unstyled plan-features mb-4">
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              <span>Expected yield: <strong>2.6%</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-currency-dollar text-primary me-2"></i>
              <span>Min deposit: <strong>$250</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
              <span>Early withdrawal: <strong>0.8% penalty</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-graph-up-arrow text-success me-2"></i>
              <span>Higher returns than savings</span>
            </li>
            <li class="d-flex align-items-center">
              <i class="bi bi-gift-fill text-danger me-2"></i>
              <span>Bonus +0.5% for auto-renewal</span>
            </li>
          </ul>
          <button class="btn btn-primary w-100 py-2 fw-bold" 
                  data-bs-toggle="modal" 
                  data-bs-target="#lockModal" 
                  data-plan="30-day" 
                  aria-label="Subscribe to 30-day plan">
            <i class="bi bi-lightning me-2"></i>Get Premium Yield
          </button>
        </div>
        <div class="card-footer bg-light-primary border-0 py-3">
          <small class="text-primary d-flex justify-content-center">
            <i class="bi bi-award me-2"></i>
            Best value for most investors
          </small>
        </div>
      </article>
    </div>

    <!-- 6-month Plan -->
    <div class="col-12 col-md-4">
      <article class="card h-100 border-0 shadow-sm plan-card plan-premium">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <h3 class="h4 mb-0">6-month Lock</h3>
            <span class="badge bg-light-purple text-purple rounded-pill">Long Term</span>
          </div>
          <div class="mb-4">
            <span class="display-5 fw-bold text-purple">8.1%</span>
            <span class="text-muted">APY</span>
          </div>
          <ul class="list-unstyled plan-features mb-4">
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              <span>Expected yield: <strong>4.1%</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-currency-dollar text-purple me-2"></i>
              <span>Min deposit: <strong>$500</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
              <span>Early withdrawal: <strong>1.5% penalty</strong></span>
            </li>
            <li class="mb-2 d-flex align-items-center">
              <i class="bi bi-arrow-up-right-circle-fill text-success me-2"></i>
              <span>Highest APY available</span>
            </li>
            <li class="d-flex align-items-center">
              <i class="bi bi-shield-lock-fill text-blue me-2"></i>
              <span>Priority customer support</span>
            </li>
          </ul>
          <button class="btn btn-outline-purple w-100 py-2 fw-bold" 
                  data-bs-toggle="modal" 
                  data-bs-target="#lockModal" 
                  data-plan="6-month" 
                  aria-label="Subscribe to 6-month plan">
            <i class="bi bi-trophy-fill me-2"></i>Maximize Returns
          </button>
        </div>
        <div class="card-footer bg-light-purple border-0 py-3">
          <small class="text-muted d-flex justify-content-center">
            <i class="bi bi-calendar-check me-2"></i>
            Ideal for long-term investors
          </small>
        </div>
      </article>
    </div>
  </div>

  <div class="text-center mt-4">
    <button class="btn btn-link text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#planDetails">
      <i class="bi bi-info-circle me-2"></i>How do these plans work?
    </button>
    <div class="collapse mt-2" id="planDetails">
      <div class="card card-body bg-light border-0 text-start">
        <p class="mb-2">Our lock-in plans allow you to earn higher yields by committing your funds for specific periods.</p>
        <ul class="mb-1">
          <li>Funds remain liquid but earn more when locked</li>
          <li>Early withdrawals are possible with a small penalty</li>
          <li>Yields are calculated daily and paid at maturity</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<style>
  /* Custom plan card styling */
  .plan-card {
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .plan-card:hover {
    transform: translateY(-5px);
  }
  .plan-popular {
    border: 2px solid #4e73df !important;
  }
  
  /* Color scheme */
  .text-gradient-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
  }
  .bg-light-blue { background-color: #f0f7ff; }
  .bg-light-primary { background-color: #f5f9ff; }
  .bg-light-purple { background-color: #f8f5ff; }
  .text-blue { color: #4e73df; }
  .text-purple { color: #6f42c1; }
  
  /* Plan specific colors */
  .plan-basic {
    border-top: 4px solid #4e73df;
  }
  .plan-popular {
    border-top: 4px solid #224abe;
  }
  .plan-premium {
    border-top: 4px solid #6f42c1;
  }
  
  /* Feature list styling */
  .plan-features li {
    padding: 4px 0;
  }
</style>