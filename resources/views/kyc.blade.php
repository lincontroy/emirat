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
      
      @if(session('status') === 'kyc-submitted')
        <div class="alert alert-success">
          Your KYC documents have been submitted for verification.
        </div>
      @endif
      
      <article class="card">
        <div class="card-body">
          <form id="kycForm" action="{{ route('kyc.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
              <div class="col-12 col-md-4">
                <label for="kycIdFront" class="form-label">ID/DL Front</label>
                <input id="kycIdFront" name="id_front" type="file" class="form-control" accept="image/*" required>
                <small class="text-muted">Clear photo of the front of your ID or Driver's License</small>
                @error('id_front')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="col-12 col-md-4">
                <label for="kycIdBack" class="form-label">ID/DL Back</label>
                <input id="kycIdBack" name="id_back" type="file" class="form-control" accept="image/*" required>
                <small class="text-muted">Clear photo of the back of your ID or Driver's License</small>
                @error('id_back')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="col-12 col-md-4">
                <label for="kycSelfie" class="form-label">Selfie with ID</label>
                <input id="kycSelfie" name="selfie" type="file" class="form-control" accept="image/*" required>
                <small class="text-muted">Your face clearly visible holding your ID</small>
                @error('selfie')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
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