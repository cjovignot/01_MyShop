window.onload = () => {

  // FILTER RANGE SCRIPT

  function validateRange(minPrice, maxPrice) {
    minPrice = parseInt(minPrice)
    maxPrice = parseInt(maxPrice)
    if (minPrice > maxPrice) {
      // Swap to Values
      let tempValue = maxPrice;
      maxPrice = minPrice;
      minPrice = tempValue;
    }

    minValue.innerHTML = "$" + minPrice;
    console.log(minPrice);
    maxValue.innerHTML = "$" + maxPrice;
    console.log(maxPrice);
  }

  
  const inputElements = document.querySelectorAll("input");
  
  let minValue = document.getElementById("min-value");
  let maxValue = document.getElementById("max-value");
  let minPrice = parseInt(inputElements[1].value);
  let maxPrice = parseInt(inputElements[2].value);
  console.log("minPrice::html ", minPrice);
  console.log("maxPrice::html ", maxPrice);


  inputElements.forEach((element) => {
    element.addEventListener("change", (e) => {
      let minPrice = parseInt(inputElements[1].value);
      let maxPrice = parseInt(inputElements[2].value);
      console.log("minPrice::html ", minPrice);
      console.log("maxPrice::html ", maxPrice);
      validateRange(parseInt(minPrice), parseInt(maxPrice));
    });
  });

  validateRange(inputElements[1].value, inputElements[2].value);





// FILTER MOBILE DISPLAY SCRIPT
var coll = document.getElementsByClassName("filter_collapse");
var menuItems = document.getElementsByClassName("filter_item_collapse");
console.log(menuItems);
var i;

for (i = 0; i < coll.length; i++) {
  
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    console.log(menuItems);
    
    
  

  

    Array.prototype.forEach.call(menuItems, function(menuItem) {
      // console.log(menuItem);
      if (menuItem.style.display === "block") {
        menuItem.style.display = "none";
      } else {
        menuItem.style.display = "block";
      }
    })

    
  });
}


};
