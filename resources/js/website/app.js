require('./boot');
require('./slick');
require('./home/searchbox');
require('./../plugins/sweetalert2.min');

window.mobileAndTabletCheck = function() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};
if(mobileAndTabletCheck() == false){
    console.log('required pc yt');
    require('./home/youtube_home');

}
import Swal from 'sweetalert2';
var lozad = require('lozad')

$(document).ready(function () {
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
    $(window).on("load", function (e) {
        console.log('đã load xong!');
        setTimeout(()=>{
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "https://widgets.coingecko.com/coingecko-coin-price-marquee-widget.js";
            $("head").append(s);
            console.log('load coingecko');
        },3000);



        $(".menu-2 .sub-menu").parent("li").append("<span class='show-menu'></span>");
        $('.menu-2 li .show-menu').on('click', function () {
            $(this).parent().toggleClass('active');
        });
        $('.dropdown-toggle').on('click', function () {
            $(this).toggleClass('active');
            $('.dropdown-mobile').toggleClass('active');
        });

        $('.table-content > li > a').on('click',function(){
            $('.table-content > li').removeClass('active');
            $(this).parent().addClass('active');
        });
        $(".menu-2 .sub-menu").parent("li").append("<span class='show-menu'></span>");

        $('.menu-2 li .show-menu').on('click',function(){
            $(this).parent().toggleClass('active');
        });
        $('.dropdown-toggle').on('click',function(){
            $(this).toggleClass('active');
            $('.dropdown-mobile').toggleClass('active');
        });

    });

    $('.slider-investment').slick({
        centerMode: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        rows: 2,
        infinite: false,
        centerPadding: 0,
        autoplay: false,
        dots: true,
        arrows: false,
    });
    $('.slider-video').slick({
        centerMode: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        centerPadding: 0,
        autoplay: false,
        dots: true,
        arrows: false,
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form-newsletter').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: urlAjaxHandler + "/api/newsletter",
            data: { privacy :true ,email : $("#email_subcribe").val()  },
            dataType: 'json',
            success: function (response) {
;
                let msgHtml = '';
                if (response.status == 'OK') {
                    msgHtml += response.msg;
                } else {
                    $.each(response.errors, function (_key, value) {
                        msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
                    });
                }
                Swal.fire({
                    title: "Newsletter",
                    html: msgHtml,
                })

            },
            error: function ({responseJSON}) {
                console.log(responseJSON, responseJSON.errors);
                let msgHtml = '';
                $.each(responseJSON.errors, function (_key, value) {
                    msgHtml += '<h4>' + value[0] + '</h4>'; //showing only the first error.
                });

                Swal.fire({
                    title: "Newsletter",
                    html: msgHtml
                })
            }
        });
    });

    $(".nav-item").on("click",function(e){
        e.preventDefault();
        $(".nav-link").removeClass("active");
        $(this).find(".nav-link").addClass("active");
        let idOfTab = $(this).find(".nav-link").attr("id").replace("-tab","");
        $(".tab-pane").removeClass("active");
        $(`#${idOfTab}`).addClass("active");
    });


});



