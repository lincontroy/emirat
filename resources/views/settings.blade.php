@extends('layouts.main')
@section('content')
  <!-- SETTINGS -->
  <section id="settings" class="container-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h2 class="section-title mb-0">Settings</h2>
          <p class="section-sub mb-0">Security, notifications and accounts</p>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-12 col-lg-6">
          <article class="card h-100">
            <div class="card-header bg-transparent fw-semibold">Security</div>
            <div class="card-body">
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="twoFA">
                <label class="form-check-label" for="twoFA">Enable 2FA</label>
              </div>
              <button class="btn btn-outline-primary btn-sm" data-action="setup-2fa">Setup 2FA</button>
            </div>
          </article>
        </div>
        <div class="col-12 col-lg-6">
          <article class="card h-100">
            <div class="card-header bg-transparent fw-semibold">Notifications</div>
            <div class="card-body">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifDeposits" checked>
                <label class="form-check-label" for="notifDeposits">Deposit updates</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifMaturity" checked>
                <label class="form-check-label" for="notifMaturity">Maturity & payouts</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifMarketing">
                <label class="form-check-label" for="notifMarketing">Market insights</label>
              </div>
            </div>
          </article>
        </div>
        <div class="col-12">
          <article class="card">
            <div class="card-header bg-transparent fw-semibold">Bank / Account Management</div>
            <div class="card-body">
              <form id="bankForm" data-endpoint="/api/banks" novalidate>
                <div class="row g-3">
                  <div class="col-12 col-md-4">
                    <label for="bankName" class="form-label">Bank Name</label>
                    <input id="bankName" name="bank" class="form-control" placeholder="e.g., Emirates NBD" required>
                  </div>
                  <div class="col-12 col-md-4">
                    <label for="accNumber" class="form-label">Account Number</label>
                    <input id="accNumber" name="account" class="form-control" placeholder="XXXX-XXXX" required>
                  </div>
                  <div class="col-12 col-md-4 d-flex align-items-end">
                    <button class="btn btn-outline-success w-100" type="submit">Save Account</button>
                  </div>
                </div>
              </form>
            </div>
          </article>
        </div>
      </div>
    </section>
@endsection