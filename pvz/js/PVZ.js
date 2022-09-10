const backgroundImage = new Image();
backgroundImage.src = "../Sprites/General/Background.jpg";

import Plant from "./Plant.js";
import Sun from "./Sun.js";
import Zombie from "./Zombie.js";

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
  zombies = [];
  mowers = [];
  blocks = [];
  status = 'playing' // paused / gameover

  constructor(canvas) {
    /** @type {HTMLCanvasElement} */
    this.canvas = canvas;

    /** @type {CanvasRenderingContext2D} */
    this.ctx = canvas.getContext("2d");

    this.startTimer();
    this.createBlocks();
    this.createZombies();
    this.createSun();

    this.eventListener()

  }
  createSun() {
    setInterval(() => {
    if(this.status == 'paused') return;

      const random = (min, max) => Math.random() * (max - min) + min;
      this.suns.push(new Sun(random(50, this.canvas.width - 50)));
      console.log("sun created");
    }, 3000);
  }
  createZombies() {
    setInterval(() => {
    if(this.status == 'paused') return;

      let createdZombie = new Zombie();
      this.zombies.push(createdZombie);
    }, 5000);
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

        const block = {
          x,
          y,
          w,
          h,
          plant: new Plant("PeaShooter", x, y),
        };
        this.blocks.push(block);

        if (block.plant.name == "PeaShooter" || block.plant.name == "IcePea") {
          setInterval(() => {
            let newPea = block.plant.shoot();
            this.peas.push(newPea);
          }, 4000);
        }
      }
    }
  }
  startTimer() {
    setInterval(() => {
    if(this.status == 'paused') return;

      this.time++;
    }, 1000);
  }

  // Draw
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
    this.drawPeas();
    this.drawZombies();
    this.drawSun();
  }

  drawSun() {
    // Draw
    this.ctx.fillStyle = "black";
    this.ctx.font = "bold 24px Arial";
    this.ctx.fillText(this.sun, 135, 90);

    // Draw sun drop

    this.suns.forEach((sun) => {
      sun.draw(this.ctx);
      sun.update();
    });
  }
  drawZombies() {
    this.zombies.forEach((zombie) => {
      zombie.draw(this.ctx);
      zombie.update();
    });
  }

  drawPeas() {
    this.peas.forEach((pea) => {
      pea.draw(this.ctx);
      pea.update();
    });
  }

  drawBlocks() {
    this.blocks.forEach((block) => {
      // this.ctx.strokeRect(block.x, block.y, block.w, block.h);
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
    this.x += 2;
    this.checkZombieHit();
    this.checkPea();
  }
  checkPea() {
    this.peas.forEach((pea, peaIndex) => {
      if (pea.x > this.canvas.width) this.peas.splice(peaIndex, 1);
    });
  }

  checkZombieHit() {
    this.zombies.forEach((zombie, zombieIndex) => {
      this.peas.forEach((pea, peaIndex) => {
        if (
          pea.x + pea.w > zombie.x &&
          pea.y > zombie.y &&
          pea.y < zombie.y + zombie.h
        ) {
          this.peas.splice(peaIndex, 1);

          let isDie = zombie.hit(pea.isIce);

          if (isDie) {
            this.zombies.splice(zombieIndex, 1);

            console.log("zombie die");
          }
        }
      });
    });
  }




  render() {
    if(this.status != 'paused'){
      this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
      this.draw();
      this.update();
    }
    requestAnimationFrame(() => this.render());
  }



  eventListener(){
    document.addEventListener('click',e=>{
      let rect = this.canvas.getBoundingClientRect()
      let clickLocation ={
        x : e.clientX - rect.x,
        y : e.clientY - rect.y
      }

      this.suns.forEach((sun,sunIndex)=>{
        if(clickLocation.x> sun.x && clickLocation.x < sun.x + sun.w && clickLocation.y > sun.y && clickLocation.y < sun.y + sun.h){
          console.log('sun is clicked');
          this.sun += 25

          this.suns.splice(sunIndex, 1)
        }
      })
    })

    document.addEventListener('keydown', e=>{
      if(e.key == 'Escape'){
        let pauePopUp = document.getElementById('pause-popup')
        pauePopUp.classList.toggle('hidden')
        if (this.status == 'paused') {
          this.status = 'playing'
        }else if (this.status == 'playing'){
          this.status = 'paused'
        }
      }
    })
  }
}

