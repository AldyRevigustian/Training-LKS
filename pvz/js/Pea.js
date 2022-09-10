const greenPea = new Image
greenPea.src = '../Sprites/General/Pea.png'
const icePea = new Image
icePea.src = '../Sprites/General/IcePea.png'

export default class Pea{
    w = 25
    h = 25
    constructor(x,y,isIce){
        this.x = x
        this.y = y
        this.isIce = isIce
    }

    draw(ctx){
        const peaImage = this.ice === true ? icePea : greenPea
        ctx.drawImage(peaImage, this.x ,this.y, this.w, this.h)
    }

    update(){
        this.x += 0.5
    }
} 