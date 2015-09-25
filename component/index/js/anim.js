function animation() {
    
}

animation.prototype = {
    init:function() {
        var handle;
        
        window.onwheel = function(e) {
            var target = e.target;

            var find_animation = target.className.indexOf('animation');
            if(!find_animation) return false;
            
            if(find_animation -1) {
//                var find = animation.prototype.recursive_find(target);
            }
           
        };
    },
    
    recursive_find:function(obj) {
        var childs = obj.childNodes;
        if(!childs) return;
        
        for(var i in childs) {
            if(typeof(childs[i]) === "object") {
                var secret = childs[i].className;
                if(childs[i].className !== "undefined") {
                    console.log(secret.indexOf('animation'));
                } 
                
                this.recursive_find(childs[i]);
  
            } else {
                return;
            }
        }
    },
    
    window_opacity:function(obj) {
        
    }
};
    
window.onload = function(e) {
   var anim = new animation();
       anim.init();
};
