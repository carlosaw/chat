var chat = {

  groups:[],
  activeGroup:0,

  setGroup:function(id, name) {
    var found = false;

    for(var i in this.groups) {
      if(this.groups[i].id == id) {
        found = true;
      }
    }

    if(found == false) {
      this.groups.push({
        id: id,
        name: name
      });
    }
    this.updateGroupView();
  },

  getGroups:function() {
    return this.groups;
  },

  // Webservice para retornar a lista de grupos
  loadGroupList:function (ajaxCallback) {
    //alert("Carregar a lista e mostrar em: "+id);		
    $.ajax({
      url:BASE_URL+'ajax/get_groups',
      type:'GET',
      dataType:'json',
      success:function(json) {
        //alert("Recebeu os dados!");
        if(json.status == '1') {
          ajaxCallback(json);
        } else {// se não estiver logado
          window.location.href = BASE_URL+'login';
        }
      }
    });
  },
  // Webservice para criar novo grupo
  addNewGroup:function(groupName, ajaxCallback) {
    $.ajax({
      url:BASE_URL + 'ajax/add_group',
      type:'POST',
      data:{name:groupName},
      dataType:'json',
      success:function(json) {
        if (json.status == '1') {
          ajaxCallback(json);
        } else {// se não estiver logado
          window.location.href = BASE_URL+'login';
        }
      }
    });
  },

  updateGroupView:function() {
    var html = '';
     for(var i in this.groups) {
       html += '<li data-id="'+this.groups[i].id+'">'+this.groups[i].name+'</li>';
     }
     $('nav ul').html(html);
  },

  setActiveGroup:function(id) {
    this.activeGroup = id;//Seta o grupo pelo id
    this.loadConversation();//Atualiza o layout da tela
  },
  getActiveGroup:function() {
    return this.activeGroup;
  },

  loadConversation:function() {
    if(this.activeGroup != 0) {
      $('nav ul').find('.active_group').removeClass('active_group');//Remove a classe
      $('nav ul').find('li[data-id='+this.activeGroup+']').addClass('active_group');//Muda a cor do grupo ativo
    }
    // Pegar conversa daquele grupo
    //this.showMessages();
  },
};