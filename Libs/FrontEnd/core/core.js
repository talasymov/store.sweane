ajaxDir = "/requests/ajax?command=";

$(document).ready(function()
{
    $('[data-toggle="popover"]').popover();

    $('.blog-menu-button').on('click', function () {
        $('.blog-menu-slide').slideToggle('fast');
    });


    $(".filter-search").click(function () {
        var listVar = [];

        $(".filter-variable:checked").each(function (i, e) {
            listVar.push($(e).attr("data-id"));
        });

        console.log(listVar);
    });


    // var divPos = {};
    // var header = ".header";
    // var headerWidth = $(header).width() / 2;
    // var headerHeight = $(header).height() / 2;
    // var offset = $(header).offset();
    //
    // $(header).mousemove(function (e) {
    //     divPos = {
    //         left: e.pageX - offset.left,
    //         top: e.pageY - offset.top,
    //         leftDel: (e.pageX - offset.left) / 100,
    //         topDel: (e.pageY - offset.top) / 100
    //     };
    //
    //     console.log(headerWidth + " " + divPos.left);
    //
    //     if(divPos.left < headerWidth && divPos.top < headerHeight)
    //     {
    //         console.log(1);
    //         leftDiv = divPos.leftDel;
    //         topDiv = divPos.topDel;
    //     }
    //     else if(divPos.left > headerWidth && divPos.top < headerHeight)
    //     {
    //         console.log(2);
    //         leftDiv = -divPos.leftDel;
    //         topDiv = divPos.topDel;
    //     }
    //     else if(divPos.left < headerWidth && divPos.top > headerHeight)
    //     {
    //         console.log(3);
    //         leftDiv = divPos.leftDel;
    //         topDiv = -divPos.topDel;
    //     }
    //     else
    //     {
    //         console.log(4);
    //         leftDiv = -divPos.leftDel;
    //         topDiv = -divPos.topDel;
    //     }
    //
    //     $(header).css("transform", "translate(" + leftDiv + "px, " + topDiv + "px) scale(1.2)");
    //
    // });
    //
    // $(header).mouseleave(function (e) {
    //     $(header).css("transform", "translate(0px, 0px) scale(1)");
    // });
    
    $(".head-menu").find("button").click(function () {
        $(this).parent().find("ul").css("width", ($(window).width() - 30) + "px");
        $(this).parent().find("ul").toggle();
    });

    $(".switch-language").find("a").click(function () {

        getLang = $(this).attr("data-lang");

        $.ajax({
            url: ajaxDir + "Dispatcher",
            method: "post",
            data: {
                "query": "SetCookie",
                "value": getLang
            },
            success: function ()
            {
                location.reload();
            }
        });
    });

    $(".form-request").find("button").click(function () {

        thisStep = parseInt($(".form-request").attr("data-step"));
        step = thisStep;

        if($(this).attr("data-path") == "next" && thisStep < 4)
        {
            if($(".form-request div[class='step-" + thisStep + "']").find(".need").val() != "")
            {
                $(".form-request div[class^='step']").css("display", "none");
                step = thisStep + 1;
                $(".form-request div[class='step-" + step + "']").css("display", "block");
            }
            else
            {
                $(".form-request div[class='step-" + thisStep + "']").find(".need").addClass("need-dismiss");
            }
        }
        else if($(this).attr("data-path") == "back" && thisStep > 1)
        {
            if($(".form-request div[class='step-" + thisStep + "']").find(".need").val() != "")
            {
                $(".form-request div[class^='step']").css("display", "none");
                step = thisStep - 1;
                $(".form-request div[class='step-" + step + "']").css("display", "block");
            }
        }

        $(".form-request").attr("data-step", step);
    });

    $(".set-executor").click(function () {
        taskId = $(this).attr("data-id");

        $.ajax({
            url: ajaxDir + "Dispatcher",
            method: "post",
            data: {
                "query": "ListUsers"
            },
            success: function (select)
            {
                bootbox.dialog({
                    size: "small",
                    title: "Хотите начать работу над этим заданием?",
                    message: select,
                    buttons:
                        {
                            success:
                                {
                                    label: "Да, начать работу",
                                    className: "button button-small button-white",
                                    callback: function()
                                    {
                                        $.ajax({
                                            url: ajaxDir + "Tasks",
                                            method: "post",
                                            data: {
                                                "query": "SetUserOnTask",
                                                "taskId": taskId,
                                                "userId": $("#UsersSelect").val()
                                            },
                                            success: function ()
                                            {
                                                location.reload();
                                            }
                                        });
                                    }
                                }
                        }
                });
            }
        });

    });

    $(".modal-start-task").click(function () {
        taskId = $(".data-task-id").val();

        div = $("<div>");
        div.text("Каждое задание - это как шаги, шаги к завершению проекта. " +
            "А как нам всем известно, завершение проекта - это всегда деньги!");

        bootbox.dialog({
            size: "small",
            title: "Хотите начать работу над этим заданием?",
            message: div,
            buttons:
                {
                    success:
                        {
                            label: "Да, начать работу",
                            className: "button button-small button-white",
                            callback: function()
                            {
                                $.ajax({
                                    url: ajaxDir + "Tasks",
                                    method: "post",
                                    data: {
                                        "query": "start",
                                        "taskId": taskId
                                    },
                                    success: function ()
                                    {
                                        location.reload();
                                    }
                                });
                            }
                        }
                }
        });
    });

    $(".modal-stop-task").click(function () {
        taskId = $(".data-task-id").val();

        div = $("<div>");
        div.text("Отличная работа, до новых встреч!");

        bootbox.dialog({
            size: "small",
            title: "Вы все проверили?",
            message: div,
            buttons:
                {
                    success:
                        {
                            label: "Да, завершить задание",
                            className: "button button-small button-white",
                            callback: function()
                            {
                                $.ajax({
                                    url: ajaxDir + "Tasks",
                                    method: "post",
                                    data: {
                                        "query": "stop",
                                        "taskId": taskId
                                    },
                                    success: function ()
                                    {
                                        location.href = "/dashboard/tasks";
                                    }
                                });
                            }
                        }
                }
        });
    });

    $(".modal-new-task").click(function () {
        orderId = $(".data-order-id").val();

        text = $("<textarea>");

        text.attr("class", "textarea-sweane");
        text.attr("placeholder", "Текст задания");

        div = $("<div>");

        div.append(text);

        bootbox.dialog({
            size: "small",
            title: "Создание нового задания",
            message: div,
            buttons:
                {
                    success:
                        {
                            label: "Создать",
                            className: "button button-small button-white",
                            callback: function()
                            {
                                $.ajax({
                                    url: ajaxDir + "Tasks",
                                    method: "post",
                                    data: {
                                        "query": "add",
                                        "orderId": orderId,
                                        "text": text.val()
                                    },
                                    success: function ()
                                    {
                                        location.reload();
                                    }
                                });
                            }
                        }
                }
        });
    });

    $(".sign-in").click(function () {
        logInSystem();
    });

    $(".password").keydown(function (e) {
        if(e.keyCode == 13)
        {
            logInSystem();
        }
    });

    $(".quit-from-dashboard").click(function () {
        QuitFromSystem();
    });

    $(".search-button").click(function()
    {
        $(".home-search").toggleClass("scale");
    });
    $(".search-article-button").click(function () {
        query = $(this).parent().find("input").val();

        SearchInTable(query);
    });
    $(".remove-search").click(function()
    {
        $(".home-search").toggleClass("scale");
    });
    // $(".login-button").click(function()
    // {
    //     img = $("<img>");
    //     img.attr("src", "/Images/Home/user-modal.svg");
    //     img.attr("class", "user-logo");
    //
    //     btnLogin = $("<input>");
    //     btnLogin.attr("class", "login");
    //     btnLogin.attr("placeholder", "Логин");
    //
    //     btnPassword = $("<input>");
    //     btnPassword.attr("class", "password");
    //     btnPassword.attr("placeholder", "Пароль");
    //     btnPassword.attr("type", "password");
    //
    //     divModal = $("<div>");
    //     divModal.attr("class", "carrot-login");
    //     divModal.append(img);
    //     divModal.append(btnLogin);
    //     divModal.append(btnPassword);
    //
    //     result = "asd";
    //     bootbox.dialog({
    //         size: "small",
    //         title: "Вход в систему",
    //         message: divModal,
    //         buttons:
    //             {
    //                 success:
    //                     {
    //                         label: "Войти",
    //                         className: "button button-small button-white",
    //                         callback: function()
    //                         {
    //                             logInSystem();
    //                         }
    //                     }
    //             }
    //     });
    // });
});

