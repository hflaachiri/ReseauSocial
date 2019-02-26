
<div class="add-post-home">
    <form enctype="multipart/form-data">
        <div class="form-group">
            <textarea class="form-control" id="messageContent" placeholder="Partagez votre journée ..." rows="3"></textarea>
        </div>
        <input type="file" id="imagePost" name="image" class="btn" accept="image/*">
        <button type="button" onclick="sendMessage()" class="btn btn-outline-danger pull-right">Poster</button>
    </form>
</div>

<script>
    var userId = <?php echo ($context->getSessionAttribute('user')['id'])?>;
	function sendMessage(){
		var message = {
            emetteur: userId,
            destinataire: userId,
			texte : $("#messageContent").val()
		};
        console.log($("#imagePost").prop("files")[0])
        var formData = new FormData();
        formData.append("message", JSON.stringify(message));
        formData.append("image", $("#imagePost").prop("files")[0]);
		$.ajax({
			type: 'POST',
			url: '/~uapv1900168/monFace.php?action=saveMessage',
            cache: false,
            contentType: false,
            processData: false,
			data: formData,
			success: function(msg){
                getPosts();
                $("#messageContent").val('');
                $("#imagePost").val('');
			}
		});
	}
</script>
