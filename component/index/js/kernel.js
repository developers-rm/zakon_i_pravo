function open_file(inp) {
    $(inp).click();
}

function ajax_downloader(form) {
    var temp_form = document.getElementById('form_response');
    var number_form = temp_form.getAttribute('data-number');
 
    var file = document.getElementById("file"),
         xhr = new XMLHttpRequest(),
        form = new FormData();

    var upload_file = file.files[0];   
    form.append("data", upload_file);
    xhr.open("post", "/?module=responses&action=download_file&form_number="+number_form, true);
    xhr.send(form);

    xhr.onreadystatechange = function() {
        if(xhr.readyState != 4) return;
        if(xhr.status == 200) {
            handler = document.getElementById("response_status");
            handler.innerHTML = xhr.responseText;
        }
    };
}


var listen_form = function (object) {
    var handler = object.handler;
    var form = object.id_form;

    $(form).submit(function(e) {
        var path = $(form).attr('action');
        var data_form = $(form).serialize();
        var signature = $(form).find("input[name='signature']").is(":checked");

        if (signature === true) {
            $.ajax({
                url: path,
                type: 'POST',
                data: data_form,
                beforeSend: function () {
                    $(handler).html("Подождите немного, идёт отправка данных");
                },
                success: function (response_data) {
                    $(handler).html(response_data);
                }
            });
        } else {
            alert("Для отправки заявки, Вам необходмо согласиться с обработкой персональных данных");
        }

        return false;
    });
};

function procudure_form() {
    console.log(this);
    $(this).submit(function () {

    });
    return false;
}

function groovy_response(div) {
    var $this = $(div);
    var block_width = $this.width();
    var count_line = 3;
    $($this).each(function () {
        var new_width_resp = ((block_width / count_line) - 20);
        var new_height_resp = (new_width_resp - 10);
        $(".response_section").width(new_width_resp > 330 ? 330 : new_width_resp);
        $(".response_section").find(".photo").height(new_height_resp > 320 ? 320 : new_height_resp);
    });

    $(".response_section").hover(function () {
        $(this).find('.helper').stop().fadeIn(500);
    }, function () {
        $(this).find('.helper').stop().fadeOut(500);
    });
}
;

$(document).ready(function () {
    $("#modal_services").popup('init', {'title': 'Заказать услугу', 'width': '35%', 'effect': 'fade', 'buttonClose': 0});
    $("#modal_response").popup('init', {'title': 'Ваш отзыв', 'width': '540px', 'effect': 'fade', 'buttonClose': 0});

    $("a#open_services").on("click", function () {
        $("#modal_services").popup('onShow', {});
    });

    $("a#open_response").on("click", function () {
        $("#modal_response").popup('onShow', {});
    });

    resp = new groovy_response("#resp");

    $(window).resize(function () {
        resp = new groovy_response("#resp");
    });
});