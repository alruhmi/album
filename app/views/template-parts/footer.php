<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script>
    let start = 10;
    let limit = 10;

    function showMore() {
        $.ajax({
            url: 'show-more',
            method: 'post',
            dataType: 'json',
            data: {start, limit},
            success: (data) => {
                console.log(data);

                start = start + limit;
            }
        })
    }

    $('#add_form').submit(async (event) => {
        event.preventDefault();
        await fetch('/add', {
            method: 'POST',
            body: new FormData($('#add_form').get(0))
        }).then(response => response.json()).then(result => {
            if (result.errors) {
                $('.validation-message').text('');
                $.each(result.errors, (field, value) => {
                    $(`input[name=${field}]`).closest('.form-group').find('.validation-message').text(value);
                })
            }
            if (result.success) {
                $('.validation-message').text('');
                $('#add_form').trigger('reset');
            }
        })

    });
</script>
</body>
</html>