@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">KYC Verifications</h5>
                    <div class="d-flex">
                        <div class="input-group input-group-outline me-3" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Search users..." id="kycSearch">
                        </div>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="verified">Verified</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Submitted On</th>
                                <th>Status</th>
                                <th>Documents</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="rounded-circle">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->kyc_submitted_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                <td>
                                    @if($user->kyc_status === 'approved')
                                        <span class="badge bg-success">Verified</span>
                                    @elseif($user->kyc_status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                        @if($user->kyc_rejection_reason)
                                            <br><small class="text-muted">{{ Str::limit($user->kyc_rejection_reason, 30) }}</small>
                                        @endif
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->id_front_path || $user->id_back_path || $user->selfie_path)
                                        <div class="documents-thumbnails d-flex flex-wrap gap-2">
                                            <!-- ID Front Thumbnail -->
                                            @if($user->id_front_path)
                                            <div class="document-thumb-item">
                                                <div class="document-thumb-container" 
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal"
                                                     data-image-src="{{ Storage::url($user->id_front_path) }}"
                                                     data-image-title="ID Front - {{ $user->name }}">
                                                    <img src="{{ Storage::url($user->id_front_path) }}" 
                                                         alt="ID Front" 
                                                         class="document-thumb-img">
                                                    <div class="thumb-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                    <div class="thumb-label">ID Front</div>
                                                </div>
                                                <a href="{{ Storage::url($user->id_front_path) }}" 
                                                   download 
                                                   class="btn btn-xs btn-outline-primary mt-1 w-100"
                                                   title="Download ID Front">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                            @endif
                                            
                                            <!-- ID Back Thumbnail -->
                                            @if($user->id_back_path)
                                            <div class="document-thumb-item">
                                                <div class="document-thumb-container" 
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal"
                                                     data-image-src="{{ Storage::url($user->id_back_path) }}"
                                                     data-image-title="ID Back - {{ $user->name }}">
                                                    <img src="{{ Storage::url($user->id_back_path) }}" 
                                                         alt="ID Back" 
                                                         class="document-thumb-img">
                                                    <div class="thumb-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                    <div class="thumb-label">ID Back</div>
                                                </div>
                                                <a href="{{ Storage::url($user->id_back_path) }}" 
                                                   download 
                                                   class="btn btn-xs btn-outline-primary mt-1 w-100"
                                                   title="Download ID Back">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                            @endif
                                            
                                            <!-- Selfie Thumbnail -->
                                            @if($user->selfie_path)
                                            <div class="document-thumb-item">
                                                <div class="document-thumb-container" 
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal"
                                                     data-image-src="{{ Storage::url($user->selfie_path) }}"
                                                     data-image-title="Selfie - {{ $user->name }}">
                                                    <img src="{{ Storage::url($user->selfie_path) }}" 
                                                         alt="Selfie" 
                                                         class="document-thumb-img">
                                                    <div class="thumb-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                    <div class="thumb-label">Selfie</div>
                                                </div>
                                                <a href="{{ Storage::url($user->selfie_path) }}" 
                                                   download 
                                                   class="btn btn-xs btn-outline-primary mt-1 w-100"
                                                   title="Download Selfie">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Quick Actions for Pending Status -->
                                        @if($user->kyc_status === 'pending')
                                        <div class="quick-actions mt-2">
                                            <div class="d-flex gap-1">
                                                <form action="{{ route('admin.kyc.approve', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-success" title="Quick Approve">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                                <button class="btn btn-xs btn-danger reject-btn" 
                                                        data-user-id="{{ $user->id }}"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#rejectModal"
                                                        title="Quick Reject">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <span class="badge bg-danger">No Documents</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->kyc_status === 'pending')
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.kyc.approve', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check me-1"></i> Approve
                                                </button>
                                            </form>
                                            <button class="btn btn-sm btn-danger reject-btn" 
                                                    data-user-id="{{ $user->id }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejectModal">
                                                <i class="fas fa-times me-1"></i> Reject
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">
                                            <i class="fas fa-check-circle text-success me-1"></i>
                                            Verified on {{ $user->kyc_verified_at ? \Carbon\Carbon::parse($user->kyc_verified_at)->format('M d, Y') : '' }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Image Zoom Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Document Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Document Image" style="max-height: 80vh;">
            </div>
            <div class="modal-footer">
                <a id="modalDownload" href="#" download class="btn btn-primary">
                    <i class="fas fa-download me-1"></i> Download Original
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject KYC Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="rejectUserId">
                    <div class="mb-3">
                        <label for="rejectionReason" class="form-label">Reason for rejection</label>
                        <textarea class="form-control" id="rejectionReason" name="rejection_reason" rows="3" required></textarea>
                        <small class="text-muted">This message will be sent to the user</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing document thumbnails...');
        
        // Thumbnail click functionality for zoom modal
        document.addEventListener('click', function(e) {
            const thumbContainer = e.target.closest('.document-thumb-container');
            if (thumbContainer) {
                e.preventDefault();
                
                const imageSrc = thumbContainer.getAttribute('data-image-src');
                const imageTitle = thumbContainer.getAttribute('data-image-title');
                
                console.log('Thumbnail clicked:', imageTitle);
                
                const modalImage = document.getElementById('modalImage');
                const modalTitle = document.getElementById('imageModalTitle');
                const modalDownload = document.getElementById('modalDownload');
                
                if (modalImage) modalImage.src = imageSrc;
                if (modalTitle) modalTitle.textContent = imageTitle;
                if (modalDownload) modalDownload.href = imageSrc;
                
                // Show the modal
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            }
        });
        
        // Reject modal handler
        document.querySelectorAll('.reject-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const userIdInput = document.getElementById('rejectUserId');
                const rejectForm = document.getElementById('rejectForm');
                
                if (userIdInput) userIdInput.value = userId;
                if (rejectForm) rejectForm.action = `/admin/kyc/reject/${userId}`;
            });
        });
        
        // Filter functionality
        const statusFilter = document.getElementById('statusFilter');
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                const status = this.value;
                const currentUrl = new URL(window.location);
                
                if (status) {
                    currentUrl.searchParams.set('status', status);
                } else {
                    currentUrl.searchParams.delete('status');
                }
                
                window.location.href = currentUrl.toString();
            });
        }
        
        // Search functionality with debounce
        const kycSearch = document.getElementById('kycSearch');
        if (kycSearch) {
            kycSearch.addEventListener('input', debounce(function(e) {
                const search = e.target.value;
                if(search.length > 2 || search.length === 0) {
                    const currentUrl = new URL(window.location);
                    
                    if (search) {
                        currentUrl.searchParams.set('search', search);
                    } else {
                        currentUrl.searchParams.delete('search');
                    }
                    
                    window.location.href = currentUrl.toString();
                }
            }, 500));
        }
        
        // Image loading handlers for thumbnails
        document.querySelectorAll('.document-thumb-img').forEach(img => {
            // Set up load handler
            img.addEventListener('load', function() {
                this.classList.add('loaded');
                console.log('Thumbnail loaded:', this.alt);
            });
            
            // Set up error handler
            img.addEventListener('error', function() {
                console.log('Thumbnail failed to load:', this.src);
                // Show placeholder for failed images
                this.style.backgroundColor = '#f8f9fa';
                this.style.border = '2px dashed #dee2e6';
                this.alt = 'Image not available';
                this.classList.add('error');
            });
            
            // If image is already loaded (from cache)
            if (img.complete && img.naturalHeight !== 0) {
                img.classList.add('loaded');
                console.log('Thumbnail already loaded from cache:', img.alt);
            }
        });
    });
    
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
</script>
@endpush

