var chat_unico={

    id_destinatario:null,
    id_remetente:SESSION,
    iniciadores:document.querySelectorAll('.startChat')
}

window.onload=()=>{
    var destinatario=document.querySelectorAll('.dest')
    destinatario.forEach(item=>{
    item.addEventListener('click',function(){
        chat_unico.id_destinatario= this.getAttribute('destinatario')
    })
}) 
}

chat_unico.iniciadores[0].addEventListener('click',function(){
    startChat()
})

function startChat(){
    //a fazer
}

