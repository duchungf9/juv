import ReactDom from 'react-dom';
import {useState, useEffect} from "react";

let SingleVideo = (props) => {
    let opa_value = props.isActive == true ? 1 : 0.5;
    let [opa, setOpa] = useState(opa_value);

    let changeOpa = () =>{
        props.setActiveVideo(props.video);
    }

    return (/*<li className="flex p-3 cursor-pointer hover:bg-slate-500 single-video" style={{opacity : opa_value}} onClick={()=>{changeOpa()}} >
            <a className="flex-initial w-48"><img className="object-cover w-full h-full" src={"https://img.youtube.com/vi/"+props.video.video+"/0.jpg"} alt=""/></a>
            <div className="flex-auto">
                <h4 className="block w-full pl-2 text-orange-500">{props.video.title}</h4>
                <div className="pl-2 text-sm text-gray-50"><Moment format="DD-MM-YYYY">{props.video.created_at}</Moment></div>
            </div>
        </li>*/
        <li className="relative flex py-[17px] hover:bg-slate-500 cursor-pointer border-solid border-t-[1px] border-b-[1px] border-t-[#000] border-b-[#393c3f]" style={{opacity : opa_value}}  onClick={()=>{changeOpa()}}>
            <a className="w-[40%]"><img className="w-full h-[85px] object-cover" src={"https://img.youtube.com/vi/"+props.video.video+"/0.jpg"} alt=""/></a>
            <div className="w-[60%]">
                <h4 className="block w-full pl-[6px] text-md leading-[23px] text-[#fff] font-bold mb-[6px]">{props.video.title}</h4>
                <div className="text-xs text-[#999] leading-[14px] pl-[6px]">{props.video.alt}</div>
            </div>
        </li>
        )
};

let TheIframe = (props) => {
    let [click,setClick] = useState(false);

    const PlayEvent = () => {
        setClick(true);
    }
    let _html  = ``;
    if(click == false){
        _html = <div className="youtube" data-embed="AqcjdkPMPJA" style={{position : "relative"}}>
                    <a className="w-[40%]"><img className="w-full h-[85px] object-cover" style={{height:'540px'}} src={"https://img.youtube.com/vi/"+props.video+"/0.jpg"} alt=""/></a>
                    <div className="play" style={{position : "absolute" , top : "36%", left : '41%' }} onClick={PlayEvent}>
                    </div>
                </div>
    }else{
        _html = <iframe className="w-full min-h-[254px] lg:h-[540px] object-cover" width="auto" height="auto" src={ props.src+ "?rel=0&showinfo=0&autoplay=1"} frameBorder="0"/>
    }

    return _html;


}

let YtHome = (props) => {

    const videos_data = JSON.parse(document.getElementById("data_videos").getAttribute("data-videos"));
    let [videos, setVideos] = useState(videos_data);
    let [activeVideo, setActiveVideo] = useState(videos_data[0]);
    useEffect(()=>{
        // console.log(activeVideo);
    },[activeVideo])

    return (
        <>
            <div className="flex-initial w-full lg:w-2/3">
                {  activeVideo == null ? "" : <TheIframe src={"https://www.youtube.com/embed/" + activeVideo.video} video={activeVideo.video} />}
            </div>
            <ul className="flex-initial list-video px-[17px] w-1/3 block list-none bg-[#202124] rounded-[4px] h-[540px] overflow-auto">
                {
                    Object.keys(videos_data).map(key=>{
                        let video = videos_data[key];
                        let is_active = video.video == activeVideo.video ? true : false;


                        return (<SingleVideo video={video} setActiveVideo={setActiveVideo} isActive={is_active}/>)
                    })
                }
            </ul>
        </>
    )
};
try {
    if(document.getElementById("videos_container") != null){
        window.mobileAndTabletCheck = function() {
            let check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        setTimeout(()=>{
            if(mobileAndTabletCheck() == false){
                let YoubuteHome = ReactDom.render(<YtHome/>, document.getElementById("videos_container"));
            }
            console.log(mobileAndTabletCheck());

        },3000);

    }

} catch (error) {

}
