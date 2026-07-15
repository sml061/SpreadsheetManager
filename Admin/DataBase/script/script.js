const backupButton = document.getElementById('backupButton');
const optimizeButton = document.getElementById('optimizeButton');
const checkButton = document.getElementById('checkButton');
const actionResult = document.getElementById('actionResult');


// Verificar as tabelas do banco de dados



backupButton.addEventListener("click", async function () {
    actionResult.innerHTML = '<div class="success">Criando backup...</div>';
    try {
        const response = await fetch("http://localhost:3000/DataBase/backup");
        const data = await response.json();
        actionResult.innerHTML = '<div class="success">' + (data.message || 'Backup concluído com sucesso!') + '</div>';
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro ao criar backup: ' + error.message + '</div>';
    }
});

optimizeButton.addEventListener("click", async function () {
    actionResult.innerHTML = '<div class="success">Otimizando banco de dados...</div>';
    try {
        const response = await fetch("http://localhost:3000/DataBase/optimize");
        const data = await response.json();
        actionResult.innerHTML = '<div class="success">' + (data.message || 'Banco otimizado com sucesso!') + '</div>';
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro ao otimizar: ' + error.message + '</div>';
    }
});

checkButton.addEventListener("click", async function () {
    actionResult.innerHTML = '<div class="success">Verificando integridade...</div>';
    try {
        const response = await fetch("http://localhost:3000/DataBase/checkIntegrity");
        const data = await response.json();
        actionResult.innerHTML = '<div class="success">' + (data.message || 'Verificação concluída!') + '</div>';
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro na verificação: ' + error.message + '</div>';
    }
});

// Remove the inline script from index.php and let the external script handle everything
console.log('Database page script loaded and initialized');