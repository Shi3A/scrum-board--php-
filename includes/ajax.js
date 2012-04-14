$(document).ready(function() {
    $(".new_task").click(function() {
        var main_id = $(this).attr("id");
        var cssObj = {
    	    'color' : '#000',
    	    'text-align' : 'left',
        }
        $(this).css(cssObj);
	$(this).removeAttr("readonly");
	$(this).val('');
	$(this).autoResize({
	    // On resize:
	    onResize : function() {
	        $(this).css({opacity:0.8});
	    },
	    animate : true,
	    // Quite slow animation:
	    animateDuration : 200,
	    // After resize:
	    animateCallback : function() {
	        $(this).css({opacity:1});
	    },
	    // More extra space:
	    extraSpace : 5,
	}
	);
	
    });
    
    $(".new_task").change(function() {
	$(this).attr("readonly","readonly");
        var main_id = $(this).attr("id");
        var text = $(this).val();
	
	$.ajax({
    	    type: "POST",
    	    url: "/includes/newtask.php",
    	    data: { task_text:  text, cid: main_id },
            success: (function(){
	     $.post(
	        "/includes/column.php",
	        {cid: main_id},
	        function(data) {
	    	    $('#'+main_id).parent().siblings(".tasks").html('');
	    	    $('#'+main_id).parent().siblings(".tasks").html(data);
	        }
	     );
            }),
    	});
    	
        var cssObj = {
    	    'color' : '#c4c2f1',
    	    'text-align' : 'center',
        }
        $(this).css(cssObj);
        $(this).val('Новая задача');

    });
    $(".task_edit").live("click", function(){
	var parentid = $(this).parent().parent('.task').attr("id");
	$('.task_title').attr('contenteditable', 'false');
	$('.task_content').attr('contenteditable', 'false');
	$(this).parent().siblings(".task_title").css('min-height', '14px');
	$(this).parent().siblings(".task_content").css('min-height', '14px');
	$(this).parent().siblings(".task_title").attr('contenteditable', 'true').blur(function(){
	    var title = $('#'+parentid + " .task_title").text();
	     $.post(
	        "/includes/edittask.php",
	        { title: title, tid : parentid }
	     );

		$('#'+parentid + " .task_title").attr('contenteditable', 'false');
	    });
	$(this).parent().siblings(".task_content").attr('contenteditable', 'true').blur(function(){
//		alert(parentid);
//		$('#'+parentid).siblings(".task_content").attr('contenteditable', 'false');
//		alert($('#'+parentid + " .task_content").html());
		var content = $('#'+parentid + " .task_content").html();
		$.post(
	    	    "/includes/edittask.php",
	    	    { content: content, tid : parentid }
	        );
		$('#'+parentid + " .task_content").attr('contenteditable', 'false');
	    });
    });
});

