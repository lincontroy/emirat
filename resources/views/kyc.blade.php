@extends('layouts.main')
@section('content')

    <!-- KYC / PROFILE -->
    <section id="profile" class="container-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
          <h2 class="section-title mb-1">KYC Verification</h2>
       
        </div>
        
        @auth
          <div class="kyc-status-badge">
            @if(auth()->user()->kyc_status === 'approved')
              <span class="badge bg-success rounded-pill px-3 py-2">
                <i class="fas fa-check-circle me-1"></i> Verified
              </span>
            @elseif(auth()->user()->kyc_status === 'pending')
              <span class="badge bg-warning rounded-pill px-3 py-2">
                <i class="fas fa-clock me-1"></i> Under Review
              </span>
            @elseif(auth()->user()->kyc_status === 'rejected')
              <span class="badge bg-danger rounded-pill px-3 py-2">
                <i class="fas fa-exclamation-circle me-1"></i> Requires Update
              </span>
            @else
              <span class="badge bg-secondary rounded-pill px-3 py-2">
                <i class="fas fa-exclamation-triangle me-1"></i> Not Submitted
              </span>
            @endif
          </div>
        @endauth
      </div>
      
      <!-- Status Alerts -->
      @if(session('status') === 'kyc-submitted')
        <div class="alert alert-success alert-dismissible fade show">
          <i class="fas fa-check-circle me-2"></i>
          Your KYC documents have been submitted for verification. Processing typically takes 1-3 business days.
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      
      @if(auth()->user()->kyc_status === 'rejected' && auth()->user()->kyc_rejection_reason)
        <div class="alert alert-danger alert-dismissible fade show">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <strong>Verification Failed:</strong> {{ auth()->user()->kyc_rejection_reason }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      
      <article class="card shadow-sm">
        <div class="card-body p-4">
          @if(auth()->user()->kyc_status === 'approved')
            <div class="kyc-approved text-center py-4">
              <div class="mb-3">
                <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
              </div>
              <h4 class="mb-2">Identity Verified</h4>
              @auth
    <p class="text-muted mb-4">
        @php
            $verifiedAt = auth()->user()->kyc_verified_at;
        @endphp

        @if($verifiedAt && $verifiedAt instanceof DateTimeInterface)
            <i class="fas fa-check-circle text-success me-2"></i>
            Verified on {{ $verifiedAt->format('M d, Y') }}
       
        @endif
    </p>
@endauth
             
            </div>
            
          @else
            <div class="kyc-form">
              <h5 class="card-title mb-4">
                @if(auth()->user()->kyc_status === 'pending')
                  <i class="fas fa-hourglass-half text-warning me-2"></i> Verification in Progress
                @else
                  <i class="fas fa-id-card-alt text-primary me-2"></i> Complete Your Verification
                @endif
              </h5>
              
              <form id="kycForm" action="{{ route('kyc.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                  <!-- ID Front -->
                  <div class="col-12 col-md-4">
                    <div class="file-upload-card">
                      <label for="kycIdFront" class="form-label fw-semibold">Government ID Front</label>
                      <div class="file-upload-input">
                        <input id="kycIdFront" name="id_front" type="file" class="form-control" accept="image/*,.pdf" required>
                        <div class="file-preview mt-2" id="idFrontPreview"></div>
                      </div>
                      <small class="text-muted">Upload a clear photo of the front side (JPEG, PNG, or PDF)</small>
                      @error('id_front')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- ID Back -->
                  <div class="col-12 col-md-4">
                    <div class="file-upload-card">
                      <label for="kycIdBack" class="form-label fw-semibold">Government ID Back</label>
                      <div class="file-upload-input">
                        <input id="kycIdBack" name="id_back" type="file" class="form-control" accept="image/*,.pdf" required>
                        <div class="file-preview mt-2" id="idBackPreview"></div>
                      </div>
                      <small class="text-muted">Upload a clear photo of the back side (JPEG, PNG, or PDF)</small>
                      @error('id_back')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- Selfie -->
                  <div class="col-12 col-md-4">
                    <div class="file-upload-card">
                      <label for="kycSelfie" class="form-label fw-semibold">Selfie with ID</label>
                      <div class="file-upload-input">
                        <input id="kycSelfie" name="selfie" type="file" class="form-control" accept="image/*" required>
                        <div class="file-preview mt-2" id="selfiePreview"></div>
                      </div>
                      <small class="text-muted">Your face clearly visible while holding your ID</small>
                      @error('selfie')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- Requirements -->
                  <div class="col-12">
                    <div class="alert alert-info">
                      <h6 class="alert-heading mb-2"><i class="fas fa-info-circle me-2"></i> Verification Requirements</h6>
                      <ul class="mb-0">
                        <li>Documents must be valid and not expired</li>
                        <li>All text must be clearly readable</li>
                        <li>Files must be less than 5MB each</li>
                        <li>Selfie must show your full face with ID</li>
                      </ul>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <button class="btn btn-primary px-4 py-2" type="submit">
                      <i class="fas fa-paper-plane me-2"></i>
                      @if(auth()->user()->kyc_status === 'pending')
                        Update Submission
                      @else
                        Submit for Verification
                      @endif
                    </button>
                  </div>
                </div>
              </form>
            </div>
          @endif
        </div>
      </article>
    </section>
    
    <!-- View Documents Modal -->
    @if(auth()->user()->kyc_status === 'approved')
    <div class="modal fade" id="viewKycDocs" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Your KYC Documents</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-4">
                <div class="document-thumbnail">
                  <img src="{{ Storage::url(auth()->user()->kyc_id_front) }}" class="img-fluid rounded" alt="ID Front">
                  <div class="caption">ID Front</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="document-thumbnail">
                  <img src="{{ Storage::url(auth()->user()->kyc_id_back) }}" class="img-fluid rounded" alt="ID Back">
                  <div class="caption">ID Back</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="document-thumbnail">
                  <img src="{{ Storage::url(auth()->user()->kyc_selfie) }}" class="img-fluid rounded" alt="Selfie">
                  <div class="caption">Selfie with ID</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endif
    
    @push('scripts')
    <script>
      // File preview functionality
      document.getElementById('kycIdFront').addEventListener('change', function(e) {
        previewFile(e.target, 'idFrontPreview');
      });
      
      document.getElementById('kycIdBack').addEventListener('change', function(e) {
        previewFile(e.target, 'idBackPreview');
      });
      
      document.getElementById('kycSelfie').addEventListener('change', function(e) {
        previewFile(e.target, 'selfiePreview');
      });
      
      function previewFile(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        const reader = new FileReader();
        
        preview.innerHTML = '';
        
        if (file) {
          if (file.type.match('image.*')) {
            reader.onload = function(e) {
              const img = document.createElement('img');
              img.src = e.target.result;
              img.className = 'img-thumbnail';
              img.style.maxHeight = '120px';
              preview.appendChild(img);
              
              const fileName = document.createElement('div');
              fileName.className = 'small text-muted mt-1';
              fileName.textContent = file.name;
              preview.appendChild(fileName);
            };
            reader.readAsDataURL(file);
          } else if (file.type === 'application/pdf') {
            const pdfIcon = document.createElement('i');
            pdfIcon.className = 'fas fa-file-pdf text-danger fa-3x';
            
            const fileName = document.createElement('div');
            fileName.className = 'small text-muted mt-1';
            fileName.textContent = file.name;
            
            preview.appendChild(pdfIcon);
            preview.appendChild(fileName);
          }
        }
      }
    </script>
    @endpush
    
    @push('styles')
    <style>
      .kyc-status-badge .badge {
        font-size: 0.9rem;
      }
      .file-upload-card {
        border: 1px dashed #ddd;
        border-radius: 8px;
        padding: 1.25rem;
        height: 100%;
      }
      .file-upload-card:hover {
        border-color: #0d6efd;
      }
      .document-thumbnail {
        text-align: center;
      }
      .document-thumbnail .caption {
        margin-top: 0.5rem;
        font-weight: 500;
      }
    </style>
    @endpush
@endsection