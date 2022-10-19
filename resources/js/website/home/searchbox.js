import ReactDom from 'react-dom';
import {useState, useEffect} from "react";
import axios from "axios";

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

function slugUrl(inputSlug) {
    let slug = inputSlug.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    console.log(slug);
    return slug;
}

let SearchBox = (props) => {

    let [loading, setLoading] = useState(false);
    let [keyword, setKeyword] = useState(null);
    let [results, setResults] = useState([]);

    let handleEnterButton = (event) => {
        if (event.key === 'Enter') {
            window.location.href = "/" + slugUrl(event.target.value);
        }
    };

    let postSubmit = (path, params, method = 'post') => {
        const form = document.createElement('form');
        form.method = method;
        form.action = path;
        for (const key in params) {
            if (params.hasOwnProperty(key)) {
                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = key;
                hiddenField.value = params[key];

                form.appendChild(hiddenField);
            }
        }
        document.body.appendChild(form);
        form.submit();
    };

    let handleSearchButton = () => {
        let searchbox_input = document.querySelectorAll("#searchboxContainer > input")[0].value;
        if (searchbox_input != "" && searchbox_input.length > 0) {
            window.location.href = "/" + slugUrl(searchbox_input);
        }
        // postSubmit1('/searchkw', {searchkw: searchbox_input});;
    };


    useEffect(() => {
            if (keyword != null && keyword.length > 0) {
                setLoading(true);
                axios.post('/searchkw', {
                    kw: keyword,
                })
                    .then(function (response) {
                        if (response.status === 200) {
                            setResults(response.data);
                        }
                        setLoading(false);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        [keyword]);

    useEffect(() => {

    }, [results]);

    return (<>
        <input className="w-[310px] h-[36px] bg-[#F1F3F4] px-[20px] rounded-[9999px]" type="text" name="" placeholder="Nhập từ khóa tìm kiếm ..." onKeyDown={handleEnterButton}/>
        <button type="submit" className="w-[24px] h-[24px] bg-[url('../images/icon-search.svg')] absolute top-[6px] right-[20px]" onClick={handleSearchButton}></button>
    </>)
};

let SearchBoxContainer = document.getElementById("searchboxContainer") != null ? ReactDom.render(<SearchBox/>, document.getElementById("searchboxContainer")) : "";


