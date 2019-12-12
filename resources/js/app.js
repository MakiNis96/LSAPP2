require('./bootstrap');

$('#fileee').change(function(){
    $in=$(this);
    $in.next().html($in.val());
    alert($in.val());
})

