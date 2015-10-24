$(document).ready(function () {
    var imagen = "";
    var careers = "";
    $.get("http://localhost/projectrsa/student/get_careers", function(career){
        careers = JSON.parse(career) ;
    });
    
    //editamos datos del estudiante
    $(".editar").on('click', function () {

        var id = $(this).attr('id');
        $(location).attr('href', "student/edit/"+id);

    });

    //eliminamos datos del estudiante
    $(".eliminar").on('click', function () {

        var id = $(this).attr('id');
        var name = $("#name" + id).html();

        $("<div class='delete_modal'>¡Estás seguro que deseas eliminar al estudiante " + name + "?</div>").dialog({

            resizable:false,
            title:'Eliminar al estudiante ' + name + '.',
            height:200,
            width:450,
            modal:true,
            buttons:{

                "Eliminar":function () {
                    $.ajax({
                        type:'POST',
                        url:'http://localhost/projectrsa/student/delete_student',
                        async: true,
                        data: { id : id },
                        complete:function () {
                            $('.delete_modal').dialog("close");
                            $("<div class='delete_modal'>El estudiante " + name + " fué eliminado correctamente</div>").dialog({
                                resizable:false,
                                title:'Estudiante eliminado.',
                                height:200,
                                width:450,
                                modal:true
                            });

                            setTimeout(function() {
                                window.location.href = "http://localhost/projectrsa/student";
                            }, 1000);

                        }, error:function (error) {

                            $('.delete_modal').dialog("close");
                            $("<div class='delete_modal'>Ha ocurrido un error!</div>").dialog({
                                resizable:false,
                                title:'Error eliminando al estudiante!.',
                                height:200,
                                width:550,
                                modal:true

                            });

                        }

                    });
return false;
},
Cancelar:function () {
    $(this).dialog("close");
}
}
});
});
function cargar(evt) {

    var files = evt.target.files; // FileList object
    var f = files[0];
    var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          imagen = e.target.result;
          title = escape(theFile.name);
          span.innerHTML = ['<img style="width: 200px; height: 200px; class="thumb" src="', e.target.result,
          '" title="', escape(theFile.name), '"/>'].join('');
          $('#list').html(span);
      };
  })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
  };

    //añadimos estudiantes nuevos
    $(".agregar").on('click', function () {
        $("<div class='insert_modal'><form class='add_popup' name='insert' id='insert' method='post' action='http://localhost/projectrsa/student/multi_student'>"+
            "<label>Nombre</label><br/><input type='text' name='name' class='name'  id='name' /><br/>"+
            "<input type='hidden' name='photo' class='photo' id='photo' value="+imagen+">"+
            "<label>Cedula</label><br/><input type='text' name='cedula' class='cedula'  id='cedula' /><br/>"+
            "<label>Nivel de Inglés</label><br/><select name='english' id='english' class='english'><option>Principiante</option>"+
            "<option>Intermedio</option><option>Avanzado</option></select><br/>"+
            "<label>Carreras</label><br/><select name='career' class='career' id='career'>"+careers+"</select><br/>"+
            "<label>Seleccione la imagen</label><input id='files' name='files' class= 'files' type='file'  size='5' required/> <output id='list'></output>"+
            "<br/></form><div class='respuesta'></div></div>").dialog({

                resizable:false,
                title:'Añadir nuevo estudiante.',
                height:650,
                width:520,
                modal:true,
                buttons:{

                    "Insertar":function () {
                        var elem = document.getElementById("photo");
                        elem.value = imagen;
                        $.ajax({
                            url : $('#insert').attr("action"),
                            type : $('#insert').attr("method"),
                            data : $('#insert').serialize(),

                            success:function (data) {

                                var obj = JSON.parse(data);

                                if(obj.respuesta == 'error')
                                {
                                    $(".respuesta").html(obj.name + '<br />' + obj.cedula );
                                    return false;

                                }else{

                                    $('.insert_modal').dialog("close");
                                    $("<div class='insert_modal'>El estudiante fué añadido correctamente</div>").dialog({
                                        resizable:false,
                                        title:'Estudiante añadido.',
                                        height:200,
                                        width:520,
                                        modal:true
                                    });
                                    setTimeout(function() {
                                        window.location.href = "http://localhost/projectrsa/student";
                                    }, 1000);
                                }

                            }, error:function (error) {
                                $('.insert_modal').dialog("close");
                                $("<div class='insert_modal'>Ha ocurrido un error!</div>" ).dialog({
                                    resizable:false,
                                    title:'Error añadiendo!.',
                                    height:200,
                                    width:450,
                                    modal:true
                                });
                            }
                        });
return false;
},
Cancelar:function () {
    $(this).dialog("close");
}
}
});
document.getElementById('files').addEventListener('change', cargar, false);
});


