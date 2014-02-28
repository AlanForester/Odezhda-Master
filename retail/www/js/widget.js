var LapanaWidget = {

    baseURL: '/widget/',    //'http://lapana.ru/widget/',

    init: function (params) {
        this.load('index', 'LapanaWidget.initCallback');

        /*if(params.id != undefined) {

        } else {
            alert('Идентификатор контейнера для загрузки виджета Lapana не указан');
        }*/

    },

    initCallback: function (response) {
        this.registerStyle();
        this.addWidget(response.html);
    },

    addWidget: function (html) {
        var div = document.createElement("div");
        div.className = 'lapana-widget';
        div.innerHTML = html;
        document.body.appendChild(div);
    },

    registerStyle: function () {
        var headID = document.getElementsByTagName('head')[0];
        var cssNode = document.createElement('link');
        cssNode.type = 'text/css';
        cssNode.rel = 'stylesheet';
        cssNode.href = this.baseURL + 'css/widget.css';
        cssNode.media = 'screen';
        headID.appendChild(cssNode);
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
    },

    bind: function (element, eventName, fn) {
        if (document.getElementById && document.getElementsByTagName) {
            if (window.addEventListener) element.addEventListener(eventName, fn, false);
            else if (window.attachEvent) element.attachEvent('on'+eventName, fn);
        }
    }

};