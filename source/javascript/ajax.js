function ajax(obj) {
    var xhr = createXHR();
    obj.url = obj.url + '?rand' + Math.random();
    obj.data = params(obj.data);
    if (obj.method === 'get') obj.url += obj.url.indexOf('?') == -1 ? '?' + obj.data : '&' + obj.data;
    if (obj.async === true) {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                callback();
            }
        };
    }
    xhr.open(obj.method, obj.url, obj.async);
    if (obj.method === 'post') {
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(obj.data);
    } else {
        xhr.send();
    }
    if (obj.async === false) callback();

    function callback() {
        if (xhr.status === 200) {
            obj.success(xhr.responseText);
        } else {
            console.log('[ajax error]获取错误！错误码：' + xhr.status + ';错误信息：' + xhr.statusText);
        }
    }
}
function createXHR() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function params(data) {
    var arr = [];
    for (var i in data) {
        arr.push(i + '=' + data[i]);
    }
    return arr.join('&');
}
    //example

    // ajax({
    //     method: 'post',
    //     url: './server.php',
    //     data: {
    //         'name': 'Lee',
    //         'age': 100
    //     },
    //     success: function(text) {
    //         var array = JSON.parse(text);
    //         div.innerHTML = text;
    //         alert(array);
    //     },
    //     async: false
    // });








function isJSON (str, pass_object) {
    if (pass_object && isObject(str)) return true;

    if (typeof(str)!='string') return false;

    str = str.replace(/\s/g, '').replace(/\n|\r/, '');

    if (/^\{(.*?)\}$/.test(str))
    return /"(.*?)":(.*?)/g.test(str);

    if (/^\[(.*?)\]$/.test(str)) {
        return str.replace(/^\[/, '')
        .replace(/\]$/, '')
        .replace(/},{/g, '}\n{')
        .split(/\n/)
        .map(function (s) { return isJSON(s); })
        .reduce(function (prev, curr) { return !!curr; });
    }

    return false;
}