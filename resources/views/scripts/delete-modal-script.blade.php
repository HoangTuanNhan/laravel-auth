<script type="text/javascript">
    $(document).ready(function() {
        $('#confirmDelete').on('show.bs.modal', function(event) {
            let form = $(event.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function() {
            $(this).data('form').submit();
        });
    });
</script>