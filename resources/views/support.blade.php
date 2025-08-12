

  @extends('layouts.main')

    <!-- SUPPORT / HELP -->
    <section id="support" class="container-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h2 class="section-title mb-0">Support / Help</h2>
          <p class="section-sub mb-0">Reach out or browse FAQs</p>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-12 col-lg-6">
          <article class="card h-100">
            <div class="card-header bg-transparent fw-semibold">Contact Us</div>
            <div class="card-body">
              <form id="supportForm" data-endpoint="/api/support" novalidate>
                <div class="mb-3">
                  <label for="supEmail" class="form-label">Email</label>
                  <input id="supEmail" name="email" type="email" class="form-control" placeholder="you@example.com" required>
                </div>
                <div class="mb-3">
                  <label for="supMsg" class="form-label">Message</label>
                  <textarea id="supMsg" name="message" rows="4" class="form-control" placeholder="How can we help?" required></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Send</button>
              </form>
            </div>
          </article>
        </div>
        <div class="col-12 col-lg-6">
          <article class="card h-100">
            <div class="card-header bg-transparent fw-semibold">FAQs</div>
            <div class="card-body">
              <div class="accordion" id="faqAcc" role="region" aria-label="FAQ List">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faqOneH">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
                      How long do withdrawals take?
                    </button>
                  </h3>
                  <div id="faqOne" class="accordion-collapse collapse show" aria-labelledby="faqOneH" data-bs-parent="#faqAcc">
                    <div class="accordion-body">Withdrawals are processed within 1-2 business days. Locked funds may delay processing or incur penalties depending on plan rules.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faqTwoH">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
                      Do I need to complete KYC?
                    </button>
                  </h3>
                  <div id="faqTwo" class="accordion-collapse collapse" aria-labelledby="faqTwoH" data-bs-parent="#faqAcc">
                    <div class="accordion-body">Yes, KYC is required to deposit, withdraw, and access higher limits. Upload your ID and proof of address in the KYC section.</div>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    @endsection