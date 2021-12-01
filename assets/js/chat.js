var chat = {

  groups:[],

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
       html += '<li>'+this.groups[i].name+'</li>';
     }
     $('nav ul').html(html);
  },

};