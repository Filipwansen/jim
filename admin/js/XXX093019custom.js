$(document).ready(function() {	    $('.ctable').DataTable( {
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
    });	});//CME AUDIT start.function cme_audit(id){		//admin_select cme_audit(Pass/Fail)	var audit_result_id = $('#cme_audit_id'+id).val();	var data = {'id':id, 'audit_result_id':audit_result_id };		$.ajax({		url : "?content=content/audit",		method : "POST",		data : data,		async : true,		dataType : 'json',				error: function(data){						jQuery.gritter.add({				title: 'Success!',				text: 'Detail saved successfully.',				//image: 'assets/images/user-profile-2.jpg',							sticky: false,				class_name: 'bg-success',				time: '1000'							});						id = null;						audit_result_id = null;						data = null;		}	});}//save cme audit datafunction save_cme_audit(){		var count_id = $('#id_count').val();    var	id = [];	var issues = [];		for(var i = 1;i<= count_id;i++){		id[i] = $("#" + i).val();		issues[i] = $("#issues_text" + id[i]).val();			} 		var data = {'id':id, 'issues_text':issues };		$.ajax({		url : "?content=content/audit",		method : "POST",		data : data,		async : true,		dataType : 'json',				error: function(data){						jQuery.gritter.add({				title: 'Success!',				text: 'Detail saved successfully.',				//image: 'assets/images/user-profile-2.jpg',							sticky: false,				class_name: 'bg-success',				time: '1000'							});						id = null;						issues = null;						data = null;		}	});	}//CDQ show/no showfunction show_allow(id){ 	//admin_select event(Pass/Fail)	var show_id = $('#show_allow_id'+id).val();		var data = {'id':id, 'show_id':show_id };	$.ajax({				url : "?content=content/exam",		method : "POST",		data : data,		async : true,		dataType : 'json',				error: function(data){					jQuery.gritter.add({			title: 'Success!',			text: 'Detail saved successfully.',			//image: 'assets/images/user-profile-2.jpg',						sticky: false,			class_name: 'bg-success',			time: '1000'						});						id = null;						show_id = null;						data = null;		}	});}//CDQ pass/failfunction admin_select(id){		//admin_select event(Pass/Fail)	var select_id = $('#admin_select_id'+id).val();		var data = {'id':id, 'select_id':select_id };		$.ajax({				url : "?content=content/exam",		method : "POST",		data : data,		async : true,		dataType : 'json',				error: function(data){						jQuery.gritter.add({				title: 'Success!',				text: 'Detail saved successfully.',				//image: 'assets/images/user-profile-2.jpg',							sticky: false,				class_name: 'bg-success',				time: '1000'							});						id = null;						select_id = null;						data = null;		}	});}//Certification show/no showfunction show_certification(id){ 	//admin_select event(Pass/Fail)	var show_id = $('#show_certification_id'+id).val();		var data = {'student_id':id, 'show_certification_id':show_id };	$.ajax({				url : "?content=content/certification",		method : "POST",		data : data,		async : true,		dataType : 'json',				error: function(data){					jQuery.gritter.add({			title: 'Success!',			text: 'Detail saved successfully.',			//image: 'assets/images/user-profile-2.jpg',						sticky: false,			class_name: 'bg-success',			time: '1000'						});						id = null;						show_id = null;						data = null;		}	});}//Certification pass/failfunction admin_certification(id){		//admin_select event(Pass/Fail)	var select_id = $('#admin_certification_id'+id).val();		var data = {'student_id':id, 'admin_certification_id':select_id };		$.ajax({				url : "?content=content/certification",		method : "POST",		data : data,		async : true,		dataType : 'json',				error: function(data){						jQuery.gritter.add({				title: 'Success!',				text: 'Detail saved successfully.',				//image: 'assets/images/user-profile-2.jpg',							sticky: false,				class_name: 'bg-success',				time: '1000'							});						id = null;						select_id = null;						data = null;		}	});}$('#select_cme').click(function() {		// $('#p_feb').show();	// $('#p_june').hide();	$('#select_cme').css("background", "rgb(36,96,139)");	$('#select_cme').css("color", "white");		$('#select_cdq').css("background", "");	$('#select_cdq').css("color", "");	$('#select_certification').css("background", "");	$('#select_certification').css("color", "");});$('#select_cdq').click(function() {		// $('#p_feb').hide();	// $('#p_june').show();	$('#select_cdq').css("background", "rgb(36,96,139)");	$('#select_cdq').css("color", "white");		$('#select_cme').css("background", "");	$('#select_cme').css("color", "");	$('#select_certification').css("background", "");	$('#select_certification').css("color", "");});$('#select_certification').click(function() {		// $('#p_feb').hide();	// $('#p_june').show();	$('#select_certification').css("background", "rgb(36,96,139)");	$('#select_certification').css("color", "white");		$('#select_cdq').css("background", "");	$('#select_cdq').css("color", "");	$('#select_cme').css("background", "");	$('#select_cme').css("color", "");});//save_data$('#save_data').click(function() {		var txt;	var r = confirm("Saved successfully!");	if (r == true) {				location.reload();	} else {				return false;	}});
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

