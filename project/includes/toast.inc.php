<style>
    @keyframes toast-show {
        0% {
            transform: translateY(100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .alert-show {
        animation: toast-show 0.5s ease forwards;
    }

    @keyframes toast-hide {
        0% {
            transform: translateY(0);
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            transform: translateY(100%);
            opacity: 0;
        }
    }

    .alert-hide {
        animation: toast-hide 0.5s ease forwards;
    }
</style>

<?php
if (isset($toastMessage) && !empty($toastMessage)) {
    $sanitizedToastMessage = htmlspecialchars($toastMessage);
    echo <<<EOT
            <div role="alert" class="alert alert-success alert-show fixed bottom-3 right-3 w-auto" id="toastMessage">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>$sanitizedToastMessage</span>
            </div>
        EOT;
}
?>


<script>
    const toastMessage = document.getElementById('toastMessage');
    setTimeout(() => {
        if (toastMessage) {
            toastMessage.classList.add('alert-hide');
        }
        setTimeout(() => {
            if (toastMessage) {
                toastMessage.remove();
            }
        }, 600);
    }, 3000);
</script>