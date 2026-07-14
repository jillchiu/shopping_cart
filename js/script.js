document.getElementById("closeCart").addEventListener("click", function () {
  var products2Div = document.querySelector(".products2");
  products2Div.style.maxHeight = "0px";
  products2Div.style.opacity = "0";
  setTimeout(function () {
    products2Div.style.display = "none";
  }, 2000);
});

document.getElementById("openCart").addEventListener("click", function (event) {
  event.preventDefault();
  var products2Div = document.querySelector(".products2");
  products2Div.style.display = "block";
  products2Div.style.maxHeight = "400px";
  products2Div.style.opacity = "1";
});

document.querySelectorAll(".increaseButton").forEach(function (button) {
  button.addEventListener("click", function () {
    var increase_quantity = this.getAttribute("value");
    fetch("index.php", {
      method: "POST",
      body: increase_quantity,
      headers: {
        "Content-type": "application/x-www-form-urlencoded",
      },
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
        location.reload();
      });
  });
});

document.querySelectorAll(".decreaseButton").forEach(function (button) {
  button.addEventListener("click", function () {
    var decrease_quantity = this.getAttribute("value");
    fetch("index.php", {
      method: "POST",
      body: decrease_quantity,
      headers: {
        "Content-type": "application/x-www-form-urlencoded",
      },
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
        location.reload();
      });
  });
});

document.querySelectorAll(".image_overlay").forEach(function (button) {
  button.addEventListener("mouseover", function () {
    var add_to_cart_button = document.getElementById(
      "add_to_cart_" + this.getAttribute("value")
    );

    var layout = document.getElementById(this.getAttribute("id"));

    var word = document.getElementById(
      "stats-container_" + this.getAttribute("value")
    );

    var description = document.getElementById(
      "product-options_" + this.getAttribute("value")
    );

    //add_to_cart_button
    add_to_cart_button.style.opacity = "1";

    //layout
    layout.style.backgroundColor = "blue !important";
    layout.style.opacity = "0.3";
    layout.style.width = "320px";

    //word
    word.classList.remove("stats-container");
    word.classList.add("stats-container2");

    //description
    description.style.display = "block";
  });

  button.addEventListener("mouseout", function () {
    var add_to_cart_button = document.getElementById(
      "add_to_cart_" + this.getAttribute("value")
    );

    var layout = document.getElementById(this.getAttribute("id"));

    var word = document.getElementById(
      "stats-container_" + this.getAttribute("value")
    );

    var description = document.getElementById(
      "product-options_" + this.getAttribute("value")
    );

    //add_to_cart_button
    add_to_cart_button.style.opacity = "0";

    //layout
    layout.style.backgroundColor = "white !important";
    layout.style.opacity = "0";
    layout.style.width = "320px";

    //word
    word.classList.remove("stats-container2");
    word.classList.add("stats-container");

    //description
    description.style.display = "none";
  });
});

document
  .querySelectorAll(".add_to_cart.increaseButton")
  .forEach(function (button) {
    button.addEventListener("mouseover", function () {
      var id = this.getAttribute("id").substring("add_to_cart_".length);

      var add_to_cart_button = document.getElementById("add_to_cart_" + id);

      var layout = document.getElementById("image_overlay_" + id);

      var word = document.getElementById("stats-container_" + id);

      var description = document.getElementById("product-options_" + id);

      //add_to_cart_button
      add_to_cart_button.style.opacity = "1";

      //layout
      layout.style.backgroundColor = "blue !important";
      layout.style.opacity = "0.3";
      layout.style.width = "320px";

      //word
      word.classList.remove("stats-container");
      word.classList.add("stats-container2");

      //description
      description.style.display = "block";
    });
  });

document.querySelectorAll(".removeButton").forEach(function (button) {
  button.addEventListener("click", function () {
    var remove_from_cart = "remove_from_cart=" + this.getAttribute("value");
    fetch("index.php", {
      method: "POST",
      body: remove_from_cart,
      headers: {
        "Content-type": "application/x-www-form-urlencoded",
      },
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
        location.reload();
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var payButton = document.getElementById("payButton");
  var emptyButton = document.getElementById("emptyButton");

  if (emptyButton && payButton) {
    payButton.addEventListener("click", function () {
      alert("Thank you for your purchasing!");
      executeEmpty();
    });

    emptyButton.addEventListener("click", function () {
      if (confirm("Are you sure you want to empty the cart?")) {
        executeEmpty();
      }
    });

    function executeEmpty() {
      fetch("index.php", {
        method: "POST",
        body: "empty=1",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
        },
      })
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
          location.reload();
        });
    }
  }
});
