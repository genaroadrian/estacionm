import fetch from 'node-fetch';
import { readFile } from 'fs/promises';
import fs from 'fs';
import moment from 'moment'

const url = "https://api.thinger.io/"
const local_url = "http://localhost:8000/"
var config = JSON.parse(await readFile(new URL('./config/config.json', import.meta.url)));
var rutaConfig = 'C:/xampp/htdocs/thinger/src/config/config.json'
var datosThinger = []

function main() {
    if(tokenEstaExpirado()) {
        // login
        login().then(response => {
            if(response.access_token) {
                actualizarConfiguracion(response.access_token)
                refrescarConfiguracion()
                obtenerDatos()
            }
        })
    }else {
        // obtener datos
        obtenerDatos()
    }
}

async function refrescarConfiguracion() {
    config = JSON.parse(await readFile(new URL('./config/config.json', import.meta.url)));
}

function parseJwt (token) {
    var tokenArray = token.split('.')
    var datosToken = new Buffer.from(tokenArray[1], 'base64')
    let datosTokenJson = JSON.parse(datosToken.toString('ascii'))
    return datosTokenJson
};

function tokenEstaExpirado() {
    let expire
    const token = parseJwt(config.token)
    const fechaExpiracion = new Date(token.exp * 1000)
    let hoy = new Date()
    const fechaHoy = new Date(hoy - 5 * 60000)
    expire = fechaHoy <= fechaExpiracion ? false : true
    return expire
}

function obtenerDatos() {
    let ultimaFecha
    obtenerRegistroMasActual().then(response => {
        ultimaFecha = new Date(response.fecha).getTime()
        obtenerDatosThinger(ultimaFecha).then(async response => {
            datosThinger =  await response.json()
            preparDatos(datosThinger)
        }).catch(error => {
        })
    })
}

async function obtenerDatosThinger(ultima_fecha) {
    const bucket = "v1/users/Rubes/buckets/Variables_Meteorologicas/data?"
    const parametros = `items=5&min_ts=${ultima_fecha}&sort=asc`
    console.log(`${url}${bucket}${parametros}`)
    const response = await fetch(`${url}${bucket}${parametros}` ,{
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${config.token}`
        }
    })
    return response
}

async function login() {
    const body = `grant_type=password&username=${config.username}&password=${config.password}`
    const response = await fetch(`${url}oauth/token`, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: body
    })
    return await response.json()
}

function actualizarConfiguracion(token) {
    let nueva_config = config
    nueva_config.token = token
    fs.writeFileSync(rutaConfig, JSON.stringify(nueva_config))
}

async function obtenerRegistroMasActual() {
    const response = await fetch(`${local_url}ultimo_registro`)
    return await response.json()
}

function preparDatos(datosThinger) {
    datosThinger.forEach(element => {
        let variable =  {
            fecha: moment(new Date(element.ts)).format('YYYY-MM-DD HH:mm:ss'),
            direccion: element.val.DIRECCION,
            humedad: element.val.HUMEDAD,
            lluvia: element.val.LLUVIA,
            luz: element.val.LUZ,
            temperatura: element.val.TEMPERATURA,
            velocidad: element.val.VELOCIDAD,
            presion: element.val.PRESION
        }
        guardarRegistro(variable).then(response => {
            console.log(response)
        }).catch(error => {

        })
    });
}

async function guardarRegistro(registroThinger) {
    const response = await fetch(`${local_url}api/guardar_variable`,{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(registroThinger)
    })
    return await response.json()
}

main()