document.getElementById('proceedToPaymentBtn').addEventListener('click', function() {
    var addressForm = document.getElementById('addressForm');
    
    if (addressForm.checkValidity()) {
        // needs existing instance
        var addressModalElement = document.getElementById('addressModal');
        var addressModal = bootstrap.Modal.getInstance(addressModalElement);
        // update existing instance
        if (!addressModal) {
            addressModal = new bootstrap.Modal(addressModalElement);
        }
        
        // same thing need existing instance
        var paymentModalElement = document.getElementById('paymentModal');
        var paymentModal = bootstrap.Modal.getInstance(paymentModalElement);
        if (!paymentModal) {
            paymentModal = new bootstrap.Modal(paymentModalElement);
        }
        
        // switch to payment modal
        addressModal.hide(); 
        paymentModal.show();

    } else {
        // if form not complete show error
        addressForm.reportValidity();
    }
});