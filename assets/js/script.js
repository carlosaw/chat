function abrirChat() {
  var cid = $('#chat_id').val();
  var cnm = $('#chat_name').val();

  chat.setGroup(cid, cnm);

  $('.modal_bg').hide();
}

function fecharModal() {
	$('.modal_bg').hide();//Fechar o modal
}

$(function(){
  $('.add_tab').on('click', function(){

    var html = '<h1>Nova janela de batepapo</h1><input type="text" id="chat_id" placeholder="Digite o ID do chat:" /><br/><br/>';
    html += '<input type="text" id="chat_name" placeholder="Digite o NOME do chat:" /><br/><br/>';
    html += '<button onclick="abrirChat()">Abrir</button><br/><br/><hr/>';
    html += '<button onclick="fecharModal()">Fechar janela</button>'

    $('.modal_area').html(html);
    $('.modal_bg').show();
  });
});