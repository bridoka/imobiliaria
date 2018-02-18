$('form[data-toggle="validator"]').validator({
    custom: {
        //custom file type validation
        filetype: function ($el) {
            var acceptableTypes = $el.prop('accept').split(',');
            var fileType = $el[0].files[0].type;
            if (fileType!='text/xml') {
                return "Invalid file type"
            }
            $( "#btImportar" ).prop("disabled", false);
        }
    }
});

$('#form').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        waitingDialog.show('Aguarde...');
    }
});

$(function(){
    $( "#btImportar" ).prop("disabled", true);
});
