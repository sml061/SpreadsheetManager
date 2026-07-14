import express from "express";
import mysql from "mysql2";
import dotenv from "dotenv";
import cors from "cors";

dotenv.config();

const app = express();

app.use(cors())
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

app.listen(process.env.PORT, () => {
    console.log("Servidor iniciado.");
});