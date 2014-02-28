var LapanaWidget = {

    baseURL: '/',    //'http://lapana.ru/',

    init: function (params) {
        this.load('widget/index', 'LapanaWidget.initCallback');

        /*if(params.id != undefined) {

        } else {
            alert('Идентификатор контейнера для загрузки виджета Lapana не указан');
        }*/

    },

    initCallback: function (response) {
        this.registerCSS();
        this.addWidget(response.html);
        this.bind(
            document.getElementById('lapana-trigger'),
            'click',
            this.toggleWidget
        )
    },

    addWidget: function (html) {
        var div = document.createElement("div");
        div.className = 'lapana-widget';
        div.innerHTML = html;
        document.body.appendChild(div);
    },

    registerCSS: function () {
        var headID = document.getElementsByTagName('head')[0];
        var cssNode = document.createElement('link');
        cssNode.type = 'text/css';
        cssNode.rel = 'stylesheet';
        cssNode.href = this.baseURL + 'css/widget.css';
        cssNode.media = 'screen';
        headID.appendChild(cssNode);
    },

    toggleWidget: function () {
        var triggerBottom = LapanaWidget.getPropertyValues(document.getElementById('lapana-trigger'), 'bottom');
        if(triggerBottom == 0)
            LapanaWidget.slideUp();
        else
            LapanaWidget.slideDown();
    },

    slideUp: function () {
        this.slide(
            document.getElementById('lapana-trigger'), {'bottom': 400}, 20, 20, 0.5
        );
        this.slide(
            document.getElementById('lapana-body'), {'height': 400}, 20, 20, 0.5
        );
    },

    slideDown: function () {
        this.slide(
            document.getElementById('lapana-trigger'), {'bottom': 0}, 20, 20, 0.5
        );
        this.slide(
            document.getElementById('lapana-body'), {'height': 0}, 20, 20, 0.5
        );
    },

    slide: function (element, properties, steps, time, powr) {
        if (element.animationInterval)
            window.clearInterval(element.animationInterval);

        var actStep = 0,
            startPositions = this.getPropertyValues(element, properties);

        element.animationInterval = window.setInterval(
            function() {
                for(var propertyName in properties) {
                    position = LapanaWidget.stepPosition(startPositions[propertyName],properties[propertyName],steps,actStep,powr);
                    element.style[propertyName] = position+"px";
                }
                actStep++;
                if (actStep > steps) window.clearInterval(element.animationInterval);
            }
            ,time);
    },

    stepPosition: function (minValue,maxValue,totalSteps,actualStep,powr) {
        var delta = maxValue - minValue;
        var step = minValue+(Math.pow(((1 / totalSteps)*actualStep),powr)*delta);
        return Math.ceil(step);
    },

    getPropertyValues: function (element, properties) {
        switch (typeof properties){
            case "string":
                //одиночный параметр
                var value = element.style[properties],
                    result = value=='' ? 0 : parseInt(value, 10);
                break;

            default:
                //объект: список параметров
                var result = [];
                for(var propertyName in properties) {
                    var value = element.style[propertyName];
                    result[propertyName] = value=='' ? 0 : parseInt(value, 10);
                }
        }
        return result;
    },

    addToCart: function (id) {

    },

    load: function (path, callback) {
        //метод кросс-доменного запроса данных (JSONP)
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
        script.src = this.baseURL + path + '/?callback=' + callback;
    },

    checkLoaded: function (element) {
        return (element.loaded == 1);
    },

    setLoaded: function (element) {
        element.loaded = 1;
    },

    bind: function (element, eventName, fn) {
        if (window.addEventListener) element.addEventListener(eventName, fn, false);
        else if (window.attachEvent) element.attachEvent('on'+eventName, fn);
    },

    unbind: function (element, eventName, fn) {
        if (window.removeEventListener) element.removeEventListener(eventName, fn, false);
        else if (window.detachEvent) element.detachEvent('on'+eventName, fn);
    }

};