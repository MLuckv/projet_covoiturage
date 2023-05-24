window.onload = () =>{
    const FiltersForm = document.querySelector("#filters");

    document.querySelectorAll("#filters input").forEach(input => {
        input.addEventListener("change", () =>{
            //ici on intercepte les click 
            const Form = new FormData(FiltersForm);

            //on fabrique l'url
            const Params = new URLSearchParams();

            Form.forEach((value, key)=>{
                Params.append(key, value);
            });

            const Url = new URL(window.location.href);

            //lance requete ajax
            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1",{
                headers:{
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => 
                response.json()
            ).then(data =>{
               const content = document.querySelector("#content");
               content.innerHTML = data.content;
            }).catch(e => alert(e));

        });
    });    
}


// pour lier <script src="{{ asset('assets/js/filter.js')}}"></script>