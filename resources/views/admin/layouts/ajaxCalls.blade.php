<script>


    function ajaxCallFormSubmit(formElement, isToast, loadingMsg, data = {}, callBackFunction = undefined) {
        $.ajax({
            url: formElement.attr('action'),
            type: formElement.attr('method'),
            processData: false,
            data: data,
            contentType: false,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (res) {
                $('.loading').hide();
                window.location.href = res.back_url;
            },
            error: function (jqXHR) {
                $('.loading').hide();
                let errorRes = JSON.parse(jqXHR.responseText);
                if (errorRes.errors) {
                    $.each(errorRes.errors, function (key, value) {
                        toastr.error(value, {timeOut: 10000});
                    });
                } else {
                    let errorRes = JSON.parse(jqXHR.responseText);
                    toastr.remove();
                    toastr.error(errorRes.message, {timeOut: 10000});
                }

            }
        });
    }
    function ajaxCallChangeStatus(url, confirmMsg, tableId) {

        if (confirm(confirmMsg)) {
            let result;
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                beforeSend: function () {
                    $('.loading').show();
                    $('#ajax_alert_div').html('');
                    // showWaitMeLoading('Fetching details...', '', $('.content-wrapper'));
                },
                success: function (res) {
                    $('.loading').hide();
                    toastr.remove();
                    toastr.success(res.message);
                    LaravelDataTables[tableId].ajax.reload(null, false);
                },
                error: function (jqXHR) {
                    $('.loading').hide();
                    let errorRes = JSON.parse(jqXHR.responseText);
                    toastr.remove();
                    toastr.error(errorRes.message);

                }
            });
        }
    }
    function ajaxCallDelete(url, confirmMsg, tableId) {
        if (confirm(confirmMsg)) {
            let result;
            $.ajax({
                url: url,
                type: 'DELETE',
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (res) {
                    $('.loading').hide();
                    toastr.remove();
                    toastr.success(res.message, {timeOut: 10000});
                    LaravelDataTables["dataTableBuilder"].ajax.reload();
                },
                error: function (jqXHR) {
                    $('.loading').hide();
                    LaravelDataTables["dataTableBuilder"].ajax.reload();
                    let errorRes = JSON.parse(jqXHR.responseText);
                    if (errorRes.errors) {
                        $.each(errorRes.errors, function (key, value) {
                            toastr.error(value, {timeOut: 10000});
                        });
                    } else {
                        let errorRes = JSON.parse(jqXHR.responseText);
                        toastr.remove();
                        toastr.error(errorRes.message, {timeOut: 10000});
                    }
                }
            });
        }
    }


    function scrollTopFunction() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    }

</script>