$(".listar").on('click', function () {

    var id = $(this).attr('id');
    var carrera = $("#career" + id).html();
    var ingles = $("#english" + id).html();
    
    $.ajax({
        url: "http://localhost/projectrsa/student/get_student/"+id,
        type: "GET",
        success: function(student){
        var response = JSON.parse(student);
        var popup = "<div class='view_modal'><form class='view_popup' name='view' id='view' method='post' action='#'>"+
        response+
        "<label>Carrera</label><br/><input type='text' name='carrera' class='carrera' value="+carrera+" id='carrera' readonly/><br/>"+
        "<label>Ingles</label><br/><input type='text' name='ingles' class='ingles' value="+ingles+" id='ingles' readonly/><br/>"+
        "</form></div>";
        $(popup).dialog({

            resizable:false,
            title: "Ver estudiante",
            height:570,
            width:450,
            modal:true,
            buttons:{

                "Volver":function () {
                    $.ajax({
                        url : $('#view').attr("action"),
                        type : $('#view').attr("method"),
                        data : $('#view').serialize(),

                        success:function (data) {

                            $('.view_modal').dialog("close");

                        }, error:function (error) {
                            $('.view_modal').dialog("close");
                            $("<div class='view_modal'>Ha ocurrido un error!</div>").dialog({
                                resizable:false,
                                title:'Error!.',
                                height:200,
                                width:450,
                                modal:true
                            });
                        }

                    });
                    return false;
                }
            }
        });
    },error: function(){},async: false,
    });
});

//default theme(CSS) is cerulean, change it if needed
var defaultTheme = 'cerulean';

var currentTheme = $.cookie('currentTheme') == null ? defaultTheme : $.cookie('currentTheme');
var msie = navigator.userAgent.match(/msie/i);
$.browser = {};
$.browser.msie = {};
switchTheme(currentTheme);

$('.navbar-toggle').click(function (e) {
    e.preventDefault();
    $('.nav-sm').html($('.navbar-collapse').html());
    $('.sidebar-nav').toggleClass('active');
    $(this).toggleClass('active');
});

var $sidebarNav = $('.sidebar-nav');

    // Hide responsive navbar on clicking outside
    $(document).mouseup(function (e) {
        if (!$sidebarNav.is(e.target) // if the target of the click isn't the container...
            && $sidebarNav.has(e.target).length === 0
            && !$('.navbar-toggle').is(e.target)
            && $('.navbar-toggle').has(e.target).length === 0
            && $sidebarNav.hasClass('active')
            )// ... nor a descendant of the container
        {
            e.stopPropagation();
            $('.navbar-toggle').click();
        }
    });


    $('#themes a').click(function (e) {
        e.preventDefault();
        currentTheme = $(this).attr('data-value');
        $.cookie('currentTheme', currentTheme, {expires: 365, path: '/' });
        switchTheme(currentTheme);
    });

    function switchTheme(themeName) {
        if (themeName == 'classic') {
            $('#bs-css').attr('href', 'bower_components/bootstrap/dist/css/bootstrap.min.css');
        } else {
            $('#bs-css').attr('href', 'css/bootstrap-' + themeName + '.min.css');
        }

        $('#themes i').removeClass('glyphicon glyphicon-ok whitespace').addClass('whitespace');
        $('#themes a[data-value=' + themeName + ']').find('i').removeClass('whitespace').addClass('glyphicon glyphicon-ok');
    }

    //ajax menu checkbox
    $('#is-ajax').click(function (e) {
        $.cookie('is-ajax', $(this).prop('checked'), {expires: 365});
    });
    $('#is-ajax').prop('checked', $.cookie('is-ajax') === 'true' ? true : false);

    //disbaling some functions for Internet Explorer
    if (msie) {
        $('#is-ajax').prop('checked', false);
        $('#for-is-ajax').hide();
        $('#toggle-fullscreen').hide();
        $('.login-box').find('.input-large').removeClass('span10');

    }


    //highlight current / active link
    $('ul.main-menu li a').each(function () {
        if ($($(this))[0].href == String(window.location))
            $(this).parent().addClass('active');
    });

    //establish history variables
    var
        History = window.History, // Note: We are using a capital H instead of a lower h
        State = History.getState(),
        $log = $('#log');

    //bind to State Change
    History.Adapter.bind(window, 'statechange', function () { // Note: We are using statechange instead of popstate
        var State = History.getState(); // Note: We are using History.getState() instead of event.state
        $.ajax({
            url: State.url,
            success: function (msg) {
                $('#content').html($(msg).find('#content').html());
                $('#loading').remove();
                $('#content').fadeIn();
                var newTitle = $(msg).filter('title').text();
                $('title').text(newTitle);
                docReady();
            }
        });
    });

    //ajaxify menus
    $('a.ajax-link').click(function (e) {
        if (msie) e.which = 1;
        if (e.which != 1 || !$('#is-ajax').prop('checked') || $(this).parent().hasClass('active')) return;
        e.preventDefault();
        $('.sidebar-nav').removeClass('active');
        $('.navbar-toggle').removeClass('active');
        $('#loading').remove();
        $('#content').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');
        var $clink = $(this);
        History.pushState(null, null, $clink.attr('href'));
        $('ul.main-menu li.active').removeClass('active');
        $clink.parent('li').addClass('active');
    });

    $('.accordion > a').click(function (e) {
        e.preventDefault();
        var $ul = $(this).siblings('ul');
        var $li = $(this).parent();
        if ($ul.is(':visible')) $li.removeClass('active');
        else                    $li.addClass('active');
        $ul.slideToggle();
    });

    $('.accordion li.active:first').parents('ul').slideDown();


    //other things to do on document ready, separated for ajax calls
    docReady();
});


