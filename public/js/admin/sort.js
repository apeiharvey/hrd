function getParameter(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
  }
  var sort = getParameter('sort');
  var order = getParameter('order');
  if(sort=='name'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Name', '?sort=name&order=asc');
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Name', '?sort=name&order=desc');
    }
  } 
  if(sort=='title'){
    if(order=='asc'){
      window.history.pushState({'order':'desc'}, 'Sort Title', '?sort=title&order=asc');
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Title', '?sort=title&order=desc');
    }
  } 
  if(sort=='order'){
    if(order=='desc'){
      window.history.pushState({'order':'asc'}, 'Sort Order', '?sort=order&order=desc')
    }
    else{
    	window.history.pushState({'order':'desc'}, 'Sort Order', '?sort=order&order=asc');
    }
  }
  if(sort=='name_alias'){
    if(order=='desc'){
      window.history.pushState({'order':'asc'}, 'Sort Alias', '?sort=alias&order=desc')
    }
    else{
    	window.history.pushState({'order':'desc'}, 'Sort Alias', '?sort=alias&order=asc');
    }
  }
  if(sort=='url'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort URL', '?sort=link&order=desc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort URL', '?sort=link&order=asc');
    }
  } 
  if(sort=='description'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Desc', '?sort=description&order=desc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Desc', '?sort=description&order=asc');
    }
  }
  if(sort=='view'){
    if(order=='asc'){
      window.history.pushState({'order':'desc'}, 'Sort View', '?sort=view&order=asc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort View', '?sort=view&order=desc');
    }
  }
  if(sort=='phone'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Phone', '?sort=phone&order=asc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Phone', '?sort=phone&order=desc');
    }
  }
  if(sort=='firstname'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Name', '?sort=firstname&order=asc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Name', '?sort=firstname&order=desc');
    }
  }
  if(sort=='updated_at'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Created At', '?sort=created&order=asc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Created At', '?sort=created&order=desc');
    }
  }
  if(sort=='active'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Status', '?sort=status&order=asc')
    }
    else{
    	window.history.pushState({'order':'asc'}, 'Sort Status', '?sort=status&order=desc');
    }
  }
  if(sort=='email'){
    if(order=='desc'){
      window.history.pushState({'order':'desc'}, 'Sort Email', '?sort=email&order=asc')
    }
    else{
      window.history.pushState({'order':'asc'}, 'Sort Email', '?sort=email&order=desc');
    }
  }
  if(sort=='status_id'){
    if(order=='desc'){
      window.history.pushState({'order':'asc'}, 'Sort Status', '?sort=status&order=asc')
    }
    else{
      window.history.pushState({'order':'desc'}, 'Sort Status', '?sort=status&order=desc');
    }
  }
  if(sort=='name'){
    if(order=='asc'){
      window.history.pushState({'order':'desc'}, 'Sort Name', '?sort=name&order=asc')
    }
    else{
      window.history.pushState({'order':'asc'}, 'Sort Name', '?sort=name&order=desc');
    }
  }
  if(sort=='position'){
    if(order=='asc'){
      window.history.pushState({'order':'desc'}, 'Sort Position', '?sort=position&order=asc')
    }
    else{
      window.history.pushState({'order':'asc'}, 'Sort Position', '?sort=position&order=desc');
    }
  }