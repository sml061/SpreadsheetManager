import { spawn } from "node:child_process";
import express from "express";
import mysql from "mysql2";
import dotenv from "dotenv";
import cors from "cors";

dotenv.config();

const app = express();

app.use(cors());
app.use(express.json());
app.use(express.static("public"));

const conn = mysql.createPool({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
});

function log(tipo, mensagem) {
    console.log(`[${tipo}]  ${mensagem}`)
}

function erro(err) {
    return res.status(500).json({ error: err.message })
    process.exit(1)
};

app.get("/usuarios", (req, res) => {

    conn.query(
        "SELECT * FROM usuarios",
        (err, results) => {

            if (err) {
                erro(err)
            }

            res.json(results);

        }
    );

});

app.get("/DataBase/registros/:tabela", (req, res) => {
    const tabela = req.params.tabela

    conn.query(
        `SELECT COUNT(*) AS total FROM ${tabela};`,
        (err, result) => {
            if (err) {
                erro(err)
            }
            res.json(result[0])
        }
    )
})

app.get("/DataBase/tables", (req, res) => {

    conn.query(
        `SHOW TABLES FROM ${process.env.DB_NAME};`,
        (err, result) => {
            if (err) {
                erro(err)
            }
            res.json(result)
        }

    )
    
})

app.get("/DataBase/backup", (req, res) => {

    const host = process.env.DB_HOST;
    const user = process.env.DB_USER;
    const password = process.env.DB_PASSWORD;
    const database = process.env.DB_NAME;
    const processoPython = process.env.PROCESS_PYTOHN

    const pythonProcess = spawn(processoPython, ["/opt/MySql/source/backup.py", host, user, database, password]);

    pythonProcess.stdout.on("data", (data) => {
        log("Python", data.toString());
    });

    pythonProcess.stderr.on("data", (data) => {
        log("Python", data.toString());
    });

    pythonProcess.on("close", (code) => {
        log("Warning", `Processo finalizado com código ${code}`);
    });

    log("Warning", "Api requisitada");
    res.json({
        status: "ok",
        message: "BackUp concluido"
    });
});

app.listen(process.env.PORT, () => {
    log("System", "Servidor iniciado.");
});