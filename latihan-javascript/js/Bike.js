/**
 * Sepeda
 * @param {}
 */
class Bike {
  id
  name
  brand
  color
  price
  
  constructor(bikeData){
    this.id = bikeData.id
    this.name = bikeData.name
    this.brand = bikeData.brand
    this.color = bikeData.color
    this.price = bikeData.price
  }


  getNameAndBrand(){
    return `${this.name} - ${this.brand}`
  }



}