const canvas = document.querySelector("canvas");

const context = canvas.getContext("2d");

// context.beginPath()
// context.rect(50,50, 100, 100)
// context.fillStyle = 'green'
// context.fill()
// context.strokeStyle = 'red'
// context.stroke()
// context.closePath()

// context.beginPath()
// context.rect(100,100, 100, 100)
// context.fillStyle = 'red'
// context.fill()
// context.strokeStyle = 'blue'
// context.stroke()
// context.closePath()

// // Path
// context.beginPath()
// context.moveTo(300,300)
// context.lineTo(400,300)
// context.lineTo(500,350)
// context.lineTo(500,200)
// context.lineTo(400,250)
// context.lineTo(300,250)
// context.stroke()
// context.closePath()

// // Arc
// context.beginPath()
// context.arc(500, 100, 50, 0, Math.PI * 2)
// context.fillStyle = 'green'
// context.fill()
// context.closePath()

// // Text
// context.font = "32px Arial"
// context.fillText('lorem ipsum', 100,300)

let x = 200;
let y = 200;
let dx = 5;
let dy = 5;
let r = 20;

function drawBg() {
  context.beginPath();
  context.fillStyle = "#cccc";
  context.fillRect(0, 0, canvas.width, canvas.height);
  context.fill();
  context.closePath();
}

function drawCircle() {
  context.beginPath();
  context.fillStyle = "red";
  context.arc(x, y, r, 0, Math.PI * 2);
  context.fill();
  context.closePath();
}

let player = {
  x: 100,
  y: canvas.height - 100,
  width: 200,
  height: 20,
  background: "blue",
};

let enemies = [
  {
    x: 50,
    y: 100,
    width: 100,
    height: 20,
    background: "yellow",
    broken:false
  },
  {
    x: 170,
    y: 100,
    width: 100,
    height: 20,
    background: "yellow",
    broken:false
  },
  {
    x: 290,
    y: 100,
    width: 100,
    height: 20,
    background: "yellow",
    broken:false
  },
  {
    x: 410,
    y: 100,
    width: 100,
    height: 20,
    background: "yellow",
    broken:false
  },
  {
    x: 530,
    y: 100,
    width: 100,
    height: 20,
    background: "yellow",
    broken:false
  },
  {
    x: 650,
    y: 100,
    width: 100,
    height: 20,
    background: "yellow",
    broken:false
  },
];

function drawEnemy(){
  enemies.forEach(enemy => {
    if(enemy.broken) return
    context.beginPath()
    context.rect(enemy.x,enemy.y, enemy.width,enemy.height)
    context.fillStyle = "grey"
    context.fill()
    context.closePath()
  });
}

function drawPlayer() {
  context.beginPath();
  (context.fillStyle = player.background),
    context.rect(player.x, player.y, player.width, player.height);
  context.fill();
  context.closePath();
}

let score = 0 
function drawScore(){
  context.fillStyle = "black"
  context.font = "32px Arial"
  context.fillText(score, canvas.width/2, 200)
}

let interval = setInterval(() => {
  context.clearRect(0, 0, canvas.width, canvas.height);
  x += dx;
  y += dy;

  drawBg();
  drawCircle();
  drawPlayer();
  drawEnemy();
  drawScore();
  // Mantulkan bola
  if (y + r > canvas.height) dy *= -1;
  if (x + r > canvas.width) dx *= -1;
  if (x - r < 0) dx *= -1;
  if (y - r < 0) dy *= -1;

  // Bola mengenai user
  if (
    y + r > player.y &&
    x + r > player.x &&
    x - r < player.x + player.width &&
    y - r < player.y + player.height
  ) {
    dy *= -1;
  }

  // Bola Mengenai enemy
  enemies.forEach(enemy => {
    if (
      y + r > enemy.y &&
      x + r > enemy.x &&
      x - r < enemy.x + enemy.width &&
      y - r < enemy.y + enemy.height && !enemy.broken
    ) {
      dy *= -1;
      score += 1
      enemy.broken = true
    }

    if(score == enemies.length){
      clearInterval(interval)
      alert("You win")
      window.location.reload()
    }

    if (y + r > canvas.height){
      clearInterval(interval)
      alert("You Lose")
            window.location.reload()

    }


  });
}, 10);

window.addEventListener("keydown", (e) => {
  if (e.key == "a" || e.key == "ArrowLeft") {
    if (player.x < 0) return;
    player.x -= 20;
  } else if (e.key == "d" || e.key == "ArrowRight") {
    if (player.x + player.width > canvas.width) return;
    player.x += 20;
  } else if (e.key == "Escape") alert("Paused");
});
