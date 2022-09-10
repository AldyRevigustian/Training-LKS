let columns = document.querySelectorAll(".column");

console.log(columns);

let check = "X";

const checkWin = () =>{
  let winCondition = [
    [0,1,2],
    [3,4,5],
    [6,7,8],
    [0,3,6],
    [1,4,7],
    [2,5,8],
    [0,4,8],
    [2,4,6],
  ]

  let winner = "";

  winCondition.forEach(condition => {
    let columnOne = columns[condition[0]].innerHTML;
    let columnTwo = columns[condition[1]].innerHTML;
    let columnThree = columns[condition[2]].innerHTML;

    if(columnOne == '' || columnTwo == '' || columnThree == "") return 

    if(columnOne == columnTwo && columnTwo == columnThree){
      winner = columnOne
      alert(`WINNER : ${winner}`)
      return true
    }

  }); 

  return winner
}

const clickColumn = (columnNumber) => {
  let clickedColumn = columns[columnNumber];

  if (clickedColumn.classList.contains("checked")) {
    return;
  } else {
    clickedColumn.classList.add("checked");
  }

  clickedColumn.innerHTML = check;

  // Proses algoritma tic tac toe
  if (check == "X") {
    check = "O";
  } else if (check == "O") {
    check = "X";
  }

  // Check Menang atau kalah
  let win = checkWin();

  console.log(win);

};

columns.forEach((column, index) => {
  // Dapet masing2 div

  column.addEventListener("click", () => {
    console.log(`Column ${index + 1} Clicked`);
    clickColumn(index);
  });
});
