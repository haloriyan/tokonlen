class ImageDisplayer {
    constructor(props) {
        this.selector       = props.selector
        this.imageDirectory = props.imageDirectory

        this.init()
        this.klik("#close", () => {
            this.hide(".wrapperImageDisplayer")
        })
        document.addEventListener("keydown", function(e) {
            if(e.key == "Escape") {
                ImgDsplyr.hide(".wrapperImageDisplayer")
            }
        })
    }
    getFileName(names) {
        let name = names.split("/")
        return name[name.length - 1]
    }
    init() {
        // get all images
        let images = document.querySelectorAll(this.selector + " img")
        images.forEach(res => {
            // set onclick
            res.setAttribute('onclick', 'ImgDsplyr.viewImage(this)')
        })
    }
    viewImage(that) {
        let src = that.getAttribute('src')
        let fileName = this.getFileName(src)
        this.show(".wrapperImageDisplayer")
        this.setName(fileName)
        this.setSrc(src)
    }
    setName(name) {
        this.select("#fileName").innerHTML = name
    }
    setSrc(src) {
        this.select("#displayedImage").setAttribute('src', src)
    }

    // core
    select(selector) {
        return document.querySelector(selector)
    }
    magicElement(properties) {
        let dom = document.createElement(properties.type)
        properties.attr.forEach(res => {
            // console.log(Object.keys(res))
            let key = Object.keys(res)
            let val = Object.values(res)
            dom.setAttribute(key, val)
        })
        if(properties.html !== undefined) {
            dom.innerHTML = properties.html
        }
        this.select(properties.parent).appendChild(dom)
    }
    show(selector) {
        this.select(selector).classList.add('class', 'show')
    }
    hide(selector) {
        this.select(selector).classList.remove('show')
    }
    klik(selector, callback) {
        this.select(selector).addEventListener("click", callback)
    }
}