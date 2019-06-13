$('recipe').on('click', function(){
	box = $('<input>').attr('type', 'textbox').val($(this).text())
	box.on('blur', function() {
		// make ajax call to save edit
		pnid = box.parent().attr("id")
		console.log(pnid);
		$.ajax({url : baseurl + "/changeName/" + pnid + "/" + $(this).val(), dataType: "text"})
		.done(function(data) {
			$("recipe").text(data)
			box.remove()
		})
	})
	$(this).text("")
	$(this).append(box)
	box.select()
})

$('step').on('click', function(){
	box = $('<input>').attr('type', 'textbox').val($(this).text())
	box.on('blur', function() {
		//make ajax call to save edit
		pnid = box.parent().attr("id")
		$.ajax({url : baseurl + "/changeStep/" + pnid + "/" + $(this).val(), dataType: "text"})
		.done(function(data) {
			$("#"+pnid).text(data)
			box.remove()
		})
	})
	$(this).text("")
	$(this).append(box)
	box.select()
})

$("#add").on('click', function(){
	li = $('<li>')
	step = $('<step>').on('click', function(){
		box = $('<input>').attr('type', 'textbox').val($(this).text())
		box.on('blur', function() {
			//make ajax call to save edit
			pnid = box.parent().attr("id")
			$.ajax({url : baseurl + "/changeStep/" + pnid + "/" + $(this).val(), dataType: "text"})
			.done(function(data) {
				$("#"+pnid).text(data)
				box.remove()
			})
		})
		$(this).text("")
		$(this).append(box)
		box.select()
	})
	box = $('<input>').attr('type', 'textbox').val("")
	box.on('blur', function() {
		//make ajax call to save edit
		pnid = $("#top").find("recipe").attr("id")
		$.ajax({url : baseurl + "/addStep/" + pnid + "/" + $(this).val(), dataType: "json"})
		.done(function(data) {
			console.log(data)
			box.parent().text(data.info).attr("id", data.stepid)
			var si = data.stepid.toString()
			li.attr("id", "s" + si)
			box.remove()
			original = $("#steps").sortable("toArray")
		})
	})
	step.append(box)
	li.append(step)
	$("#steps").append(li)
	box.select()
})

$( "#steps" ).sortable({
	axis:"y"
});
$( "#steps" ).disableSelection();
var original = $("#steps").sortable("toArray")
// console.log(original)

function ajaxCall(stepId, newStepNumber){
	$.ajax({url : baseurl + "/reorder/" + stepId + "/" + newStepNumber, dataType: "text"})
		.done(function(data) {
			original = $("#steps").sortable("toArray")
			console.log("re-ordered")
		})
}


$("#steps").on("sortupdate", function(){
	var modified = $("#steps").sortable("toArray")
	console.log(original)
	console.log(modified)
	for(var i = modified.length; i >= 0; i--){
		if(original[i] != modified[i]){
			var originalVal = original[i]
			var modifiedVal = modified[i]
			var newIndex = 0
			for(var j = 0; j < modified.length; j++){
				if(modified[j] == originalVal){
					newIndex = j
				}
			}
			if(i - newIndex > 1){
				newIndex += 1
				var actualId = originalVal.replace("s", "")
				ajaxCall(actualId, newIndex)
				break 
			}
			else if(i - newIndex == 1){
				var newStepNum = i+1
				var actuId = modifiedVal.replace("s", "")
				ajaxCall(actuId, newStepNum)
				break
			}
		}
	}
})