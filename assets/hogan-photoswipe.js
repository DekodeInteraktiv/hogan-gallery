!function(t){function e(i){if(n[i])return n[i].exports;var r=n[i]={i:i,l:!1,exports:{}};return t[i].call(r.exports,r,r.exports,e),r.l=!0,r.exports}var n={};e.m=t,e.c=n,e.d=function(t,n,i){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:i})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=0)}([function(t,e){function n(){return n=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(t[i]=n[i])}return t},n.apply(this,arguments)}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function r(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function o(t,e,n){return e&&r(t.prototype,e),n&&r(t,n),t}var a=window,u=a.PhotoSwipe,l=a.PhotoSwipeUI_Default,s=function(){function t(e){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};i(this,t),this.config=n,this.gallery=e,this.uid=this.gallery.getAttribute("data-pswp-uid"),this.items=this.getItems(),this.handleClick=this.handleClick.bind(this),this.getThumbBoundsFn=this.getThumbBoundsFn.bind(this),e.addEventListener("click",this.handleClick)}return o(t,[{key:"getItems",value:function(){for(var t=this.gallery.querySelectorAll(".hogan-gallery-cell"),e=[],n=0;n<t.length;n++){var i=t[n].querySelector(".hogan-gallery-item-link"),r=t[n].getAttribute("data-pswp-size").split("x"),o=t[n].querySelector(".hogan-gallery-caption"),a={src:i.getAttribute("href"),w:parseInt(r[0],10),h:parseInt(r[1],10)};o&&(a.title=o.textContent),a.el=t[n],e.push(a)}return e}},{key:"getClosest",value:function(t,e){return t&&(e(t)?t:this.getClosest(t.parentNode,e))}},{key:"handleClick",value:function(t){t=t||window.event;var e=t.target,n=this.getClosest(e,function(t){return t.tagName&&"A"===t.tagName.toUpperCase()});if(n){var i=this.getClosest(n,function(t){return t.tagName&&"FIGURE"===t.tagName.toUpperCase()});if(i){t.preventDefault();var r=parseInt(i.getAttribute("data-pswp-index"),10);this.open(r)}}}},{key:"getThumbBoundsFn",value:function(t){var e=this.items[t].el.getElementsByTagName("img")[0],n=window.pageYOffset||document.documentElement.scrollTop,i=e.getBoundingClientRect();return{x:i.left,y:i.top+n,w:i.width}}},{key:"open",value:function(t){var e=document.querySelector(".pswp"),i=n({},this.config,{galleryUID:this.uid,index:t});0!==i.showAnimationDuration&&(i.getThumbBoundsFn=this.getThumbBoundsFn),new u(e,l,this.items,i).init()}}]),t}();window.hogan=window.hogan||{},window.hogan.PhotoSwipe=s}]);