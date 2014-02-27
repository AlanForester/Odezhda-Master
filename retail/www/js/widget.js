var LapanaWidget = {

    baseURL: '/widget/',    //'http://lapana.ru/widget/',

    init: function (params) {

        if(params.id != undefined) {
            this.load('main', 'LapanaWidget.initCallback');

        } else {
            alert('Идентификатор контейнера для загрузки виджета Lapana не указан');
        }

    },

    initCallback: function (response) {
        //alert(response.html);
        var div = document.createElement("div");
        div.className = 'lapana-widget';
        div.innerHTML = response.html;
        document.body.appendChild(div);
    },

    slideUp: function () {

    },

    slideDown: function () {

    },

    addToCart: function (id) {

    },

    load: function (action, callback) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        document.body.appendChild(script);
        script.loaded = 0;
        /*script.onload = script.onerror = function() {
            LapanaWidget.checkLoaded(this);
        };
        script.onreadystatechange = function () {
            if (this.readyState == 'complete' || this.readyState == 'loaded') {
                setTimeout(LapanaWidget.checkLoaded(this), 100);
            }
        };*/
        script.src = this.baseURL + action + '/?callback=' + callback;
    },

    checkLoaded: function (element) {
        return (element.loaded == 1);
    },

    setLoaded: function (element) {
        element.loaded = 1;
    }
};