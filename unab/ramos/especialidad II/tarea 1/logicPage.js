function addComments() {
    const text = $("#textComments").val();
    if(!text || text.length<=0) return;
    $("#balloonChats").append(`<div class="comments-record-balloon">
    <img style="width: 50px;" src="img/selecciones/chile.png">
    <p style="width: 100%">${text}</p>
    </div>`);
    $("#textComments").val("");
}