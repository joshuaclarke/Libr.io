/*Ce code s'inspire d'une ressource de code javascript du site internet tympanus hébergeant des codes réutilisables librement :
"Licensing & Terms of Use

 The resources on Codrops can be used freely in personal and commercial projects.
 Please note, that most of the tutorials and resources are experimental and not ready for production,
 but made for inspiration and demonstration purpose only.

 The resources on Codrops can be used in websites, web apps and web templates intended for sale.
 You don’t have to link back to us if it vitiates your work but we appreciate any credit."
 lien des termes de la licence : https://tympanus.net/codrops/licensing

 lien du code : https://tympanus.net/codrops/2013/04/17/slide-and-push-menus/
 */

( function( window ) {

'use strict';

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

window.classe = {
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,

  has: hasClass,
  remove: removeClass,
  add: addClass,
  toggle: toggleClass
};

})( window );


var menuLeft = document.getElementById( 'menu-s1' ),
    showLeft = document.getElementById( 'showLeft' ),
    body = document.body;

showLeft.onclick = function() {
    classe.toggle( this, 'active' );
    classe.toggle( menuLeft, 'menu-open' );
    disableOther( 'showLeft' );
};

function disableOther( button ) {
    if( button !== 'showLeft' ) {
        classe.toggle( showLeft, 'disabled' );
    }
}