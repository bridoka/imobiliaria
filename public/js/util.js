$.fn.numeric = function () {
    this.on('keypress', function(e) {
        var key = (window.event)?event.keyCode:e.which;
        if((key > 47 && key < 58)) {
            return true;
        } else {
            return (key == 8 || key == 0)?true:false;
        }
    });
}