const emailSubscriptionForm = document.querySelector('#email_subscription_form');

const csrf_token = document.querySelector("meta[name='X_CSRF_TOKEN']").getAttribute('content');

if (emailSubscriptionForm) {
    emailSubscriptionForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const trans = {
            successTitle: this.dataset.successTitle || 'Harika!',
            successText: this.dataset.successText || 'Bültenimize başarıyla abone oldunuz.',
            errorTitle: this.dataset.errorTitle || 'Hata Oluştu!',
            btnOk: this.dataset.btnOk || 'Tamam',
            btnClose: this.dataset.btnClose || 'Kapat'
        };

        const formData = new FormData(this);

        const url = emailSubscriptionForm.getAttribute('action');

        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.disabled = true;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errData => {
                        let errorMessage = errData.message || 'Kayıt işlemi sırasında bir sorun oluştu.';

                        if (errData.errors) {
                            const firstErrorKey = Object.keys(errData.errors)[0];
                            errorMessage = errData.errors[firstErrorKey][0];
                        }

                        throw new Error(errorMessage);
                    });
                }
                return response.json();
            })
            .then(data => {
                emailSubscriptionForm.reset();
                if (submitBtn) submitBtn.disabled = false;

                Swal.fire({
                    icon: 'success',
                    title: trans.successTitle,
                    text: trans.successText,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: trans.btnOk
                });
            })
            .catch(error => {
                if (submitBtn) submitBtn.disabled = false;

                Swal.fire({
                    icon: 'error',
                    title: trans.errorTitle,
                    text: error.message,
                    confirmButtonColor: '#d33',
                    confirmButtonText: trans.btnClose
                });
            });
    });
}