/*
      toolbar: 
      	[
					{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
					{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
					{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
					{ name: 'styles', items: [ 'Styles', 'Format', '-', 'TextColor', 'BGColor', '-', 'Font', 'FontSize' ] },
					'/',
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
					{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
					{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
					{ name: 'insert', items: [ 'EasyImageUpload', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
					{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
					{ name: 'about', items: [ 'About' ] }
      	],
*/

    CKEDITOR.addCss('figure[class*=easyimage-gradient]::before { content: ""; position: absolute; top: 0; bottom: 0; left: 0; right: 0; }' +
      'figure[class*=easyimage-gradient] figcaption { position: relative; z-index: 2; }' +
      '.easyimage-gradient-1::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 66, 174, 234, .72 ) 100% ); }' +
      '.easyimage-gradient-2::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 228, 66, 234, .72 ) 100% ); }');

    CKEDITOR.replace('editor', {
      extraPlugins: 'easyimage',
      removePlugins: 'image',
      removeDialogTabs: 'link:advanced',
      toolbar: 
      	[
					{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
					{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
					{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
					{ name: 'styles', items: [ 'Styles', 'Format', '-', 'TextColor', 'BGColor', '-', 'Font', 'FontSize' ] },
					'/',
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
					{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
					{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
					{ name: 'insert', items: [ 'EasyImageUpload', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
					{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
					{ name: 'about', items: [ 'About' ] }
      	],
     height: 630,
      cloudServices_uploadUrl: 'https://33333.cke-cs.com/easyimage/upload/',
      // Note: this is a token endpoint to be used for CKEditor 4 samples only. Images uploaded using this token may be deleted automatically at any moment.
      // To create your own token URL please visit https://ckeditor.com/ckeditor-cloud-services/.
      cloudServices_tokenUrl: 'https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt',
      easyimage_styles: {
        gradient1: {
          group: 'easyimage-gradients',
          attributes: {
            'class': 'easyimage-gradient-1'
          },
          label: 'Blue Gradient',
          icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/gradient1.png',
          iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/gradient1.png'
        },
        gradient2: {
          group: 'easyimage-gradients',
          attributes: {
            'class': 'easyimage-gradient-2'
          },
          label: 'Pink Gradient',
          icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/gradient2.png',
          iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/gradient2.png'
        },
        noGradient: {
          group: 'easyimage-gradients',
          attributes: {
            'class': 'easyimage-no-gradient'
          },
          label: 'No Gradient',
          icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/nogradient.png',
          iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/nogradient.png'
        }
      },
      easyimage_toolbar: [
        'EasyImageFull',
        'EasyImageSide',
        'EasyImageGradient1',
        'EasyImageGradient2',
        'EasyImageNoGradient',
        'EasyImageAlt'
      ]
    });
    

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
//    initSample();
}