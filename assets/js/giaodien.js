$( window ).load(function() {
    render_size();
    var url = window.location.href;
    $('.menu-item  a[href="' + url + '"]').parent().addClass('active');
});

$( window ).resize(function() {
    render_size();
});

function render_size(){
    if(window.innerWidth<768){
        var nav_height=$('.nav').height();
        $('#main-1').css('padding-top',nav_height);
    }
    /*var block_item=$('.item-flow').width();
     $('.item-flow').height(1.2*parseInt(block_item));*/
    var img_width = $('.item-flow img').width();
    $('.item-flow img').height(1.1*parseInt(img_width));
    var img_km = $('.item-spkm-img img').width();
    $('.item-spkm-img img').height(1.01*parseInt(img_km));
    var img_side = $('.flex-control-thumbs img').width();
    $('.flex-control-thumbs img').height(0.67*parseInt(img_side))
}
function change_cate(id)
{
    $('#cate_id').attr('value',id);
}