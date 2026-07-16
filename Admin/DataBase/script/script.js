const backupButton = document.getElementById('backupButton');
const optimizeButton = document.getElementById('optimizeButton');
const checkButton = document.getElementById('checkButton');
const actionResult = document.getElementById('actionResult');
const API_URL = "http://localhost:3000"


// Verificar as tabelas do banco de dados

async function carregarRegistros(tabela) {
    try {
        const response = await fetch(`${API_URL}/DataBase/registros/${tabela}`);

        if (!response) {
            throw new Error('Erro ao carregar registros');
        }
        const registros = await response.json();

        return registros.total;
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro ao criar backup: ' + error.message + '</div>';
    }
}

async function carregarTabelas() {
    const listaTabelasElement = document.getElementById('tablesBody');

    try {
        const response = await fetch(`${API_URL}/DataBase/tables`);
        
        if (!response) {
            throw new Error('Erro ao carregar tabelas');
        }
        const tabelas = await response.json();

        let resultado = []

        tabelas.forEach(objeto => {
            const nomeDaTabela = Object.values(objeto)[0];

            resultado.push(nomeDaTabela)
        });

        return resultado
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro ao criar backup: ' + error.message + '</div>';
    };
}

// async function carregarTR() {
//     const listaTabelasElement = document.getElementById('tablesBody');

//     const tabelas = await carregarTabelas();
//     let cnt = 0;

//     tabelas.forEach(objeto => {
//         const registros = await carregarRegistros(objeto);
//         const tr = document.createElement('tr');
//         const tdTabela = document.createElement('td');
//         const tdRegistros = document.createElement('td');

//         tdRegistros.textContent = registros.len
//         tdTabela.textContent = objeto;
//         cnt++;

//         tr.append(tdTabela, tdRegistros);
//     });

// }


async function carregarTR() {
    const listaTabelasElement = document.getElementById("tablesBody");

    const tabelas = await carregarTabelas();

    for (const tabela of tabelas) {
        const registros = await carregarRegistros(tabela);

        const tr = document.createElement("tr");

        const tdTabela = document.createElement("td");
        tdTabela.textContent = tabela;

        const tdRegistros = document.createElement("td");
        tdRegistros.textContent = registros;

        tr.append(tdTabela);
        tr.append(tdRegistros);

        listaTabelasElement.append(tr);
    }
}

carregarTR()



backupButton.addEventListener("click", async function () {
    actionResult.innerHTML = '<div class="success">Criando backup...</div>';
    try {
        const response = await fetch(`${API_URL}/DataBase/backup`);
        const data = await response.json();
        actionResult.innerHTML = '<div class="success">' + (data.message || 'Backup concluído com sucesso!') + '</div>';
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro ao criar backup: ' + error.message + '</div>';
    }
});

optimizeButton.addEventListener("click", async function () {
    actionResult.innerHTML = '<div class="success">Otimizando banco de dados...</div>';
    try {
        const response = await fetch(`${API_URL}/DataBase/optimize`);
        const data = await response.json();
        actionResult.innerHTML = '<div class="success">' + (data.message || 'Banco otimizado com sucesso!') + '</div>';
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro ao otimizar: ' + error.message + '</div>';
    }
});

checkButton.addEventListener("click", async function () {
    actionResult.innerHTML = '<div class="success">Verificando integridade...</div>';
    try {
        const response = await fetch(`${API_URL}/DataBase/checkIntegrity`);
        const data = await response.json();
        actionResult.innerHTML = '<div class="success">' + (data.message || 'Verificação concluída!') + '</div>';
    } catch (error) {
        actionResult.innerHTML = '<div class="error">Erro na verificação: ' + error.message + '</div>';
    }
});

// Remove the inline script from index.php and let the external script handle everything
console.log('200 OK');