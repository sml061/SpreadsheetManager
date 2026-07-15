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

const conn = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
});

app.get("/usuarios", (req, res) => {

    conn.query(
        "SELECT * FROM usuarios",
        (err, results) => {

            if (err) {
                return res.status(500).json(err);
            }

            res.json(results);

        }
    );

});

app.get("/DataBase/backup", (req, res) => {

    const host = process.env.DB_HOST;
    const user = process.env.DB_USER;
    const password = process.env.DB_PASSWORD;
    const database = process.env.DB_NAME;
    const processoPython = process.env.PROCESS_PYTOHN

    const pythonProcess = spawn(processoPython, ["/opt/MySql/source/backup.py", host, user, database, password]);

    pythonProcess.stdout.on("data", (data) => {
        console.log(data.toString());
    });

    pythonProcess.stderr.on("data", (data) => {
        console.error(data.toString());
    });

    pythonProcess.on("close", (code) => {
        console.log(`Processo finalizado com código ${code}`);
    });

    console.log("Api requisitada");
    res.json({
        status: "ok",
        message: "Api funcionando"
    });
});

app.listen(process.env.PORT, () => {
    console.log("Servidor iniciado.");
});