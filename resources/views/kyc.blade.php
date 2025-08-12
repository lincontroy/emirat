@extends('layouts.main')
@section('content')

    <!-- KYC / PROFILE -->
    <section id="profile" class="container-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h2 class="section-title mb-0">KYC / Profile</h2>
          <p class="section-sub mb-0">Verify your identity to unlock all features</p>
        </div>
      </div>
      <article class="card">
        <div class="card-body">
          <form id="kycForm" data-endpoint="/api/kyc" enctype="multipart/form-data" novalidate>
            <div class="row g-3">
              <div class="col-12 col-md-4">
                <label for="kycId" class="form-label">Government ID</label>
                <input id="kycId" name="id" type="file" class="form-control" accept="image/*,application/pdf" required>
              </div>
              <div class="col-12 col-md-4">
                <label for="kycAddress" class="form-label">Proof of Address</label>
                <input id="kycAddress" name="address" type="file" class="form-control" accept="image/*,application/pdf" required>
              </div>
              <div class="col-12 col-md-4">
                <label for="kycPhone" class="form-label">Phone</label>
                <div class="input-group">
                  <span class="input-group-text">+971</span>
                  <input id="kycPhone" name="phone" type="tel" class="form-control" placeholder="5xxxxxxxx" required>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-success" type="submit">Submit for Verification</button>
              </div>
            </div>
          </form>
        </div>
      </article>
    </section>
@endsection