function docReady() {
    //prevent # links from moving to top
    $('a[href="#"][data-top!=true]').click(function (e) {
        e.preventDefault();
    });

    //notifications
    $('.noty').click(function (e) {
        e.preventDefault();
        var options = $.parseJSON($(this).attr('data-noty-options'));
        noty(options);
    });

    //chosen - improves select
    $('[data-rel="chosen"],[rel="chosen"]').chosen();

    //tabs
    $('#myTab a:first').tab('show');
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });


    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //auto grow textarea
    $('textarea.autogrow').autogrow();

    //popover
    $('[data-toggle="popover"]').popover();

    //iOS / iPhone style toggle switch
    $('.iphone-toggle').iphoneStyle();

    //star rating
    $('.raty').raty({
        score: 4 //default stars
    });

    //uploadify - multiple uploads
    $('#file_upload').uploadify({
        'swf': 'misc/uploadify.swf',
        'uploader': 'misc/uploadify.php'
        // Put your options here
    });

    //gallery controls container animation
    $('ul.gallery li').hover(function () {
        $('img', this).fadeToggle(1000);
        $(this).find('.gallery-controls').remove();
        $(this).append('<div class="well gallery-controls">' +
            '<p><a href="#" class="gallery-edit btn"><i class="glyphicon glyphicon-edit"></i></a> <a href="#" class="gallery-delete btn"><i class="glyphicon glyphicon-remove"></i></a></p>' +
            '</div>');
        $(this).find('.gallery-controls').stop().animate({'margin-top': '-1'}, 400);
    }, function () {
        $('img', this).fadeToggle(1000);
        $(this).find('.gallery-controls').stop().animate({'margin-top': '-30'}, 200, function () {
            $(this).remove();
        });
    });


    //gallery image controls example
    //gallery delete
    $('.thumbnails').on('click', '.gallery-delete', function (e) {
        e.preventDefault();
        //get image id
        //alert($(this).parents('.thumbnail').attr('id'));
        $(this).parents('.thumbnail').fadeOut();
    });
    //gallery edit
    $('.thumbnails').on('click', '.gallery-edit', function (e) {
        e.preventDefault();
        //get image id
        //alert($(this).parents('.thumbnail').attr('id'));
    });

    //gallery colorbox
    $('.thumbnail a').colorbox({
        rel: 'thumbnail a',
        transition: "elastic",
        maxWidth: "95%",
        maxHeight: "95%",
        slideshow: true
    });

    //gallery fullscreen
    $('#toggle-fullscreen').button().click(function () {
        var button = $(this), root = document.documentElement;
        if (!button.hasClass('active')) {
            $('#thumbnails').addClass('modal-fullscreen');
            if (root.webkitRequestFullScreen) {
                root.webkitRequestFullScreen(
                    window.Element.ALLOW_KEYBOARD_INPUT
                    );
            } else if (root.mozRequestFullScreen) {
                root.mozRequestFullScreen();
            }
        } else {
            $('#thumbnails').removeClass('modal-fullscreen');
            (document.webkitCancelFullScreen ||
                document.mozCancelFullScreen ||
                $.noop).apply(document);
        }
    });

    //tour
    if ($('.tour').length && typeof(tour) == 'undefined') {
        var tour = new Tour();
        tour.addStep({
            element: "#content", /* html element next to which the step popover should be shown */
            placement: "top",
            title: "Custom Tour", /* title of the popover */
            content: "You can create tour like this. Click Next." /* content of the popover */
        });
        tour.addStep({
            element: ".theme-container",
            placement: "left",
            title: "Themes",
            content: "You change your theme from here."
        });
        tour.addStep({
            element: "ul.main-menu a:first",
            title: "Dashboard",
            content: "This is your dashboard from here you will find highlights."
        });
        tour.addStep({
            element: "#for-is-ajax",
            title: "Ajax",
            content: "You can change if pages load with Ajax or not."
        });
        tour.addStep({
            element: ".top-nav a:first",
            placement: "bottom",
            title: "Visit Site",
            content: "Visit your front end from here."
        });

        tour.restart();
    }

    //datatable
    $('.datatable').dataTable({
        "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-12'i><'col-md-12 center-block'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        }
    });
    $('.btn-close').click(function (e) {
        e.preventDefault();
        $(this).parent().parent().parent().fadeOut();
    });
    $('.btn-minimize').click(function (e) {
        e.preventDefault();
        var $target = $(this).parent().parent().next('.box-content');
        if ($target.is(':visible')) $('i', $(this)).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        else                       $('i', $(this)).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        $target.slideToggle();
    });
    $('.btn-setting').click(function (e) {
        e.preventDefault();
        $('#myModal').modal('show');
    });


    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: '2014-06-12',
        events: [
        {
            title: 'All Day Event',
            start: '2014-06-01'
        },
        {
            title: 'Long Event',
            start: '2014-06-07',
            end: '2014-06-10'
        },
        {
            id: 999,
            title: 'Repeating Event',
            start: '2014-06-09T16:00:00'
        },
        {
            id: 999,
            title: 'Repeating Event',
            start: '2014-06-16T16:00:00'
        },
        {
            title: 'Meeting',
            start: '2014-06-12T10:30:00',
            end: '2014-06-12T12:30:00'
        },
        {
            title: 'Lunch',
            start: '2014-06-12T12:00:00'
        },
        {
            title: 'Birthday Party',
            start: '2014-06-13T07:00:00'
        },
        {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2014-06-28'
        }
        ]
    });

}


