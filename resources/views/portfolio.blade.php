@extends('layouts.main')
@section('content')
<section id="investments" class="container-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h2 class="section-title mb-0">Investments</h2>
          <p class="section-sub mb-0">Breakdown and projected earnings</p>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-12 col-lg-6">
          <article class="card h-100">
            <div class="card-header bg-transparent fw-semibold">By Plan</div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">7-day <span class="badge text-bg-secondary">$2,000</span></li>
                <li class="list-group-item d-flex justify-content-between align-items-center">30-day <span class="badge text-bg-secondary">$3,000</span></li>
                <li class="list-group-item d-flex justify-content-between align-items-center">Liquid <span class="badge text-bg-secondary">$10,240.50</span></li>
              </ul>
            </div>
          </article>
        </div>
        <div class="col-12 col-lg-6">
          <article class="card h-100">
            <div class="card-header bg-transparent fw-semibold">Projected Earnings</div>
            <div class="card-body">
              <p class="mb-1">Next 30 days</p>
              <div class="metric">$124.70</div>
              <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 42%" role="progressbar" aria-label="Projected earnings progress" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </article>
        </div>
        <div class="col-12">
          <article class="card">
            <div class="card-header bg-transparent fw-semibold">Maturity Calendar</div>
            <div class="card-body">
              <ul class="list-inline small mb-0">
                <li class="list-inline-item me-4"><i class="bi bi-calendar-event me-1 text-success"></i> 7-day lock matures: <strong>Aug 17, 2025</strong></li>
                <li class="list-inline-item"><i class="bi bi-calendar-event me-1 text-success"></i> 30-day lock matures: <strong>Sep 9, 2025</strong></li>
              </ul>
            </div>
          </article>
        </div>
      </div>
    </section>
@endsection