@push('styles')
<style>
    /* Document Thumbnail Styles */
    .documents-thumbnails {
        min-width: 250px;
    }
    
    .document-thumb-item {
        flex: 0 0 auto;
        width: 80px;
    }
    
    .document-thumb-container {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
    }
    
    .document-thumb-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        border-color: #0d6efd;
    }
    
    .document-thumb-img {
        width: 100%;
        height: 60px;
        object-fit: cover;
        border: none;
        transition: all 0.3s ease;
        display: block;
    }
    
    .document-thumb-img:hover {
        transform: scale(1.05);
    }
    
    .thumb-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        color: white;
        font-size: 1.2rem;
    }
    
    .document-thumb-container:hover .thumb-overlay {
        opacity: 1;
    }
    
    .thumb-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
        font-size: 0.7rem;
        padding: 2px 4px;
        text-align: center;
        font-weight: 500;
    }
    
    .quick-actions {
        margin-top: 8px;
    }
    
    .quick-actions .btn-xs {
        padding: 0.2rem 0.4rem;
        font-size: 0.7rem;
    }
    
    /* Button Styles */
    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1.2;
        border-radius: 0.375rem;
    }
    
    .toggle-documents {
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }
    
    .toggle-documents:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.2);
        border-color: #0d6efd;
    }
    
    .toggle-icon {
        transition: transform 0.3s ease;
    }
    
    /* Icon rotation when expanded */
    .toggle-documents .toggle-icon.fa-chevron-up {
        transform: rotate(0deg);
    }
    
    .toggle-documents .toggle-icon.fa-chevron-down {
        transform: rotate(0deg);
    }
    
    /* Table Enhancements */
    .avatar img {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,123,255,0.05);
    }
    
    /* Badge Enhancements */
    .badge {
        font-size: 0.75em;
        padding: 0.35em 0.65em;
    }
    
    .badge.bg-success {
        background: linear-gradient(45deg, #28a745, #20c997) !important;
    }
    
    .badge.bg-warning {
        background: linear-gradient(45deg, #ffc107, #fd7e14) !important;
        color: #000;
    }
    
    .badge.bg-danger {
        background: linear-gradient(45deg, #dc3545, #e83e8c) !important;
    }
    
    /* Loading Animation for thumbnails */
    .document-thumb-img:not(.loaded):not(.error) {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .documents-thumbnails {
            min-width: auto;
            justify-content: center;
        }
        
        .document-thumb-item {
            width: 70px;
        }
        
        .document-thumb-img {
            height: 50px;
        }
        
        .quick-actions .d-flex {
            flex-direction: column;
            gap: 0.25rem !important;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }
        .document-preview-img {
            height: 150px;
        }
        
        .documents-preview {
            min-width: auto;
        }
        
        .d-flex.gap-2 {
            flex-direction: column;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    /* Collapse Animation Enhancement */
    .collapse {
        transition: all 0.35s ease;
    }
    
    .collapse.show {
        display: block !important;
        height: auto !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    .collapse:not(.show) {
        display: none !important;
        height: 0 !important;
        opacity: 0;
        visibility: hidden;
    }
    
    /* Modal Enhancements */
    #imageModal .modal-body {
        padding: 1rem;
    }
    
    #modalImage {
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    /* Action Button Improvements */
    .btn-success:hover {
        background: linear-gradient(45deg, #28a745, #20c997);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(40,167,69,0.3);
    }
    
    .btn-danger:hover {
        background: linear-gradient(45deg, #dc3545, #e83e8c);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220,53,69,0.3);
    }
    
    /* Status Display */
    .text-muted i {
        font-size: 0.9em;
    }
</style>
@endpush

@endsection