//additional functions for data table
$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
}
$.extend($.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function (oSettings, nPaging, fnDraw) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function (e) {
                e.preventDefault();
                if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                    fnDraw(oSettings);
                }
            };

            $(nPaging).addClass('pagination').append(
                '<ul class="pagination">' +
                '<li class="prev disabled"><a href="#">&larr; ' + oLang.sPrevious + '</a></li>' +
                '<li class="next disabled"><a href="#">' + oLang.sNext + ' &rarr; </a></li>' +
                '</ul>'
                );
            var els = $('a', nPaging);
            $(els[0]).bind('click.DT', { action: "previous" }, fnClickHandler);
            $(els[1]).bind('click.DT', { action: "next" }, fnClickHandler);
        },

        "fnUpdate": function (oSettings, fnDraw) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

            if (oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            }
            else if (oPaging.iPage <= iHalf) {
                iStart = 1;
                iEnd = iListLength;
            } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for (i = 0, iLen = an.length; i < iLen; i++) {
                // remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                // add the new list items and their event handlers
                for (j = iStart; j <= iEnd; j++) {
                    sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                    $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                    .insertBefore($('li:last', an[i])[0])
                    .bind('click', function (e) {
                        e.preventDefault();
                        oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                        fnDraw(oSettings);
                    });
                }

                // add / remove disabled classes from the static elements
                if (oPaging.iPage === 0) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }

                if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
});