function SearchInTable(query) {
    $.ajax({
        url: ajaxDir + "searchArticles",
        data: {
            "query": query
        },
        method: "post",
        success: function (result)
        {
            $(".result-search-article").html(result);
        }
    });
}

function QuitFromSystem() {
    $.ajax({
        url: ajaxDir + "QuitFromSystem",
        method: "post",
        success: function ()
        {
            location.href = "/login/";
        }
    });
}

function logInSystem()
{
    login = $(".login").val();
    password = $(".password").val();

    $.ajax({
        url: ajaxDir + "checkUserInSystem",
        data: {
            "login": login,
            "password": password
        },
        method: "post",
        type: "post",
        success: function (result)
        {
            resultCheckingUser = parseInt(result);

            if(resultCheckingUser == 1)
            {
                location.href = "/dashboard/";
            }
        }
    });
}


var ReturnCircle = function(classElement)
{
		this.widthParent = $(classElement).parent().width();
		
		$(classElement).css("height", this.widthParent);
		
    this.colorLine = "#efefef";
    this.colorPercent = "#555";

    this.setColorLine = function (color) {
        this.colorLine = color;
    };

    this.setColorPercent = function (color) {
        this.colorPercent = color;
    };

    this.draw = function () {
        var el = $(classElement); // get canvas

        var options = {
            percent:  el.attr('data-percent') || 25,
            size: el.attr('data-size') || this.widthParent,
            lineWidth: el.attr('data-line') || 15,
            rotate: el.attr('data-rotate') || 0
        };

        var canvas = document.createElement('canvas');
        var span = document.createElement('span');
        span.textContent = options.percent + '%';

        if (typeof(G_vmlCanvasManager) !== 'undefined') {
            G_vmlCanvasManager.initElement(canvas);
        }

        var ctx = canvas.getContext('2d');
        canvas.width = canvas.height = options.size;

        el.append(span);
        el.append(canvas);

        ctx.translate(options.size / 2, options.size / 2); // change center
        ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

        var radius = (options.size - options.lineWidth) / 2;

        var drawCircle = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx.strokeStyle = color;
            ctx.lineCap = 'round'; // butt, round or square
            ctx.lineWidth = lineWidth
            ctx.stroke();
        };

        drawCircle(this.colorLine, options.lineWidth, 100 / 100);
        drawCircle(this.colorPercent, options.lineWidth, options.percent / 100);
    };
}






