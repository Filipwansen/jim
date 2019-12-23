$(document).ready(function() {
    $('.ctable').DataTable( {
        // "scrollX": true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        // order: [[ 1, 'asc' ]],
        paging: false
    });
    $('.stable').DataTable( {
        // "scrollX": true,
        paging: false
    });
    $(".paggingTable").DataTable({
        pageLength: 20
    });
    $('.otable').DataTable( {
        // "scrollX": true,
        paging: false,
        ordering: false
    });
    $('.ptable').DataTable( {
        "scrollX": true,

        dom: 'Bfrtip',
        buttons: [
            'print'
        ],
        paging: false
    });
    $('.ntable').DataTable( {
        "scrollX": false,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        // order: [[ 1, 'asc' ]],
        paging: false
    });
});

$(".quesType").on("change", function(){
    var selectedvalue = $(this).children("option:selected").val();
    if(selectedvalue == 1){
        $(".radioQuestion").slideUp();
        $(".textQuestion").slideDown();
    }
    else if( selectedvalue == 2){
        $(".textQuestion").slideUp();
        $(".radioQuestion").slideDown();
    }
});
$(".replyBtn a").on("click", function(){
    $(".replyBtn").slideToggle("slow");
    $(".replyBlock").slideToggle("slow");
});
$(".replyClose").on("click", function () {
    $(".replyBtn").slideToggle("slow");
    $(".replyBlock").slideToggle("slow");
});
$(".top-heading").on("click", function(){
    $(this).children(".toggler").toggleClass("active");
    $(".admin-cards.card").slideToggle("slow");
    EqualHeightAdminCards();
});
$(".middle-heading2").on("click", function(){
    $(this).children(".toggler").toggleClass("active");
    $(".portal-cards.card").slideToggle("slow");
    if($(".portal-cards").length > 0) {
        var maxHeight = -1;
        $('section.mainContent .portal-cards .card').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });

        $('section.mainContent .portal-cards .card').each(function() {
            $(this).height(maxHeight);
        });
    }

});
$(".middle-heading").on("click", function(){
    $(this).children(".toggler").toggleClass("active");
    $(".portal-member.card").slideToggle("slow");

});
function EqualHeightAdminCards(){
    if($(".admin-cards").length > 0) {
        var maxHeight = -1;
        $('section.mainContent .admin-cards .adminCard').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });

        $('section.mainContent .admin-cards .adminCard').each(function() {
            $(this).height(maxHeight);
        });
    }
}


if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
    CKEDITOR.tools.enableHtml5Elements( document );

// The trick to keep the editor in the sample quite small
// unless user specified own height.
CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';

var initSample = ( function() {
    var wysiwygareaAvailable = isWysiwygareaAvailable(),
        isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

    return function() {
        var editorElement = CKEDITOR.document.getById( 'editor' );

        // :(((
        if ( isBBCodeBuiltIn ) {
            editorElement.setHtml(
                'Hello world!\n\n' +
                'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
            );
        }

        // Depending on the wysiwygarea plugin availability initialize classic or inline editor.
        if ( wysiwygareaAvailable ) {
            CKEDITOR.replace( 'editor' );
        } else {
            editorElement.setAttribute( 'contenteditable', 'true' );
            CKEDITOR.inline( 'editor' );

            // TODO we can consider displaying some info box that
            // without wysiwygarea the classic editor may not work.
        }
    };

    function isWysiwygareaAvailable() {
        // If in development mode, then the wysiwygarea must be available.
        // Split REV into two strings so builder does not replace it :D.
        if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
            return true;
        }

        return !!CKEDITOR.plugins.get( 'wysiwygarea' );
    }
} )();

if($("#editor").length > 0){
    initSample();
}