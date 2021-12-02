function addGroupModal() {
  var html = '<h1>Criar Nova Sala</h1>';

  html += '<input type="text" id="newGroupName" placeholder="Digite o nome da nova sala." />';
  html += '<br/><br/><div class="btn_x">'
  html += '<button id="newGroupButton">Cadastrar</button>';
  html += '<button onclick="fecharModal()">Fechar Janela</button></div>';

  $('.modal_area').html(html);
  $('.modal_bg').show();

  $('#newGroupButton').on('click', function(){
    var newGroupName = $('#newGroupName').val();

    if(newGroupName != '') {
      chat.addNewGroup(newGroupName, function(json) {
        if (json.error == '0') {
          $('.add_tab').click();
        } else {
          alert(json.errorMsg);
        }
      });
    }
  });
}

function fecharModal() {
	$('.modal_bg').hide();//Fechar o modal
}

$(function(){

  chat.chatActivity();

  $('.add_tab').on('click', function(){

    var html = '<h1>Escolha uma sala de Bate Papo</h1>';
    html += '<div id="groupList">Carregando...</div>';
    html += '<br/><br/><div class="btn_x">'
    html += '<button onclick="addGroupModal()">Criar Nova Sala</button>';
    html += '<button onclick="fecharModal()">Fechar Janela</button></div>';

    $('.modal_area').html(html);
    $('.modal_bg').show();

    chat.loadGroupList(function(json){
      var html = '';
      for(var i in json.list) {
        html += '<button data-id="'+json.list[i].id +'">'+json.list[i].name+'</button>'
      }
      $('#groupList').html(html);
      // Para ações de clique nos botões do modal
      $('#groupList').find('button').on('click', function(){
        var cid = $(this).attr('data-id');
        var cnm = $(this).text();

        chat.setGroup(cid, cnm);//Pega id e nome
        $('.modal_bg').hide();//Fecha o modal
      });
    });
  });

  //Evento de clique nos lis do menu
  $('nav ul').on('click', 'li', function(){
    var id = $(this).attr('data-id');
    //alert("Clicou em: "+id);
    chat.setActiveGroup(id);//Seta o grupo como ativo pelo id
  });

  $('#sender_input').on('keyup', function(e){
    //console.log(e.keyCode);//Pega o codigo de cada tecla
    if(e.keyCode == 13) {
      var msg = $(this).val();//Pega a mensagem digitada
      $(this).val('');//Limpa o campo de mensagens

      chat.sendMessage(msg);
    }
  });
  
});