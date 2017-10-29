$(document).ready(
    $(document).on('submit', '.comment-form', function (e) {
        e.preventDefault();
        var $this = $(this);
        var $data = $this.serialize();
        $.ajax({
            type: "POST",
            url: $this.attr('action'),
            data: $data,
            success: function (response) {
                $('.comments').replaceWith($(response).find('.comments'));
            }
        });

    })
)