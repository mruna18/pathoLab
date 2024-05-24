// Function to load content dynamically using AJAX
function loadContent(page) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
          document.getElementById("main-content").innerHTML = this.responseText;
      }
  };
  xhttp.open("GET", page + ".php", true);
  xhttp.send();
}

// dropdown

function updateTestDropdown() {
  var typeDropdown = document.getElementById("type");
  var testDropdown = document.getElementById("test");
  var selectedType = typeDropdown.value;

  // Clear existing options in the test dropdown
  testDropdown.innerHTML = '';

  if (selectedType === "Type1") {
    populateDropdown(testDropdown, ["Test A", "Test B", "Test C"]);
  } else if (selectedType === "Type2") {
    populateDropdown(testDropdown, ["Test X", "Test Y", "Test Z"]);
  }
  // Add more cases for other types
}

function populateDropdown(dropdown, options) {
  for (var i = 0; i < options.length; i++) {
    var option = document.createElement("option");
    option.value = options[i];
    option.text = options[i];
    dropdown.appendChild(option);
  }
}



