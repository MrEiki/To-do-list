function modifyInput(){
    this.parentElement.parentElement.classList.add("hide");
    
    this.parentElement.parentElement.nextElementSibling.classList.remove("hide");
    
    let modif = document.querySelector("th:nth-child(4)");
    
    modif.innerHTML = "Valider";
}

function validated(){
    
    this.parentElement.parentElement.classList.add("hide");
    
    this.parentElement.parentElement.previousElementSibling.classList.remove("hide");
    
    let valid = document.querySelector("th:nth-child(4)");
    
    valid.innerHTML = "Modifier";
    
    let updateInput = {
        task:this.parentElement.parentElement.querySelector(".task").value,
        id:this.value
    };
    
    updateInput = JSON.stringify(updateInput);
    
    let options = {
        method : 'POST',
        body : updateInput,
        headers:{'Content-Type':'application/json'}
    };
    
    fetch(`index.php?page=ajaxTask&action=ajax`,options)
    
    .then(response => response.text())
    
    .then(response => {
        
        document.querySelector("main").innerHTML = response;
        
        let inputs = document.querySelectorAll(".swapInput");
        
        for (let i = 0; i < inputs.length; i++)
        {
            inputs[i].addEventListener('click', modifyInput);
        }
        
        let validate = document.querySelectorAll(".validate");
        
        for(let i = 0; i < validate.length; i++)
        {
            validate[i].addEventListener('click', validated)
        }
    })
}


document.addEventListener("DOMContentLoaded",function(){
    
    let inputs = document.querySelectorAll(".swapInput");
    
    for(let i = 0; i < inputs.length; i++)
    {
        inputs[i].addEventListener('click', modifyInput);
    }
    
    let validate = document.querySelectorAll(".validate");
    
    for(let i = 0; i < validate.length; i++)
    {
        validate[i].addEventListener('click', validated);
    }
})