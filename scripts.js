let dominio = document.getElementById("id_dominio")


dominio.onchange = () => {
    let area = document.getElementById("area_dominio")
    let v = dominio.value
    console.log(v)
    fetch("select_area.php?id_dominio=" + v)
    .then(response =>{
        console.log(response)
        return response.text()
    })
    .then(a =>{
        area.innerHTML = a
    })
}


