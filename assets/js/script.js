$(function(){
  $('.add_tab').on('click', function(){

    var chatId = window.prompt("Digite o ID do chat:");
    var chatName = window.prompt("Digite o nome do chat:");
    
    chat.setGroup(chatId, chatName);
  });
});