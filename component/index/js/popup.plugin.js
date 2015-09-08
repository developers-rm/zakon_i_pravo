/* Автор root */

(function ($) {
    var options = {options: ''};
    var defaults = {'title': 'Неизвестное окно',
        'width': '400px',
        'effect': 'none',
        'buttonClose': 1,
        'animateDelay': 500
    };
    var initStatus = "";
    var initArray = [];

    var core =
            {
                init: function (params) {

                    return this.each(function () {
                        var handler = this;
                        var closeButton = "$(" + handler.id + ").popup('onClose')";

                        options[this.id] = $.extend({}, defaults, params);

                        $(handler).css("width", options[this.id].width);
                        $(handler).find("[data-popup-title]").html(options[this.id].title);

                        if (options[this.id].buttonClose == 1) {
                            $(handler).find("[data-popup-close]").show();
                            $(handler).find("[data-popup-close]").attr("onclick", closeButton);
                        }

                        initArray.push(this.id);

                        initStatus = $(handler).data('onShow', initArray);

                        $(window).resize(function () {
                            return core.WinSetPosition(handler, options[this.id]);
                        });

                        return core.WinSetPosition(handler, options[this.id]);
                    });

                },
                onShow: function (params) {
                    options[this[0].id] = $.extend({}, options[this[0].id], params);

                    if ($(document).find(this.selector).length > 0) {
                        if ($.inArray(this[0].id, initArray) < 0) {
                            console.log("Инициализация окна " + this.selector + " не выполнена");
                            console.log("Пример инициализации: $(#selector).popup('init', {'title':'Окно'})");
                            return false;
                        }
                    } else {
                        console.log("Окно " + this.selector + " не найдено");
                        return false;
                    }

                    var handler = this;

                    $("body").append("<section id='shadow'></section>");
                    $("#shadow").show();

                    if ((options[this[0].id].dontClose == null || options[this[0].id].dontClose != 1)) {
                        $(document).on("click", "#shadow", function () {
                            $(this).remove();
                            property.setOutEffect(handler);
                        });
                    }

                    if (options[this[0].id].effect != null) {
                        property.setInEffect(handler);
                    } else {
                        $(handler).show();
                    }
                },
                WinSetPosition: function (handler, options) {
                    $(handler).css({"left": property.getWidthCenter(handler), "top": property.getHeightCenter(handler)});
                },
                onClose: function () {
                    var handler = this;

                    if (options[this[0].id].effect != null) {
                        property.setOutEffect(handler);
                    } else {
                        $(handler).hide();
                    }

                    $(document).find("#shadow").remove();
                }
            };

    var property = {
        setInEffect: function (handler) {
            var animateDelay = options[handler[0].id].animateDelay;

            switch (options[handler[0].id].effect) {
                case "fade":
                    $(handler).stop().animate({"opacity": "show"}, animateDelay);
                    break;

                case "slideTop":
                    $(handler).css("top", "0");
                    $(handler).stop().animate({"opacity": "show", "top": property.getHeightCenter(handler) + "px"}, animateDelay);
                    break;

                case "slideLeft":
                    $(handler).css("left", "0");
                    $(handler).stop().animate({"opacity": "show", "left": property.getWidthCenter(handler) + "px"}, animateDelay);
                    break;

                default:
                    $(handler).show();
            }
        },
        setOutEffect: function (handler) {
            var animateDelay = options[handler[0].id].animateDelay;

            switch (options[handler[0].id].effect) {
                case "fade":
                    $(handler).stop().animate({"opacity": "hide"}, animateDelay);
                    break;

                case "slideTop":
                    $(handler).stop().animate({"opacity": "hide", "top": "0px"}, animateDelay, function () {
                        $(this).css("top", property.getHeightCenter(handler) + "px");
                    });
                    break;

                case "slideLeft":
                    $(handler).stop().animate({"opacity": "hide", "left": "0px"}, animateDelay, function () {
                    });
                    break;

                default:
                    $(handler).hide();
            }
        },
        getHeightCenter: function (handler) {
            return ($(window).height() - $(handler).height()) / 2;
        },
        getWidthCenter: function (handler) {
            return ($(window).width() - $(handler).width()) / 2;
        }
    };

    $.fn.popup = function (method) {
        if (core[method]) {
            return core[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return core[method].apply(this, arguments);
        } else {
            console.log("Метод неопределён");
        }
    };
})(jQuery);