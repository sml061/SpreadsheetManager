const idInput = document.getElementById("id")
const senhaInput = document.getElementById("senha")
const senhaErro = document.getElementById("senha-message")
const idErro = document.getElementById("id-error")

function verificaçaoSenha (senhaValue) {

    let erros = 0

    if (senhaValue == '') {
        senhaErro.textContent = ''
        return
    }
    
    if (!/[A-Z]/.test(senhaValue)) {
        erros++
    }

    if (!/[a-z]/.test(senhaValue)) {
        erros++
    }

    if (!/[0-9]/.test(senhaValue)) {
        erros++
    }

    if (!/[!@#$%^&*]/.test(senhaValue)) {
        erros++
    }

    if (/\s/.test(senhaValue)) {
        erros++
    }

    if (erros === 0) {
        senhaErro.textContent = "✅ Senha forte";
    } else if (erros <= 2) {
        senhaErro.textContent = "🟡 Senha média";
    } else {
        senhaErro.textContent = "🔴 Senha fraca";
    }

}

function verificaçaoID (id) {
    
    if (id == '') {
        idErro.textContent = ''
        return
    }

    fetch("http://localhost:3000/usuarios")
    .then(res => res.json())
    .then(data => {
        const existe = data.some(usuario => usuario.id == id)

        if (existe == true) {
            idErro.textContent = "🔴 Em uso"
        } else {
            idErro.textContent = "✅ Ok"
        }
    })
}

senhaInput.addEventListener("input", function () {

    let senhaValue = senhaInput.value
    
    verificaçaoSenha(senhaValue)
    
})

idInput.addEventListener("input", function () {
    verificaçaoID(idInput.value)
})