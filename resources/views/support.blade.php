@extends('layouts.main')

@section('content')

<!-- SUPPORT / HELP CENTER -->
<section id="support" class="container-xxl py-5">
  <div class="text-center mb-5">
    <h1 class="display-5 fw-bold mb-3">Emirate Funds Support</h1>
    <p class="lead text-muted">We're here to help you 24/7</p>
  </div>

  <div class="row g-4">
    <!-- Contact Card -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-primary text-white">
          <h2 class="h5 mb-0"><i class="fas fa-headset me-2"></i>Contact Support</h2>
        </div>
        <div class="card-body">
          <div class="mb-4">
            <h3 class="h6 text-primary">Main Contacts</h3>
            <ul class="list-unstyled">
              <li class="mb-2">
                <i class="fas fa-envelope text-primary me-2"></i>
                <strong>Email:</strong> info@emiratefunds.com
              </li>
              <li class="mb-2">
                <i class="fas fa-phone-alt text-primary me-2"></i>
                <strong>Phone: +447446970806</strong> 
              </li>
              <li class="mb-2">
                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                <strong>Address:</strong> 
              </li>
            </ul>
          </div>

     

       
        </div>
      </div>
    </div>

    <!-- FAQ Card -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-primary text-white">
          <h2 class="h5 mb-0"><i class="fas fa-question-circle me-2"></i>Frequently Asked Questions</h2>
        </div>
        <div class="card-body">
          <div class="accordion" id="faqAccordion">
            <!-- Account Questions -->
            <div class="accordion-item border-0 mb-3">
              <h3 class="accordion-header" id="headingAccount">
                <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount">
                  <i class="fas fa-user-circle me-2 text-primary"></i> Account Questions
                </button>
              </h3>
              <div id="collapseAccount" class="accordion-collapse collapse" aria-labelledby="headingAccount" data-bs-parent="#faqAccordion">
                <div class="accordion-body pt-0">
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq1">How do I create an account?</a>
                    <div id="faq1" class="collapse ps-3 small py-2">Register with your email, complete your profile, and verify your identity through our KYC process.</div>
                    
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq2">Is my personal information secure?</a>
                    <div id="faq2" class="collapse ps-3 small py-2">We use bank-level encryption and comply with UAE data protection regulations.</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Investment Questions -->
            <div class="accordion-item border-0 mb-3">
              <h3 class="accordion-header" id="headingInvest">
                <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInvest" aria-expanded="false" aria-controls="collapseInvest">
                  <i class="fas fa-chart-line me-2 text-primary"></i> Investment Questions
                </button>
              </h3>
              <div id="collapseInvest" class="accordion-collapse collapse" aria-labelledby="headingInvest" data-bs-parent="#faqAccordion">
                <div class="accordion-body pt-0">
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq3">What are the minimum investment amounts?</a>
                    <div id="faq3" class="collapse ps-3 small py-2">Our starter plans begin at AED 1,000 with higher tiers available.</div>
                    
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq4">How are returns calculated?</a>
                    <div id="faq4" class="collapse ps-3 small py-2">Returns are based on our Sharia-compliant investment models and market performance.</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Withdrawal Questions -->
            <div class="accordion-item border-0 mb-3">
              <h3 class="accordion-header" id="headingWithdraw">
                <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWithdraw" aria-expanded="false" aria-controls="collapseWithdraw">
                  <i class="fas fa-money-bill-wave me-2 text-primary"></i> Withdrawal Questions
                </button>
              </h3>
              <div id="collapseWithdraw" class="accordion-collapse collapse" aria-labelledby="headingWithdraw" data-bs-parent="#faqAccordion">
                <div class="accordion-body pt-0">
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq5">How long do withdrawals take?</a>
                    <div id="faq5" class="collapse ps-3 small py-2">Standard processing is 1-2 business days. VIP members receive priority processing.</div>
                    
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq6">Are there withdrawal fees?</a>
                    <div id="faq6" class="collapse ps-3 small py-2">No fees for standard withdrawals. Express withdrawals (same-day) incur a 1% charge.</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- KYC Questions -->
            <div class="accordion-item border-0">
              <h3 class="accordion-header" id="headingKYC">
                <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKYC" aria-expanded="false" aria-controls="collapseKYC">
                  <i class="fas fa-id-card me-2 text-primary"></i> KYC Questions
                </button>
              </h3>
              <div id="collapseKYC" class="accordion-collapse collapse" aria-labelledby="headingKYC" data-bs-parent="#faqAccordion">
                <div class="accordion-body pt-0">
                  <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq7">What documents are required?</a>
                    <div id="faq7" class="collapse ps-3 small py-2">Valid passport/Emirates ID, proof of address, and sometimes source of funds documentation.</div>
                    
                    <a href="#" class="list-group-item list-group-item-action border-0" data-bs-toggle="collapse" data-bs-target="#faq8">How long does verification take?</a>
                    <div id="faq8" class="collapse ps-3 small py-2">Typically 24-48 hours after document submission.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Still Need Help? -->
          <div class="alert alert-light mt-4">
            <h4 class="h6 mb-3"><i class="fas fa-life-ring me-2 text-primary"></i> Still need help?</h4>
            <p class="mb-2">Visit our <a href="/knowledge-base" class="text-primary">Knowledge Base</a> or <a href="/live-chat" class="text-primary">start a live chat</a>.</p>
            <p class="mb-0">Operating hours: 24/7 support</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
  .accordion-button:not(.collapsed) {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.1);
  }
  .accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,.125);
  }
  .list-group-item-action:hover {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.05);
  }
</style>
@endpush

@push('scripts')
<script>
  // Form validation
  (function() {
    'use strict'
    const form = document.getElementById('supportForm')
    
    form.addEventListener('submit', function(event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      
      form.classList.add('was-validated')
    }, false)
  })()
</script>
@endpush