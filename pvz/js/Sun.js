const image = new Image
image.src = '../Sprites/General/Sun.png'
export default class Sun{
    constructor(x){
        this.x = x
        this.y = 100
        this.w = 50
        this.h = 50
    }

    draw(ctx){
        ctx.drawImage(image, this.x, this.y, this.w, this.h)
    }

    update(){
        this.y += 0.5
    }
}