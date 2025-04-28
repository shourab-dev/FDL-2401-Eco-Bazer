<script>
    $(document).ready(function() {
         $('.btnDelete').click(function(e){
            e.preventDefault()
            let url = $(this).attr('href')
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                       window.location.href = url
                    }
                });

                })
    })
</script>