window.onload = function () {
    var thumbnails = document.getElementById("thumbnails");
    var imgs = thumbnails.getElementsByTagName("img");
    var featured = document.getElementById("featured");
    var showedimg = featured.getElementsByTagName("img");
    var fig = featured.getElementsByTagName("figcaption");
    var imgsrc =
        [
            "images/medium/5855774224.jpg",
            "images/medium/5856697109.jpg",
            "images/medium/6119130918.jpg",
            "images/medium/8711645510.jpg",
            "images/medium/9504449928.jpg"
        ]
    var titles = new Array(5);

    for (i = 0; i < imgsrc.length; i++) {
        titles[i] = imgs[i].title;
    }

    for (i = 0; i < imgsrc.length; i++) {
        let path = imgsrc[i];
        let title = titles[i];
        imgs[i].onclick = function () {
            showedimg[0].src = path;
            showedimg[0].title = title;
            fig[0].innerHTML = title;
        }
    }

    var timer = null;
    var alpha = 100;
    var speed = 0;
    function mouseeve(alp) {
        clearInterval(timer);
        timer = setInterval(function () {
            if (alpha > alp)
                speed = -1;
            else if (alpha < alp) {
                speed = 1;
            }
            if (alpha == alp)
                clearInterval(timer);
            else {
                alpha += speed;
                showedimg[0].style.opacity = alpha / 100;
            }
        }, 50)
    }

    featured.onmouseover = function () {
        mouseeve(80);
    }
    featured.onmouseout = function () {
        mouseeve(100);
    }
}


