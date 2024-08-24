 
 // Define the function to create and show a toast
    function showToast(type, message) {
        var toastHtml = `
            <div class="toast show align-items-center text-white bg-${type} border-0 position-fixed top-0 end-0" style="min-width: 200px; z-index: 1050;" role="alert" data-bs-autohide="false" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body ms-2">
                        <span class="fas fa-exclamation-circle fs-7 text-white"></span>
                        ${message}
                    </div>
                    <button class="d-none btn ms-2 p-0" type="button" data-bs-dismiss="toast" aria-label="Close">
                        <span class="far fa-times-circle fs-7 text-white"></span>
                    </button>
                </div>
            </div>
        `;
        $('body').append(toastHtml);
        
        // Optionally, you might want to remove the toast after some time
        setTimeout(function() {
            $('.toast').fadeOut(function() {
                //$(this).remove();
            });
        }, 5000); // Adjust timeout as needed
    }
