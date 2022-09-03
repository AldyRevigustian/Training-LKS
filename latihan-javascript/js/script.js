let user = {
  name1 : 'Andy ',
  name2 : 'Andy2',
  name3 : 'Andy3',
  name4 : 'Andy4',

}

let users = [
  {
    name : 'andy'
  },
  {
    name : 'budi'
  }
]

for(let i = 1; i<= 4; i++){
    console.log('Namaku adalah', user['name'+i]);
}

for (let i = 0; i < users.length; i++) {
  let user = users[i];

  console.log(`Usernsme : ${user.name}`);
}

users.forEach(function (user){
  console.log(`Username (foreach) : ${user.name}`);
});


let i = 0;
while (i<users.length) {
  console.log(`Username (while)`, users[i].name);
  i++
}

let item = {
  id:1,
  name:'Meja',
  width:100,
  color:'black'
}

for(let key in item){
  console.log(`key : ${key}, value ; ${item[key]}`);
}

/**
 * 
 * @param {Number} Angka 
 * @returns {Number}
 */
function double(number){
  return number * 2;
}

/**
 * 
 * @param {Number} number 
 * @param {Number} jumlahPangkat 
 * @returns {Number} Hasil 
 */
const pangkat = (number, jumlahPangkat) => { 
  return Math.pow(number,jumlahPangkat) 
}
