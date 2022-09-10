// // // Object
// // let user = {
// //   name1 : 'Andy ',
// //   name2 : 'Andy2',
// //   name3 : 'Andy3',
// //   name4 : 'Andy4',

// // }

// // // Array
// // let users = [
// //   {
// //     name : 'andy'
// //   },
// //   {
// //     name : 'budi'
// //   }
// // ]

// // for(let i = 1; i<= 4; i++){
// //   console.log('Namaku adalah', user['name'+i]);
// // }

// // // Looping array

// // for (let i = 0; i < users.length; i++) {
// //   let user = users[i];

// //   console.log(`Usernsme : ${user.name}`);
// // }

// // users.forEach(function (user){
// //   console.log(`Username (foreach) : ${user.name}`);
// // });

// // let i = 0;
// // while (i<users.length) {
// //   console.log(`Username (while)`, users[i].name);
// //   i++
// // }

// // // Looping obj
// // let item = {
// //   id:1,
// //   name:'Meja',
// //   width:100,
// //   color:'black',
// //   price:10000,
// //   tax:1000,
// //   getPrice: function (){
// //     return this.price + this.tax
// //   }
// // }

// // for(let key in item){
// //   console.log(`key : ${key}, value ; ${item[key]}`);
// // }

// // // FUnction biasa
// // /**
// //  *
// //  * @param {Number} Angka
// //  * @returns {Number}
// //  */
// // function double(number){
// //   return number * 2;
// // }

// // // Arr funct
// // /**
// //  *
// //  * @param {Number} number
// //  * @param {Number} jumlahPangkat
// //  * @returns {Number} Hasil
// //  */
// // const pangkat = (number, jumlahPangkat) => {
// //   return Math.pow(number,jumlahPangkat)
// // }

// // console.log("Harga item", item.getPrice());

// // Aync Await

// function catat(dataTransaksi) {
//   return new Promise((resolve, reject) => {
//     console.log("Data Sedang Di Catat..");

//     let isUploadSuccess = true;
//     // Setelah 3 detik, jalankn resolve()
//     setTimeout(function () {
//       if (isUploadSuccess == true) {
//         let dataDariApi = {item : "Meja", created_at:'2022'}
//         resolve(dataDariApi);
//       } else {
//         let dataDariApi = {message : 'Error saat mencatat data'}
//         reject(dataDariApi);
//       }
//       resolve();
//     }, 3000);
//   });
// }

// // catat({item : 'Meja'})
// //   .then(() => {
// //     // Untuk resolve
// //     console.log("Meja sukses di catat!");
// //   })
// //   .catch(() => {
// //     // Untuk reject 
// //     console.log("Meja gagal di catat!");
// //   });


// async function prosesaCatat(){
//   console.log('Mulai Mencatat data');
//   try {
//     let dataDariApi = await catat()
//     console.log('sukses mencatat', dataDariApi);
//   } catch (e) {
//     console.log('Gagal mencata data', e);
//   }
// }

// prosesaCatat()


const bike = new Bike({
  id:1,
  brand: "Pacific",
  name: "Road Bike",
  color: "Blue ",
  price: 1000000,
})

let name = bike.getNameAndBrand()

console.log('Brand and name : ', name);
console.log('Bike yang dibuat', bike);