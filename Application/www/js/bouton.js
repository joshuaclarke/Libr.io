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
