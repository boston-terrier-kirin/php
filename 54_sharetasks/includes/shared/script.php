<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>
<script src="<?= URLROOT ?>/js/main.js"></script>
<script>
    const successMessage = document.getElementById("success-msg");
    if (successMessage) {
        setTimeout(function() {
            successMessage.classList.add("d-none");
        }, 5000);
    }

    <?php if (isset($errors) && !empty($errors)) : ?>
        const errors = JSON.parse('<?= json_encode($errors); ?>');
        for (const key of Object.keys(errors)) {
            const message = errors[key];
            const targetControl = document.getElementById(key);
            const targetSpan = document.getElementById(key + "_err");

            if (targetControl) {
                targetControl.classList.add("is-invalid");
            }

            if (targetSpan) {
                targetSpan.innerHTML = message;
                targetSpan.setAttribute("role", "alert");
            }
        }
    <?php endif; ?>
</script>
