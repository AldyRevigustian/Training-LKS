    const backgroundImage = new Image();
    backgroundImage.src = "../Sprites/General/Background.jpg";

    import Plant from "./Plant.js";

    export default class PVZ {
    sun = 50;
    seeds = [];
    name;
    score = 0;
    time = 0;
    isHoldingSeed = false;
    holdingSeed = null; //Seed yang sedang di hold
    isHoldingShovel = false;
    leaderboard = [];
    plants = [];
    peas = [];
    suns = [];
    zombie = [];
    mowers = [];
    blocks = [];

    constructor(canvas) {
        /** @type {HTMLCanvasElement} */
        this.canvas = canvas;

        /** @type {CanvasRenderingContext2D} */
        this.ctx = canvas.getContext("2d");

        this.startTimer();
        this.createBlocks();
    }

    createBlocks() {
        let w = 82;
        let h = 90;
        let row = 5;
        let column = 8;

        for (let i = 0; i < row; i++) {
        for (let j = 0; j < column; j++) {
            let x = j * w + 90;
            let y = i * h + 120;
            // this.blocks.push({
            //     x,
            //     y ,
            //     w,
            //     h,
            //     plant: new Plant('PeaShooter', x, y)
            // })
            const block = {
            x,
            y,
            w,
            h,
            plant: new Plant('PeaShooter', x ,y)
            };
            this.blocks.push(block)

            if(block.plant.name == 'PeaShooter' || block.plant.name == 'IcePea'){
                setInterval(() => {
                    let newPea = block.plant.shoot()
                    this.peas.push(newPea)
                }, 3000);
            }
        }
        }
    }

    startTimer() {
        setInterval(() => {
        this.time++;
        }, 1000);
    }

    draw() {
        this.ctx.drawImage(
        backgroundImage,
        0,
        0,
        this.canvas.width,
        this.canvas.height
        );
        this.drawStats();
        this.drawBlocks();
        this.drawPeas()
    }

    drawPeas(){
        this.peas.forEach(pea => {
            pea.draw(this.ctx)
            pea.update()
        })
    }

    drawBlocks() {
        this.blocks.forEach((block) => {
        this.ctx.strokeRect(block.x, block.y, block.w, block.h);
        block.plant.draw(this.ctx);
        });
    }

    drawStats() {
        this.ctx.fillStyle = "white";
        this.ctx.font = "16px Arial";

        const formatTimer = () => {
        let minute = Math.floor(this.time / 60)
            .toString()
            .padStart(2, "0");
        let second = (this.time % 60).toString().padStart(2, "0");
        return `${minute}:${second}`;
        };

        this.ctx.fillText("Player Name: " + this.name, 440, 35);
        this.ctx.fillText("Score: " + this.score, 440, 55);
        this.ctx.fillText("Time: " + formatTimer(), 440, 75);
    }

    update() {
        this.x++;
    }

    render() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.draw();
        this.update();
        requestAnimationFrame(() => this.render());
    }
    }
