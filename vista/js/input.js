document.getElementById("agregar-input").addEventListener("click", function() {
    var container = document.getElementById("cantidadInsumo-container");
    var inputs = container.querySelectorAll("input[name^='cantidadInsumo']");
    var index = inputs.length;

    var newInput = document.createElement("input");
    newInput.setAttribute("type", "text");
    newInput.setAttribute("name", "cantidadInsumo[" + index + "]");
    newInput.classList.add("input");
    newInput.required = true;

    container.appendChild(newInput);
    container.appendChild(document.createElement("br"));
}); 


//input insumos